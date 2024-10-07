<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateValidationEmailAPIRequest;
use App\Http\Requests\API\UpdateValidationEmailAPIRequest;
use App\Models\ValidationEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ValidationEmailAPIController
 */
class ValidationEmailAPIController extends AppBaseController
{
    /**
     * Display a listing of the ValidationEmails.
     * GET|HEAD /validation-emails
     */
    public function index(Request $request): JsonResponse
    {
        $query = ValidationEmail::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $validationEmails = $query->get();

        return $this->sendResponse($validationEmails->toArray(), 'Validation Emails retrieved successfully');
    }

    /**
     * Store a newly created ValidationEmail in storage.
     * POST /validation-emails
     */
    public function store(CreateValidationEmailAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::create($input);

        return $this->sendResponse($validationEmail->toArray(), 'Validation Email saved successfully');
    }

    /**
     * Display the specified ValidationEmail.
     * GET|HEAD /validation-emails/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::find($id);

        if (empty($validationEmail)) {
            return $this->sendError('Validation Email not found');
        }

        return $this->sendResponse($validationEmail->toArray(), 'Validation Email retrieved successfully');
    }

    /**
     * Update the specified ValidationEmail in storage.
     * PUT/PATCH /validation-emails/{id}
     */
    public function update($id, UpdateValidationEmailAPIRequest $request): JsonResponse
    {
        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::find($id);

        if (empty($validationEmail)) {
            return $this->sendError('Validation Email not found');
        }

        $validationEmail->fill($request->all());
        $validationEmail->save();

        return $this->sendResponse($validationEmail->toArray(), 'ValidationEmail updated successfully');
    }

    /**
     * Remove the specified ValidationEmail from storage.
     * DELETE /validation-emails/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::find($id);

        if (empty($validationEmail)) {
            return $this->sendError('Validation Email not found');
        }

        $validationEmail->delete();

        return $this->sendSuccess('Validation Email deleted successfully');
    }
}
