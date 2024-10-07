<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePrescripteurAPIRequest;
use App\Http\Requests\API\UpdatePrescripteurAPIRequest;
use App\Models\Prescripteur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class PrescripteurAPIController
 */
class PrescripteurAPIController extends AppBaseController
{
    /**
     * Display a listing of the Prescripteurs.
     * GET|HEAD /prescripteurs
     */
    public function index(Request $request): JsonResponse
    {
        $query = Prescripteur::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $prescripteurs = $query->get();

        return $this->sendResponse($prescripteurs->toArray(), 'Prescripteurs retrieved successfully');
    }

    /**
     * Store a newly created Prescripteur in storage.
     * POST /prescripteurs
     */
    public function store(CreatePrescripteurAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::create($input);

        return $this->sendResponse($prescripteur->toArray(), 'Prescripteur saved successfully');
    }

    /**
     * Display the specified Prescripteur.
     * GET|HEAD /prescripteurs/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::find($id);

        if (empty($prescripteur)) {
            return $this->sendError('Prescripteur not found');
        }

        return $this->sendResponse($prescripteur->toArray(), 'Prescripteur retrieved successfully');
    }

    /**
     * Update the specified Prescripteur in storage.
     * PUT/PATCH /prescripteurs/{id}
     */
    public function update($id, UpdatePrescripteurAPIRequest $request): JsonResponse
    {
        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::find($id);

        if (empty($prescripteur)) {
            return $this->sendError('Prescripteur not found');
        }

        $prescripteur->fill($request->all());
        $prescripteur->save();

        return $this->sendResponse($prescripteur->toArray(), 'Prescripteur updated successfully');
    }

    /**
     * Remove the specified Prescripteur from storage.
     * DELETE /prescripteurs/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Prescripteur $prescripteur */
        $prescripteur = Prescripteur::find($id);

        if (empty($prescripteur)) {
            return $this->sendError('Prescripteur not found');
        }

        $prescripteur->delete();

        return $this->sendSuccess('Prescripteur deleted successfully');
    }
}
