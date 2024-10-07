<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExpertiseDomainAPIRequest;
use App\Http\Requests\API\UpdateExpertiseDomainAPIRequest;
use App\Models\ExpertiseDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ExpertiseDomainAPIController
 */
class ExpertiseDomainAPIController extends AppBaseController
{
    /**
     * Display a listing of the ExpertiseDomains.
     * GET|HEAD /expertise-domains
     */
    public function index(Request $request): JsonResponse
    {
        $query = ExpertiseDomain::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $expertiseDomains = $query->get();

        return $this->sendResponse($expertiseDomains->toArray(), 'Expertise Domains retrieved successfully');
    }

    /**
     * Store a newly created ExpertiseDomain in storage.
     * POST /expertise-domains
     */
    public function store(CreateExpertiseDomainAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::create($input);

        return $this->sendResponse($expertiseDomain->toArray(), 'Expertise Domain saved successfully');
    }

    /**
     * Display the specified ExpertiseDomain.
     * GET|HEAD /expertise-domains/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::find($id);

        if (empty($expertiseDomain)) {
            return $this->sendError('Expertise Domain not found');
        }

        return $this->sendResponse($expertiseDomain->toArray(), 'Expertise Domain retrieved successfully');
    }

    /**
     * Update the specified ExpertiseDomain in storage.
     * PUT/PATCH /expertise-domains/{id}
     */
    public function update($id, UpdateExpertiseDomainAPIRequest $request): JsonResponse
    {
        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::find($id);

        if (empty($expertiseDomain)) {
            return $this->sendError('Expertise Domain not found');
        }

        $expertiseDomain->fill($request->all());
        $expertiseDomain->save();

        return $this->sendResponse($expertiseDomain->toArray(), 'ExpertiseDomain updated successfully');
    }

    /**
     * Remove the specified ExpertiseDomain from storage.
     * DELETE /expertise-domains/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ExpertiseDomain $expertiseDomain */
        $expertiseDomain = ExpertiseDomain::find($id);

        if (empty($expertiseDomain)) {
            return $this->sendError('Expertise Domain not found');
        }

        $expertiseDomain->delete();

        return $this->sendSuccess('Expertise Domain deleted successfully');
    }
}
