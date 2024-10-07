<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOpportunitySecteurChildrenAPIRequest;
use App\Http\Requests\API\UpdateOpportunitySecteurChildrenAPIRequest;
use App\Models\OpportunitySecteurChildren;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class OpportunitySecteurChildrenAPIController
 */
class OpportunitySecteurChildrenAPIController extends AppBaseController
{
    /**
     * Display a listing of the OpportunitySecteurChildrens.
     * GET|HEAD /opportunity-secteur-children
     */
    public function index(Request $request): JsonResponse
    {
        $query = OpportunitySecteurChildren::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $opportunitySecteurChildrens = $query->get();

        return $this->sendResponse($opportunitySecteurChildrens->toArray(), 'Opportunity Secteur Childrens retrieved successfully');
    }

    /**
     * Store a newly created OpportunitySecteurChildren in storage.
     * POST /opportunity-secteur-children
     */
    public function store(CreateOpportunitySecteurChildrenAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::create($input);

        return $this->sendResponse($opportunitySecteurChildren->toArray(), 'Opportunity Secteur Children saved successfully');
    }

    /**
     * Display the specified OpportunitySecteurChildren.
     * GET|HEAD /opportunity-secteur-children/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::find($id);

        if (empty($opportunitySecteurChildren)) {
            return $this->sendError('Opportunity Secteur Children not found');
        }

        return $this->sendResponse($opportunitySecteurChildren->toArray(), 'Opportunity Secteur Children retrieved successfully');
    }

    /**
     * Update the specified OpportunitySecteurChildren in storage.
     * PUT/PATCH /opportunity-secteur-children/{id}
     */
    public function update($id, UpdateOpportunitySecteurChildrenAPIRequest $request): JsonResponse
    {
        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::find($id);

        if (empty($opportunitySecteurChildren)) {
            return $this->sendError('Opportunity Secteur Children not found');
        }

        $opportunitySecteurChildren->fill($request->all());
        $opportunitySecteurChildren->save();

        return $this->sendResponse($opportunitySecteurChildren->toArray(), 'OpportunitySecteurChildren updated successfully');
    }

    /**
     * Remove the specified OpportunitySecteurChildren from storage.
     * DELETE /opportunity-secteur-children/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var OpportunitySecteurChildren $opportunitySecteurChildren */
        $opportunitySecteurChildren = OpportunitySecteurChildren::find($id);

        if (empty($opportunitySecteurChildren)) {
            return $this->sendError('Opportunity Secteur Children not found');
        }

        $opportunitySecteurChildren->delete();

        return $this->sendSuccess('Opportunity Secteur Children deleted successfully');
    }
}
