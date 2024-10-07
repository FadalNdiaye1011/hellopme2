<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSecteur_activite_childRequest;
use App\Http\Requests\UpdateSecteur_activite_childRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Secteur_activite_child;
use App\Models\SecteurActivite;
use App\Models\SecteurActiviteChildren;
use Illuminate\Http\Request;
use Flash;

class Secteur_activite_childController extends AppBaseController
{
    /**
     * Display a listing of the Secteur_activite_child.
     */
    // public function index(Request $request)
    // {
    //     // Récupérer le terme de recherche s'il existe
    //     $search = $request->input('search');

    //     // Si un terme de recherche est fourni, filtrer les résultats
    //     if ($search) {

    //         $secteurActiviteChildren = Secteur_activite_child::with('secteurActivite')
    //         ->where('libelle', 'like', '%' . $request->input('search') . '%')
    //         ->paginate(10);
    //     } else {
    //         // Sinon afficher la liste normale
    //         $secteurActiviteChildren = Secteur_activite_child::paginate(10);
    //     }

    //     return view('secteur_activite_children.index')
    //         ->with('secteurActiviteChildren', $secteurActiviteChildren);
    // }


    public function index(Request $request)
{
    $search = $request->input('search');
    $secteurActiviteChildren = SecteurActiviteChildren::where('libelle', 'like', '%' . $search . '%')->paginate(10);

    // Si la requête est une requête AJAX, ne renvoyer que le tableau partiel
    if ($request->ajax()) {
        return view('secteur_activite_children.table', compact('secteurActiviteChildren'))->render();
    }

    // Sinon, renvoyer la vue complète
    return view('secteur_activite_children.index', compact('secteurActiviteChildren'));
}



    /**
     * Show the form for creating a new Secteur_activite_child.
     */
    public function create()
    {
        $secteurActivites = SecteurActivite::all();

        return view('secteur_activite_children.create')
        ->with('secteurActivites', $secteurActivites);
    }

    /**
     * Store a newly created Secteur_activite_child in storage.
     */
    public function store(CreateSecteur_activite_childRequest $request)
    {
        $input = $request->all();

        // dd($input);

        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::create($input);

        Flash::success('Secteur Activite Child saved successfully.');

        return redirect(route('secteur-activite-children.index'));
    }

    /**
     * Display the specified Secteur_activite_child.
     */
    public function show($id)
    {
        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::find($id);

        if (empty($secteurActiviteChild)) {
            Flash::error('Secteur Activite Child not found');

            return redirect(route('secteur-activite-children.index'));
        }

        return view('secteur_activite_children.show')->with('secteurActiviteChild', $secteurActiviteChild);
    }

    /**
     * Show the form for editing the specified Secteur_activite_child.
     */
    public function edit($id)
    {
        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::find($id);
        $secteurActivites = SecteurActivite::all();
        if (empty($secteurActiviteChild)) {
            Flash::error('Secteur Activite Child not found');

            return redirect(route('secteur-activite-children.index'));
        }

        return view('secteur_activite_children.edit')
        ->with('secteurActiviteChild', $secteurActiviteChild)
        ->with('secteurActivites', $secteurActivites);

    }

    /**
     * Update the specified Secteur_activite_child in storage.
     */
    public function update($id, UpdateSecteur_activite_childRequest $request)
    {
        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::find($id);

        if (empty($secteurActiviteChild)) {
            Flash::error('Secteur Activite Child not found');

            return redirect(route('secteur-activite-children.index'));
        }

        $secteurActiviteChild->fill($request->all());
        $secteurActiviteChild->save();

        Flash::success('Secteur Activite Child updated successfully.');

        return redirect(route('secteur-activite-children.index'));
    }

    /**
     * Remove the specified Secteur_activite_child from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::find($id);

        if (empty($secteurActiviteChild)) {
            Flash::error('Secteur Activite Child not found');

            return redirect(route('secteur-activite-children.index'));
        }

        $secteurActiviteChild->delete();

        Flash::success('Secteur Activite Child deleted successfully.');

        return redirect(route('secteur-activite-children.index'));
    }
}
