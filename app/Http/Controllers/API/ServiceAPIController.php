<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServiceAPIRequest;
use App\Http\Requests\API\UpdateServiceAPIRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ServiceAPIController
 */
class ServiceAPIController extends AppBaseController
{
    /**
     * Display a listing of the Services.
     * GET|HEAD /services
     */
    public function index(Request $request): JsonResponse
    {
        $query = Service::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $services = $query->get();

        return $this->sendResponse($services->toArray(), 'Services retrieved successfully');
    }

    /**
     * Store a newly created Service in storage.
     * POST /services
     */
    public function store(CreateServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Service $service */
        $service = Service::create($input);

        return $this->sendResponse($service->toArray(), 'Service saved successfully');
    }

    /**
     * Display the specified Service.
     * GET|HEAD /services/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Service $service */
        $service = Service::find($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        return $this->sendResponse($service->toArray(), 'Service retrieved successfully');
    }

    /**
     * Update the specified Service in storage.
     * PUT/PATCH /services/{id}
     */
    public function update($id, UpdateServiceAPIRequest $request): JsonResponse
    {
        /** @var Service $service */
        $service = Service::find($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        $service->fill($request->all());
        $service->save();

        return $this->sendResponse($service->toArray(), 'Service updated successfully');
    }

    /**
     * Remove the specified Service from storage.
     * DELETE /services/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Service $service */
        $service = Service::find($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        $service->delete();

        return $this->sendSuccess('Service deleted successfully');
    }
}
