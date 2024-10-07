<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\TypeFinanceRessource;
use App\Models\TypeFinance;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ActeurFinanceController extends Controller
{
    // public function index()
    // {
    //     try {
    //         // Récupérer tous les types de finance avec leurs acteurs associés
    //         $typesFinances = TypeFinance::all();

    //         // Retourner la réponse au format souhaité
    //         return response()->json([
    //             'success' => true, // Statut booléen
    //             'message' => 'Types de finance récupérés avec succès.',
    //             'data' => TypeFinanceRessource::collection($typesFinances),
    //         ]);
    //     } catch (\Exception $e) {
    //         // Gérer les exceptions et retourner une réponse au format souhaité
    //         return response()->json([
    //             'success' => false, // Statut booléen pour erreur
    //             'message' => 'Erreur lors de la récupération des types de finance : ' . $e->getMessage(),
    //             'data' => null,
    //         ], 500); // Code d'erreur 500 pour les erreurs serveur
    //     }
    // }


    // public function index(Request $request)
    // {
    //     try {
    //         // Récupérer les paramètres de la requête
    //         $paysId = $request->input('pays_id');
    //         $typeFinanceId = $request->input('type_finance');

    //         // Vérifier si les paramètres sont fournis
    //         if (!$paysId || !$typeFinanceId) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Les paramètres pays_id et type_finance sont requis.',
    //                 'data' => null,
    //             ], 400); // Code 400 pour mauvaise requête
    //         }

    //         // Filtrer les acteurs financiers par type de finance et pays
    //         $typesFinances = TypeFinance::where('id', $typeFinanceId)
    //             ->with(['acteurFinances' => function ($query) use ($paysId) {
    //                 $query->where('pays_id', $paysId);
    //             }])->get();

    //         // Vérifier si des résultats existent
    //         if ($typesFinances->isEmpty()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Aucun acteur de finance trouvé pour ce type et ce pays.',
    //                 'data' => null,
    //             ], 404); // Code d'erreur 404 pour non trouvé
    //         }

    //         // Retourner la réponse au format souhaité
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Types de finance récupérés avec succès.',
    //             'data' => TypeFinanceRessource::collection($typesFinances),
    //         ]);
    //     } catch (\Exception $e) {
    //         // Gérer les exceptions et retourner une réponse au format souhaité
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Erreur lors de la récupération des types de finance : ' . $e->getMessage(),
    //             'data' => null,
    //         ], 500); // Code d'erreur 500 pour les erreurs serveur
    //     }
    // }


    public function index(Request $request)
{
    try {
        // Récupérer les paramètres de la requête
        $paysId = $request->input('pays_partners_id', 2); // Par défaut, pays_id = Sénégal
        $typeFinanceId = $request->input('type_finance');

        // Initialiser la requête pour récupérer tous les types de finance
        $query = TypeFinance::query();

        // Appliquer le filtre par type de finance si le paramètre est fourni
        if ($typeFinanceId) {
            $query->where('id', $typeFinanceId);
        }

        // Appliquer le filtre par pays si le paramètre est fourni
        $query->with(['acteurFinances' => function ($query) use ($paysId) {
            // Si aucun pays_id n'est spécifié, cela retournera tous les acteurs financiers
            $query->where('pays_partners_id', $paysId);
        }]);

        // Exécuter la requête
        $typesFinances = $query->get();

        // Vérifier si des résultats existent
        if ($typesFinances->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun acteur de finance trouvé.',
                'data' => null,
            ], 404); // Code d'erreur 404 pour non trouvé
        }

        // Retourner la réponse au format souhaité
        return response()->json([
            'success' => true,
            'message' => 'Types de finance récupérés avec succès.',
            'data' => TypeFinanceRessource::collection($typesFinances),
        ]);
    } catch (\Exception $e) {
        // Gérer les exceptions et retourner une réponse au format souhaité
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la récupération des types de finance : ' . $e->getMessage(),
            'data' => null,
        ], 500); // Code d'erreur 500 pour les erreurs serveur
    }
}



    public function show($id)
    {
        try {
            // Récupérer le type de finance avec ses acteurs, contacts et services associés
            $typeFinance = TypeFinance::findOrFail($id);

            // Retourner la réponse au format souhaité
            return response()->json([
                'success' => true, // Statut booléen
                'message' => 'Type de finance récupéré avec succès.',
                'data' => new TypeFinanceRessource($typeFinance),
            ]);
        } catch (ModelNotFoundException $e) {
            // Gérer l'exception si le modèle n'est pas trouvé
            return response()->json([
                'success' => false, // Statut booléen pour erreur
                'message' => 'Type de finance non trouvé.',
                'data' => null,
            ], 404); // Code d'erreur 404 pour non trouvé
        } catch (\Exception $e) {
            // Gérer d'autres exceptions et retourner une réponse au format souhaité
            return response()->json([
                'success' => false, // Statut booléen pour erreur
                'message' => 'Erreur lors de la récupération du type de finance : ' . $e->getMessage(),
                'data' => null,
            ], 500); // Code d'erreur 500 pour les erreurs serveur
        }
    }
}
