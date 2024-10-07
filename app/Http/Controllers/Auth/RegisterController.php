<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaysPartenersRessource;
use App\Models\Pays;
use App\Models\PaysPartner;
use App\Models\SecteurActivite;
use App\Models\Service;
use App\Models\TypeOpportunity;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'pays_partner_id' => ['nullable'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    public function showRegistrationForm(Request $request)
    {
        // Récupérer les services, secteurs, sous-secteurs et pays à partir de la base de données
        $services = TypeOpportunity::all();
        $secteurs = SecteurActivite::all();
        $pays = PaysPartner::all();
        $pays =  PaysPartenersRessource::collection($pays)->toArray($request);
        // Passer ces données à la vue via compact
        return view('auth.register', compact('services', 'secteurs', 'pays'));
    }


    public function getSousSecteurs(Request $request)
    {
        // Récupérer les IDs des secteurs sélectionnés
        $secteurIds = $request->input('secteurs');

        // Si aucun secteur n'est sélectionné
        if (empty($secteurIds)) {
            return response()->json([]);
        }

        // Récupérer les sous-secteurs pour tous les secteurs sélectionnés
        $sousSecteurs = SecteurActivite::whereIn('id', $secteurIds)
            ->with('secteurActiviteChild') // Assurez-vous que la relation est définie dans votre modèle
            ->get()
            ->pluck('secteurActiviteChild')
            ->flatten();

        return response()->json($sousSecteurs);
    }



    // public function register(Request $request)
    // {
    //     // Validation des données
    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'services' => 'required|array',
    //         'secteurs' => 'required|array',
    //         'sousSecteurs' => 'required|array',
    //     ]);


    //     // Création de l'utilisateur
    //     $user = User::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'pays_partner_id' => $request->pays_partner_id,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     // Associer les services, secteurs, et sous-secteurs
    //     $user->typeOpportunities()->attach($request->services);
    //     $user->secteurs()->attach($request->secteurs);
    //     $user->sousSecteurs()->attach($request->sousSecteurs);

    //     return redirect()->route('login')->with('success', 'Inscription réussie !');
    // }


    public function register(Request $request)
{
    // Validation des données
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'services' => 'required|array',
        'secteurs' => 'required|array',
        'sousSecteurs' => 'required|array',
    ]);

    // Création de l'utilisateur
    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'is_onboarding' => 1,
        'pays_partner_id' => $request->pays_partner_id,
        'password' => Hash::make($request->password),
    ]);

    // Associer les services, secteurs, et sous-secteurs
    $user->typeOpportunities()->attach($request->services);
    $user->secteurs()->attach($request->secteurs);
    $user->sousSecteurs()->attach($request->sousSecteurs);

    // Connexion de l'utilisateur
    Auth::login($user);

    // Rediriger l'utilisateur
    return redirect()->route('accueil')->with('success', 'Inscription réussie et connecté !');
}



    // public function store(Request $request)
    // {
    //     // Validation des données
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'services' => 'required|array',
    //         'services.*' => 'exists:type_opportunities,id',
    //         'secteurs' => 'required|array',
    //         'sousSecteurs' => 'required|array',
    //     ]);

    //     // Vérifiez si la validation a échoué
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     try {
    //         // Créer l'utilisateur
    //         $user = User::create([
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         // Attacher les types d'opportunité à l'utilisateur
    //         $user->typeOpportunities()->attach($request->services);

    //         // Attacher les secteurs d'activité à l'utilisateur
    //         $user->secteurs()->attach($request->secteurs);

    //         // Attacher les sous-secteurs à l'utilisateur
    //         $user->sousSecteurs()->attach($request->sousSecteurs);

    //         // Retourner une réponse de succès
    //         return response()->json(['message' => 'Inscription réussie!', 'user' => $user], 201);

    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Une erreur est survenue lors de l\'inscription.'], 500);
    //     }
    // }








    // protected function create(array $data)
    // {
    //     $password = $data['password'];
    //     return User::create([
    //         'first_name' => $data['first_name'],
    //         'last_name' => $data['last_name'],
    //         'email' => $data['email'],
    //         'is_onboarding' => 1,
    //         'password' => bcrypt($password),
    //     ]);
    // }

}
