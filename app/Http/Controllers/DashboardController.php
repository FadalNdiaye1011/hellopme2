<?php

namespace App\Http\Controllers;

use App\Models\Databank;
use App\Models\Opportunity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
//     public function index(Request $request)
// {
//     // Filtrage par période (jour, semaine, mois)
//     $filter = $request->get('filter', 'all'); // 'all' par défaut si aucun filtre

//     $queryBeingModified = Databank::where('etat', 'being_modified');
//     $queryModified = Databank::where('etat', 'modified');

//     switch ($filter) {
//         case 'day':
//             $queryBeingModified->whereDate('updated_at', Carbon::today());
//             $queryModified->whereDate('updated_at', Carbon::today());
//             break;
//         case 'week':
//             $queryBeingModified->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
//             $queryModified->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
//             break;
//         case 'month':
//             $queryBeingModified->whereMonth('updated_at', Carbon::now()->month);
//             $queryModified->whereMonth('updated_at', Carbon::now()->month);
//             break;
//     }


//     $databanksBeingModified = $queryBeingModified->get();
//     $countBeingModified = $databanksBeingModified->count();

//     $databanksModified = $queryModified->get();
//     $countModified = $databanksModified->count();

//     $AppelOffre = Opportunity::where("type_opportunity_id",1)->count();
//     $Financement = Opportunity::where("type_opportunity_id",2)->count();
//     $Evenement = Opportunity::where("type_opportunity_id",3)->count();



//     $data = [
//         'labels' => ['Appels d\'offres', 'Financements', 'Evenement'],
//         'data' => [$AppelOffre ,$Financement, $Evenement],
//     ];

//     $countOpportunities = Opportunity::count();

//     return view('dashboard.index', [
//         'databanksBeingModified' => $databanksBeingModified,
//         'countBeingModified' => $countBeingModified,
//         'databanksModified' => $databanksModified,
//         'countModified' => $countModified,
//         'data' => $data,
//         'countOpportunities' => $countOpportunities,
//         'filter' => $filter // pour garder le filtre sélectionné dans la vue
//     ]);
// }


public function index(Request $request)
{
    // Filtrage par période (jour, semaine, mois)
    $filter = $request->get('filter', 'all'); // 'all' par défaut si aucun filtre

    // Requêtes pour les données de Databank
    $queryBeingModified = Databank::where('etat', 'being_modified');
    $queryModified = Databank::where('etat', 'modified');

    // Requêtes pour les opportunités
    $queryOpportunities = Opportunity::query(); // Commencez une nouvelle requête

    switch ($filter) {
        case 'day':
            // Filtrage pour Databank
            $queryBeingModified->whereDate('updated_at', Carbon::today());
            $queryModified->whereDate('updated_at', Carbon::today());

            // Filtrage pour Opportunités
            $queryOpportunities->whereDate('created_at', Carbon::today());
            break;
        case 'week':
            // Filtrage pour Databank
            $queryBeingModified->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            $queryModified->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

            // Filtrage pour Opportunités
            $queryOpportunities->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            break;
        case 'month':
            // Filtrage pour Databank
            $queryBeingModified->whereMonth('updated_at', Carbon::now()->month);
            $queryModified->whereMonth('updated_at', Carbon::now()->month);

            // Filtrage pour Opportunités
            $queryOpportunities->whereMonth('created_at', Carbon::now()->month);
            break;
    }

    $databanksBeingModified = $queryBeingModified->get();
    $countBeingModified = $databanksBeingModified->count();

    $databanksModified = $queryModified->get();
    $countModified = $databanksModified->count();

    // Compter les types d'opportunités
    $AppelOffre = Opportunity::where("type_opportunity_id", 1)->count();
    $Financement = Opportunity::where("type_opportunity_id", 2)->count();
    $Evenement = Opportunity::where("type_opportunity_id", 3)->count();

    $data = [
        'labels' => ['Appels d\'offres', 'Financements', 'Evenement'],
        'data' => [$AppelOffre, $Financement, $Evenement],
    ];

    $countOpportunities = Opportunity::count();

    // Récupérer les opportunités selon le filtre appliqué
    $opportunities = $queryOpportunities->get();
    $countOpportunitiesFiltered = $opportunities->count();

    return view('dashboard.index', [
        'databanksBeingModified' => $databanksBeingModified,
        'countBeingModified' => $countBeingModified,
        'databanksModified' => $databanksModified,
        'countModified' => $countModified,
        'data' => $data,
        'countOpportunities' => $countOpportunities,
        'filter' => $filter, // pour garder le filtre sélectionné dans la vue
        'opportunities' => $opportunities,
        'countOpportunitiesFiltered' => $countOpportunitiesFiltered,
    ]);
}




}
