<?php

namespace App\Http\Controllers;

use App\Models\TypeFinance;
use Illuminate\Http\Request;

class TypeFinanceController extends Controller
{
    // Afficher la liste des types de financement
    public function index()
    {
        $types = TypeFinance::paginate(10);
        return view('type_finances.index', compact('types'));
    }


    public function show($id)
    {
        // Trouver le type de financement par ID
        $typeFinance = TypeFinance::with('acteursFinances')->findOrFail($id);

        // Retourner les détails du type de financement et les acteurs associés à la vue
        return view('type_finances.show', compact('typeFinance'));
    }

     // Afficher le formulaire pour ajouter un nouveau type de financement
     public function create()
     {
         return view('type_finances.create');
     }

     // Ajouter un nouveau type de financement
     public function store(Request $request)
     {
         // Validation des données
         $request->validate([
             'libelle' => 'required|string|max:255',
         ]);

         // Création d'un nouveau type de financement
         $typeFinance = new TypeFinance();
         $typeFinance->libelle = $request->libelle;
         $typeFinance->save();

         return redirect()->route('type-finances.index')->with('success', 'Type de financement ajouté avec succès');
     }

        // Afficher le formulaire pour modifier un type de financement existant
        public function edit($id)
        {
            $typeFinance = TypeFinance::findOrFail($id);
            $types = TypeFinance::paginate(10);

            return view('type_finances.index', compact('types', 'typeFinance'));
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'libelle' => 'required|string|max:255',
            ]);

            $typeFinance = TypeFinance::findOrFail($id);
            $typeFinance->libelle = $request->libelle;
            $typeFinance->save();

            return redirect()->route('type-finances.index')->with('success', 'Type de financement modifié avec succès');
        }

     // Supprimer un type de financement
     public function destroy($id)
     {
         $typeFinance = TypeFinance::findOrFail($id);
         $typeFinance->delete();

         return redirect()->route('type-finances.index')->with('success', 'Type de financement supprimé avec succès');
     }
}
