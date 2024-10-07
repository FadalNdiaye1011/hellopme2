<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
      // Afficher la liste des types de financement
      public function index()
      {
          $services = Service::paginate(10);
          return view('service.index', compact('services'));
      }


      public function show($id)
      {
          // Trouver le type de financement par ID
          $service = Service::findOrFail($id);

          // Retourner les détails du type de financement et les acteurs associés à la vue
          return view('service.show', compact('service'));
      }

       // Afficher le formulaire pour ajouter un nouveau type de financement
       public function create()
       {
           return view('service.create');
       }

       // Ajouter un nouveau type de financement
       public function store(Request $request)
       {
           // Validation des données
           $request->validate([
               'libelle' => 'required|string|max:255',
           ]);

           // Création d'un nouveau type de financement
           $service = new Service();
           $service->libelle = $request->libelle;
           $service->save();

           return redirect()->route('services.index')->with('success', 'Type de financement ajouté avec succès');
       }

          // Afficher le formulaire pour modifier un type de financement existant
          public function edit($id)
          {
              $service = Service::findOrFail($id);
              $services = Service::paginate(10);

              return view('service.index', compact('services', 'service'));
          }

          public function update(Request $request, $id)
          {
              $request->validate([
                  'libelle' => 'required|string|max:255',
              ]);

              $service = Service::findOrFail($id);
              $service->libelle = $request->libelle;
              $service->save();

              return redirect()->route('services.index')->with('success', 'Type de financement modifié avec succès');
          }

       // Supprimer un type de financement
       public function destroy($id)
       {
           $service = service::findOrFail($id);
           $service->delete();

           return redirect()->route('services.index')->with('success', 'Type de financement supprimé avec succès');
       }
}
