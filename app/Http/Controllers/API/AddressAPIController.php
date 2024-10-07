<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAddressAPIRequest;
use App\Http\Requests\API\UpdateAddressAPIRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AddressAPIController
 */
class AddressAPIController extends AppBaseController
{
    /**
     * Display a listing of the Addresses.
     * GET|HEAD /addresses
     */
    public function index(Request $request): JsonResponse
    {
        $query = Address::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $addresses = $query->get();

        return $this->sendResponse($addresses->toArray(), 'Addresses retrieved successfully');
    }

    /**
     * Store a newly created Address in storage.
     * POST /addresses
     */
    public function store(CreateAddressAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Address $address */
        $address = Address::create($input);

        return $this->sendResponse($address->toArray(), 'Address saved successfully');
    }

    /**
     * Display the specified Address.
     * GET|HEAD /addresses/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            return $this->sendError('Address not found');
        }

        return $this->sendResponse($address->toArray(), 'Address retrieved successfully');
    }

    /**
     * Update the specified Address in storage.
     * PUT/PATCH /addresses/{id}
     */
    public function update($id, UpdateAddressAPIRequest $request): JsonResponse
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            return $this->sendError('Address not found');
        }

        $address->fill($request->all());
        $address->save();

        return $this->sendResponse($address->toArray(), 'Address updated successfully');
    }

    /**
     * Remove the specified Address from storage.
     * DELETE /addresses/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            return $this->sendError('Address not found');
        }

        $address->delete();

        return $this->sendSuccess('Address deleted successfully');
    }
}
