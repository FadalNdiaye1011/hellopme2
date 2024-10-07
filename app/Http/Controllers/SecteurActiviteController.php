<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSecteurActiviteRequest;
use App\Http\Requests\UpdateSecteurActiviteRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\SecteurActivite;
use Illuminate\Http\Request;
use Flash;

class SecteurActiviteController extends AppBaseController
{
    /**
     * Display a listing of the SecteurActivite.
     */
    // public function index(Request $request)
    // {
    //     /** @var SecteurActivite $secteurActivites */
    //     $secteurActivites = SecteurActivite::paginate(10);

    //     return view('secteur_activites.index')
    //         ->with('secteurActivites', $secteurActivites);
    // }

    public function index(Request $request)
    {
        $query = $request->input('search');
        $sortBy = $request->input('sort', 'asc'); // Default to ascending order

        /** @var SecteurActivite $secteurActivites */
        $secteurActivites = SecteurActivite::when($query, function($queryBuilder) use ($query) {
            return $queryBuilder->where('libelle', 'LIKE', "%{$query}%");
        })
        ->orderBy('libelle', $sortBy)
        ->paginate(10);

        // Si la requête est une requête AJAX, ne renvoyer que le tableau partiel
        if ($request->ajax()) {
            return view('secteur_activites.table', compact('secteurActivites'))->render();
        }

        return view('secteur_activites.index')
            ->with('secteurActivites', $secteurActivites)
            ->with('sort', $sortBy); // Pass sort direction to the view
    }

    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    //     $secteurActiviteChildren = SecteurActiviteChildren::where('libelle', 'like', '%' . $search . '%')->paginate(10);

    //     // Si la requête est une requête AJAX, ne renvoyer que le tableau partiel
    //     if ($request->ajax()) {
    //         return view('secteur_activite_children.table', compact('secteurActiviteChildren'))->render();
    //     }

    //     // Sinon, renvoyer la vue complète
    //     return view('secteur_activite_children.index', compact('secteurActiviteChildren'));
    // }




    /**
     * Show the form for creating a new SecteurActivite.
     */
    public function create()
    {
        return view('secteur_activites.create');
    }

    /**
     * Store a newly created SecteurActivite in storage.
     */
    public function store(CreateSecteurActiviteRequest $request)
    {
        $input = $request->all();

        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::create($input);

        Flash::success('Secteur Activite saved successfully.');

        return redirect(route('secteur-activites.index'));
    }

    /**
     * Display the specified SecteurActivite.
     */
    public function show($id)
    {
        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::find($id);

        if (empty($secteurActivite)) {
            Flash::error('Secteur Activite not found');

            return redirect(route('secteur-activites.index'));
        }

        return view('secteur_activites.show')->with('secteurActivite', $secteurActivite);
    }

    /**
     * Show the form for editing the specified SecteurActivite.
     */
    public function edit($id)
    {
        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::find($id);

        if (empty($secteurActivite)) {
            Flash::error('Secteur Activite not found');

            return redirect(route('secteur-activites.index'));
        }

        return view('secteur_activites.edit')->with('secteurActivite', $secteurActivite);
    }

    /**
     * Update the specified SecteurActivite in storage.
     */
    public function update($id, UpdateSecteurActiviteRequest $request)
    {
        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::find($id);

        if (empty($secteurActivite)) {
            Flash::error('Secteur Activite not found');

            return redirect(route('secteur-activites.index'));
        }

        $secteurActivite->fill($request->all());
        $secteurActivite->save();

        Flash::success('Secteur Activite updated successfully.');

        return redirect(route('secteur-activites.index'));
    }

    /**
     * Remove the specified SecteurActivite from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::find($id);

        if (empty($secteurActivite)) {
            Flash::error('Secteur Activite not found');

            return redirect(route('secteur-activites.index'));
        }

        $secteurActivite->delete();

        Flash::success('Secteur Activite deleted successfully.');

        return redirect(route('secteur-activites.index'));
    }
}
