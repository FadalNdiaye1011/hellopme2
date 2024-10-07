<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRateTariffAPIRequest;
use App\Http\Requests\API\UpdateRateTariffAPIRequest;
use App\Models\RateTariff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RateTariffAPIController
 */
class RateTariffAPIController extends AppBaseController
{
    /**
     * Display a listing of the RateTariffs.
     * GET|HEAD /rate-tariffs
     */
    public function index(Request $request): JsonResponse
    {
        $query = RateTariff::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $rateTariffs = $query->get();

        return $this->sendResponse($rateTariffs->toArray(), 'Rate Tariffs retrieved successfully');
    }

    /**
     * Store a newly created RateTariff in storage.
     * POST /rate-tariffs
     */
    public function store(CreateRateTariffAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::create($input);

        return $this->sendResponse($rateTariff->toArray(), 'Rate Tariff saved successfully');
    }

    /**
     * Display the specified RateTariff.
     * GET|HEAD /rate-tariffs/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::find($id);

        if (empty($rateTariff)) {
            return $this->sendError('Rate Tariff not found');
        }

        return $this->sendResponse($rateTariff->toArray(), 'Rate Tariff retrieved successfully');
    }

    /**
     * Update the specified RateTariff in storage.
     * PUT/PATCH /rate-tariffs/{id}
     */
    public function update($id, UpdateRateTariffAPIRequest $request): JsonResponse
    {
        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::find($id);

        if (empty($rateTariff)) {
            return $this->sendError('Rate Tariff not found');
        }

        $rateTariff->fill($request->all());
        $rateTariff->save();

        return $this->sendResponse($rateTariff->toArray(), 'RateTariff updated successfully');
    }

    /**
     * Remove the specified RateTariff from storage.
     * DELETE /rate-tariffs/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var RateTariff $rateTariff */
        $rateTariff = RateTariff::find($id);

        if (empty($rateTariff)) {
            return $this->sendError('Rate Tariff not found');
        }

        $rateTariff->delete();

        return $this->sendSuccess('Rate Tariff deleted successfully');
    }
}
