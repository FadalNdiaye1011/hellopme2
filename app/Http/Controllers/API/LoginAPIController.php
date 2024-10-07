<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;

use App\Models\ValidationEmail;

use App\Models\AreaInterest;
use App\Http\Requests\API\LoginAPIRequest;
use App\Http\Requests\API\RefreshTokenAPIRequest;
use App\Http\Requests\API\SignUpAPIRequest;
use App\Http\Requests\API\CodePasswordAPIRequest;
use App\Http\Requests\API\ResetPasswordAPIRequest;
use App\Http\Requests\API\ForgotPasswordAPIRequest;

use GuzzleHttp\Exception\ClientException;

use App\Http\Controllers\AppBaseController;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

use Carbon\Carbon;
use Storage;

define('DURATION', '345600');

class LoginAPIController extends AppBaseController
{

    public function generate_code($email){
        //Generate code
        $code = random_int(1000, 9999);
        $input = [
            'email' => $email,
            'code' => $code
        ];

        $validationEmail = ValidationEmail::create($input);

        return $code;
    }

    public function refresh_token(RefreshTokenAPIRequest $request){
        $inputs = $request->all();

        $access_token = 'Bearer ' . Str::random(50);
        $expire_at = Carbon::now()
                    ->addSeconds(DURATION)
                    ->format('Y-m-d H:i:s');
        $current_date = Carbon::now()
                    ->format('Y-m-d H:i:s');

        DB::table('tokens')
            ->where('tokens.refresh_token', $inputs['refresh_token'])
            ->where('expired_at', '<', $current_date )
            ->update(['token' => $access_token, 'expired_at' => $expire_at]);

        $token = Token::select('token')->where('refresh_token', $inputs['refresh_token'])->first();

        if(!empty($token))
            return $this->sendResponse($token, 'Access token refresh successfully !');
        else
            return $this->sendError('Refresh token invalid !');
    }

    public function login(LoginAPIRequest $request){
        $inputs = $request->all();

        $user = User::where('email', $inputs['email'])->first();

        if(!empty($user))
            if(Hash::check($inputs['password'], $user->password)){
                $refresh_token = 'Bearer ' . Str::random(50);
                $access_token = 'Bearer ' . Str::random(50);

                $expired_at = Carbon::now()
                            ->addSeconds(DURATION)
                            ->format('Y-m-d H:i:s');
                $current_date = Carbon::now()
                            ->format('Y-m-d H:i:s');

                $check_token = Token::where('user_id', $user->id)->first();
                $bool = false;
                if($check_token)
                    if($check_token->expired_at){
                        $bool = true;
                        DB::table('tokens')
                            ->where('tokens.user_id', $user->id)
                            ->where('expired_at', '<', $current_date )
                            ->update(['token' => $access_token, 'refresh_token' => $refresh_token, 'expired_at' => $expired_at]);
                    }

                if(!$bool)
                    DB::table('tokens')
                    ->where('tokens.user_id', $user->id)
                    ->update(['token' => $access_token, 'refresh_token' => $refresh_token, 'expired_at' => $expired_at]);

                
                $token_key = Token::firstOrCreate(
                    array(
                        'user_id' => $user->id,
                        'state' => 1,
                    ),
                    array(  
                    'tokenable_type' => "\Model\User",
                    'token' => $access_token,
                    'user_id' => $user->id,
                    'scope' => 'User',
                    'state' => 1,
                    'refresh_token' => $refresh_token,
                    'expired_at' => $expired_at
                    )
                );
                $output = User::find($user->id);
                $output->token = $token_key->token;
                $output->refresh_token = $token_key->refresh_token;

                //IS ON BOARD OR NOT
                $is_onboarding = 1;
                $typeAreas = ['pays_partners', 'type_opportunities', 'secteur_activites'];
                foreach ($typeAreas as $typo):
                    $areaInterest = AreaInterest::where('type', $typo)->where('user_id', $output->id)->first();
                    if(empty($areaInterest)){
                        $is_onboarding = 0;
                        break;
                    }
                endforeach;
                $output->is_onboarding = $is_onboarding;              

                //Avatar user
                if($user->avatar)
                    $output->avatar = Storage::disk('s3')->url('users/avatar'. $user->avatar);
                else
                    $output->avatar = null;

                return $this->sendResponse($output,'Successfully connected !');
            }

        return $this->sendError('Credentials filled are incorrect !');
    }

    public function register(SignUpAPIRequest $request){
        $inputs = $request->all();

        $password = bcrypt($inputs["password"]);
        $user = null;
        $user = DB::transaction(function() use ($inputs, $request, $password) {
            $inputs = $request->all();

            //Create the User
            $user = User::create([
                'first_name' => $inputs["first_name"],
                'last_name' => $inputs["last_name"],
                'email' => $inputs["email"],
                'avatar' => NULL,
                'role_id' => 'user',
                'address_id' => NULL,
                'password' => $password,
            ]);

            //Create token dedicated to the user
            if(!empty($user)){
                $expired_at = Carbon::now()
                            ->addSeconds(DURATION)
                            ->format('Y-m-d H:i:s');
                $token_id = Str::random(50);
                $refresh_token_id =  Str::random(50);

                $token = Token::create([
                    'tokenable_type' => "\Model\User",
                    'token' => 'Bearer ' . $token_id,
                    'user_id' => $user->id,
                    'scope' => 'User',
                    'state' => 1,
                    'refresh_token' => 'Bearer ' . $refresh_token_id,
                    'expired_at' => $expired_at,
                ]);
                $user->token = $token->token;
                $user->refresh_token = $token->refresh_token;

                //Avatar user
                if($user->avatar)
                    $user->avatar = Storage::disk('s3')->url('users/'. $user->avatar);
                else
                    $user->avatar = null;
            }
            
            return $user;
        }, 1);

        if(!empty($user)){
            \Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));
            return $this->sendResponse($user, 'Successfully registered !');
        }

        return $this->sendError('Something went wrong !');
    }

    public function logout(Request $request){
		$token = $request->header('Authorization');
        $state = DB::table('tokens')
            ->where('tokens.token', $token)
            ->update(['token' => NULL, 'refresh_token' => NULL,'expired_at' => NULL]);

		if($state)
			return $this->sendSuccess('Disconnection successfully done !');
		else
			return $this->sendError('Error encountered, make sure you are already connected !');
	}

    public function forgot_password(ForgotPasswordAPIRequest $request){
        $input = $request->all();

        $user = User::where('email', $input['email'])->first();

        if(!empty($user)){
            //Generate code
            $code = $this->generate_code($user->email);

            //Send email
            \Mail::to($user->email)->send(new \App\Mail\CodeEmail($code));
            // \Mail::to($user->email)->send(new \App\Mail\ForgotPassword($code));

            return $this->sendResponse($code, 'Code generated successfully !');
        }
        else
            return response()->json(['error' => 'Email not matching with a user !'], 201);
    }

    public function match_code(CodePasswordAPIRequest $request){
        $input = $request->all();
        $verification = ValidationEmail::where('code', $input['code'])->first();
        if(empty($verification)){
            return response()->json(['success' => false, 'message' => 'Verification code not found !'], 201);
        }else{
            $user = User::where('email', $verification->email)->first();
            $user->email_verified_at = Carbon::now();
            $user->save();
            return $this->sendSuccess("Code matched successfully !");
        }
    }

    public function reset_password(ResetPasswordAPIRequest $request){
        $inputs = $request->all();
        $verification = ValidationEmail::where('code', $inputs['code'])->first();
        if(empty($verification))
            return response()->json(['success' => false, 'message' => 'Code not found !'], 201);

        $user = User::where('email', $verification->email)->first();

        $user->password = bcrypt($inputs['new_password']);
        $user->save();

        $verification->delete();

        return $this->sendSuccess('Password reset successfully ! ');
    }

}
