<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSecteur_activite_childAPIRequest;
use App\Http\Requests\API\UpdateSecteur_activite_childAPIRequest;
use App\Models\Secteur_activite_child;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class Secteur_activite_childAPIController
 */
class Secteur_activite_childAPIController extends AppBaseController
{
    /**
     * Display a listing of the Secteur_activite_children.
     * GET|HEAD /secteur_activite_children
     */
    public function index(Request $request): JsonResponse
    {
        $query = Secteur_activite_child::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $secteurActiviteChildren = $query->get();

        return $this->sendResponse($secteurActiviteChildren->toArray(), 'Secteur Activite Children retrieved successfully');
    }

    /**
     * Store a newly created Secteur_activite_child in storage.
     * POST /secteur_activite_children
     */
    public function store(CreateSecteur_activite_childAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::create($input);

        return $this->sendResponse($secteurActiviteChild->toArray(), 'Secteur Activite Child saved successfully');
    }

    /**
     * Display the specified Secteur_activite_child.
     * GET|HEAD /secteur_activite_children/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::find($id);

        if (empty($secteurActiviteChild)) {
            return $this->sendError('Secteur Activite Child not found');
        }

        return $this->sendResponse($secteurActiviteChild->toArray(), 'Secteur Activite Child retrieved successfully');
    }

    /**
     * Update the specified Secteur_activite_child in storage.
     * PUT/PATCH /secteur_activite_children/{id}
     */
    public function update($id, UpdateSecteur_activite_childAPIRequest $request): JsonResponse
    {
        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::find($id);

        if (empty($secteurActiviteChild)) {
            return $this->sendError('Secteur Activite Child not found');
        }

        $secteurActiviteChild->fill($request->all());
        $secteurActiviteChild->save();

        return $this->sendResponse($secteurActiviteChild->toArray(), 'Secteur_activite_child updated successfully');
    }

    /**
     * Remove the specified Secteur_activite_child from storage.
     * DELETE /secteur_activite_children/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Secteur_activite_child $secteurActiviteChild */
        $secteurActiviteChild = Secteur_activite_child::find($id);

        if (empty($secteurActiviteChild)) {
            return $this->sendError('Secteur Activite Child not found');
        }

        $secteurActiviteChild->delete();

        return $this->sendSuccess('Secteur Activite Child deleted successfully');
    }
}
