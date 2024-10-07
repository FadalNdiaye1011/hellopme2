<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserAbonnement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Flash;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    private $paydunyaApiEndpoint = 'https://app.paydunya.com/api/v1/dmp-api';

    private function getPaydunyaCredentials()
    {
        return [
            'master_key' => config("services.paydunya.master_key"),
            'private_key' => config("services.paydunya.prod_private_key"),
            'token' => config("services.paydunya.prod_token"),
        ];
    }

    private function createAbonnement(Request $request, $user)
    {
        $abonnement = Abonnement::findOrFail($request->type);
        $currentDate = Carbon::now();
        $existingSubscription = UserAbonnement::where('user_id', $user->id)
        ->where('end_date', '>', $currentDate)
        ->first();

        if ($existingSubscription) {
            $existingSubscription->update(
                ['end_date' => $existingSubscription->end_date->addMonths($abonnement->durations)]
            );
            return $existingSubscription;
        }

        $end_date = $currentDate->addMonths($abonnement->durations);
        $data = [
            'abonnement_id' => $request->type,
            'user_id' => $user->id,
            'end_date' => $end_date->toDateString(),
            'price' => $abonnement->price,
            'status' => 0,
        ];

        return UserAbonnement::create($data);
    }

    private function sendPaymentRequest($user, $request)
    {
        $abonnement = Abonnement::findOrFail($request->type);

        $recipientEmail = $user->email;
        // $amount = $abonnement->price;
        $amount = 200;
        $supportFees = 0;
        $sendNotification = 0;

        $credentials = $this->getPaydunyaCredentials();

        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'PAYDUNYA-MASTER-KEY' => $credentials['master_key'],
            'PAYDUNYA-PRIVATE-KEY' => $credentials['private_key'],
            'PAYDUNYA-TOKEN' => $credentials['token'],
        ])->post($this->paydunyaApiEndpoint, [
            // 'mode' => 'test',
            'recipient_email' => $recipientEmail,
            'amount' => $amount,
            'support_fees' => $supportFees,
            'send_notification' => $sendNotification,
            'custom_data' => [
                "user_id" => $user->id,
                "abonnement_id" => $abonnement->id
            ],
            "actions" => [
                "callback_url" => "https://hellopme.moveskills.xyz/api/paydunya/response"
            ]
        ]);
    }

    private function createOrUpdatePayment($orderNumber, $user, $userAbonnement)
    {
        $datePayment = now();
        $userName = $user->first_name . ' ' . $user->last_name;
        $userEmail = $user->email;
        $userPhone = $user->phone;

        return Payment::updateOrCreate(
            ["order_number" => $orderNumber],
            [
                "order_number" => $orderNumber,
                "date_payment" => $datePayment,
                "state_payment" => 0,
                "user_name" => $userName,
                "user_phone" => $userPhone,
                "user_email" => $userEmail,
                "user_abonnement_id" => $userAbonnement->id
            ]
        );
    }

    public function purchase(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $response = $this->sendPaymentRequest($user, $request);

            $responseData = $response->json();
            if(isset($responseData['response-code']))
            if ($responseData['response-code'] == "00") :
                $userAbonnement = $this->createAbonnement($request, $user);

                $orderNumber = $responseData['reference_number'];
                $this->createOrUpdatePayment($orderNumber, $user, $userAbonnement);

                return redirect($responseData['url']);
            endif;

            $error_message = isset($responseData['response_text']) ? $responseData['response_text'] : "Something went wrong !";
            Flash::error($error_message);
            return redirect()->back();
        }
    }

    private function sendCheckStatusRequest($referenceNumber)
    {
        $credentials = $this->getPaydunyaCredentials();

        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'PAYDUNYA-MASTER-KEY' => $credentials['master_key'],
            'PAYDUNYA-PRIVATE-KEY' => $credentials['private_key'],
            'PAYDUNYA-TOKEN' => $credentials['token'],
        ])->post('https://app.paydunya.com/api/v1/dmp-api/check-status', [
            'reference_number' => $referenceNumber,
        ]);
    }

    public function cancelPayment()
    {
        return redirect()->route('users.profil');
    }

    public function callback_paydunya(Request $request)
    {
        //Test 1
        $process_data = ['state' => 1, 'data' => 'xxxxx'];
        DB::table('paydunya_tests')->insert($process_data);

        // $infos = $request->all();
        // $data = isset($infos['data']) ? $infos['data'] : [];
        $data = isset($_POST['data']) ? $_POST['data'] : [];
        $status = isset($data['status']) ? $data['status'] : 'not started';
        if ($status != "completed")
            return response()->json(['error' => 'Error on transaction!'], 201);

        //Test 2 --after1ststep
        // $encode_data = json_encode($data);
        // $process_data = ['state' => 1, 'data'=> $encode_data];
        // DB::table('paydunya_tests')->insert($process_data);

        $amount = isset($data['invoice']['total_amount']) ? $data['invoice']['total_amount'] : 0;
        $user_id = isset($data['custom_data']['user_id']) ? $data['custom_data']['user_id'] : 0;
        $abonnement_id = isset($data['custom_data']['abonnement_id']) ? $data['custom_data']['user_id'] : 0;
        $input = [
            'amount' => intval($amount),
            'user_id' => intval($user_id),
            'abonnement_id' => intval($abonnement_id),
        ];

        //Control over payment
        $abonnement = UserAbonnement::where([
            'user_id' => $input['user_id'],
            'abonnement_id' => $input['abonnement_id']
        ])->where('status', 0)
        ->latest('updated_at')
        ->first();

        // if (empty($abonnement))
        //     return response()->json(['error' => 'Abonnement not found!'], 200);

        //Test 3 --after1ststep
        $process_data = ['state' => 1, 'user_id' => $user_id, 'abonnement_id' => $abonnement_id ];
        DB::table('paydunya_tests')->insert($process_data);

        // if ($input['amount'] < 0 || $input['amount'] < $abonnement->price) {
        //     return response()->json(['error' => 'Incorrect amount found!'], 200);
        // }

        $user = User::find($input['user_id']);

        $this->createOrUpdatePayment($abonnement->payment->order_number,
            $user, $abonnement)->update(['state_payment' => 1]);

        return response()->json(['success' => 'Subscription was a success!'], 200);
    }
}


