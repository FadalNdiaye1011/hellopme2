<?php

namespace App\Http\Controllers;

use App\Http\Resources\api\TypeFinanceRessource;
use App\Models\Abonnement;
use App\Models\ActeurFinance;
use App\Models\Opportunity;
use App\Models\Pays;
use App\Models\PaysPartner;
use App\Models\SecteurActivite;
use App\Models\TypeOpportunity;
use App\Models\Finance;
use App\Models\TypeFinance;
use App\Models\UserAbonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $opportunities = Opportunity::latest('created_at')->take(6)->get();
        $secteur_activites = SecteurActivite::all();
        $typeOpportunities = TypeOpportunity::all();

        $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name', 'pays.code_pays as code')
            ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
            ->withCount('opportunities')
            ->get();

        $events = Opportunity::whereHas('typeOpportunity', function ($query) {
                $query->where('libelle', 'Evénements');
            })
            ->where('is_featured', true)
            ->take(3)
            ->get();

        return view('home', compact('opportunities', 'secteur_activites', 'paysPartners', 'typeOpportunities', 'events'));
    }


    public function search(Request $request)
{
    $typeOpportunityId = $request->input('type_opportunity_id');
    $secteurActiviteId = $request->input('secteur_activite_id');
    $paysPartnerId = $request->input('pays_partner_id');

    if ($request->input('type') && $request->input('type') == "all" ){
        $opportunities = Opportunity::paginate(6); // Paginer avec 10 résultats par page
    } else {
        $opportunities = Opportunity::when($typeOpportunityId, function ($query) use ($typeOpportunityId) {
                return $query->where('type_opportunity_id', $typeOpportunityId);
            })
            ->when($secteurActiviteId, function ($query) use ($secteurActiviteId) {
                return $query->where('secteur_activite_id', $secteurActiviteId);
            })
            ->when($paysPartnerId, function ($query) use ($paysPartnerId) {
                return $query->where('pays_partner_id', $paysPartnerId);
            })
            ->paginate(6);
    }

    $typeOpportunities = TypeOpportunity::all();
    $secteursActivite = SecteurActivite::all();
    $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name', 'pays.code_pays as code')
        ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
        ->withCount('opportunities')
        ->get();

    return view('frontend.opportunities.index',
        compact('opportunities', 'typeOpportunities', 'secteursActivite', 'paysPartners'));
}


    public function detail_appel_offre (Opportunity $opportunity){

        $appels_offres = Opportunity::whereHas('typeOpportunity', function ($query) {
            $query->where('libelle', 'Appels d\'offres');
        })
        ->take(3)
        ->get();

        return view('frontend.detail-appel-offre', compact('opportunity', 'appels_offres'));
    }

    public function evenements (){

        $opportunities = Opportunity::latest('created_at')->take(5)->get();
        $typeOpportunities = TypeOpportunity::all();
        $secteur_activites = SecteurActivite::all();

        $secteurs = DB::table('opportunities')
            ->join('secteur_activite_children', 'opportunities.secteur_activite_children_id', '=', 'secteur_activite_children.id')
            ->join('type_opportunities', 'opportunities.type_opportunity_id', '=', 'type_opportunities.id')
            ->join('secteur_activites', 'secteur_activite_children.secteur_activite_id', '=', 'secteur_activites.id')
            ->select('secteur_activites.libelle as secteur', DB::raw('count(opportunities.id) as nombre_evenements'))
            ->where('type_opportunities.libelle', 'Événements')
            ->whereNull('opportunities.deleted_at')
            ->groupBy('secteur')
            ->get();

        $evenements_by_pays = DB::table('opportunities')
            ->join('pays_partners', 'opportunities.pays_partner_id', '=', 'pays_partners.id')
            ->join('type_opportunities', 'opportunities.type_opportunity_id', '=', 'type_opportunities.id')
            ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
            ->select('pays.fr as nom', 'pays.code_pays as code', 'pays_partners.id as pays_partner_id', DB::raw('count(opportunities.id) as nombre_evenements'))
            ->where('type_opportunities.libelle', 'Événements')
            ->whereNull('opportunities.deleted_at')
            ->groupBy('nom', 'code', 'pays_partners.id')
            ->get();

        $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name', 'pays.code_pays as code')
            ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
            ->withCount('opportunities')
            ->get();

        $evenements = Opportunity::whereHas('typeOpportunity', function ($query) {
            $query->where('libelle', 'Evénements');
        })
        ->take(3)
        ->get();

        $events = Opportunity::whereHas('typeOpportunity', function ($query) {
            $query->where('libelle', 'Evénements');
        })
        ->where('is_featured', true)
        ->take(3)
        ->get();

        return view('frontend.evenements', compact('evenements','opportunities', 'typeOpportunities', 'secteur_activites','paysPartners', 'events', 'secteurs', 'evenements_by_pays' ));
    }

    public function financements (){
        $financements = Opportunity::whereHas('typeOpportunity', function ($query) {
            $query->where('libelle', 'Financements');
        })
        ->take(3)
        ->get();

        $secteur_activites = SecteurActivite::all();
        $typeOpportunities = TypeOpportunity::all();

        $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name', 'pays.code_pays as code')
            ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
            ->withCount('opportunities')
            ->get();

        $events = Opportunity::whereHas('typeOpportunity', function ($query) {
            $query->where('libelle', 'Evénements');
        })
        ->where('is_featured', true)
        ->take(3)
        ->get();

        $typefinances = TypeFinance::all();

        return view('frontend.financements', compact('financements', 'typefinances', 'secteur_activites', 'typeOpportunities', 'paysPartners', 'events'));
    }


    // public function showListeBanque($id)
    // {
    //     // Trouver le type de financement par ID
    //     $typeFinance = TypeFinance::with('acteurFinances')->findOrFail($id);
    //     $typeFinance = new TypeFinanceRessource($typeFinance);
    //     // return $typeFinance;
    //     return view('frontend.listeActeurFinance', compact('typeFinance'));
    // }

        public function showListeBanque(Request $request, $id)
    {
        // Trouver le type de financement par ID
        $typeFinance = TypeFinance::with(['acteurFinances' => function($query) use ($request) {
            // Filtrer par nom de banque si le paramètre 'search' est présent
            if ($request->has('search') && !empty($request->search)) {
                $query->where('libelle', 'like', '%' . $request->search . '%');
            }

            // Filtrer par pays si le paramètre 'pays' est présent
            if ($request->has('pays') && !empty($request->pays)) {
                $query->whereHas('pays', function($q) use ($request) {
                    $q->where('id', $request->pays); // Assurez-vous d'ajuster selon la clé de votre pays
                });
            }
        }])->findOrFail($id);

        $typeFinance = new TypeFinanceRessource($typeFinance);
        return view('frontend.listeActeurFinance', compact('typeFinance'));
    }


    public function profile(){
        $user = Auth::user();
        if(!$user)
            return redirect(route('login'));

        // $mainSecteurActivity = DB::table('area_of_interest')
        // ->select('image', 'libelle')
        // ->where('type', 'secteur_activites')
        // ->join('secteur_activites', 'area_of_interest.secteur_activite_id', 'secteur_activites.id')
        // ->where('user_id', $user)
        // ->get();

        $typeOpportunities = DB::table('area_of_interest')
        ->select('image', 'libelle')
        ->where('type', 'type_opportunities')
        ->join('type_opportunities', 'area_of_interest.type_opportunity_id', 'type_opportunities.id')
        ->where('user_id', $user->id)
        ->get();

        $raw_opportunities = $user->watchlists()->get();
        $watchlists = array();
        $none_entity = "None";
        foreach($raw_opportunities as $raw):
            $opportunity = Opportunity::find($raw->opportunity_id);
            if(!$opportunity)
                continue;

                $deadline = ($opportunity->deadline) ? \Carbon\Carbon::create($opportunity->deadline)->translatedFormat('d M Y') : $none_entity;

                $sammple = array();
                $sample['id'] = $opportunity->id;
                $sample['titre'] = $opportunity->titre;
                $sample['type'] = $opportunity->typeOpportunity->libelle;
                $sample['deadline'] = $deadline;
                $sample['permalink'] = \URL::to('/detail-appel-offre/' . $opportunity->id);
                // $sample['email_organisateur'] = $opportunity->email_contact;

                $watchlists[] = $sample;

        endforeach;

        $abonnements = Abonnement::where('statut', 1)->get();
        return view('frontend.profil', compact('user', 'abonnements', 'typeOpportunities', 'watchlists'));

    }

    public function storeAbonnement(Request $request)
    {
        $user = Auth::user();
        if($user){
            $currentDate = Carbon::now();
            $abonnement = Abonnement::where('id', $request->type)->first();
            $price = $abonnement->price;
            $end_date = $currentDate->addMonths($abonnement->durations);
            $data = ['abonnement_id' => $request->type, 'user_id' => $user->id, 'end_date' => $end_date->toDateString(), 'price' => $price ];
            UserAbonnement::create($data);

            return redirect()->back();
        }else{
            return redirect(route('login'));
        }
    }

}
