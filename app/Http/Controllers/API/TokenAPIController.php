<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTokenAPIRequest;
use App\Http\Requests\API\UpdateTokenAPIRequest;
use App\Models\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class TokenAPIController
 */
class TokenAPIController extends AppBaseController
{
    /**
     * Display a listing of the Tokens.
     * GET|HEAD /tokens
     */
    public function index(Request $request): JsonResponse
    {
        $query = Token::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $tokens = $query->get();

        return $this->sendResponse($tokens->toArray(), 'Tokens retrieved successfully');
    }

    /**
     * Store a newly created Token in storage.
     * POST /tokens
     */
    public function store(CreateTokenAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Token $token */
        $token = Token::create($input);

        return $this->sendResponse($token->toArray(), 'Token saved successfully');
    }

    /**
     * Display the specified Token.
     * GET|HEAD /tokens/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Token $token */
        $token = Token::find($id);

        if (empty($token)) {
            return $this->sendError('Token not found');
        }

        return $this->sendResponse($token->toArray(), 'Token retrieved successfully');
    }

    /**
     * Update the specified Token in storage.
     * PUT/PATCH /tokens/{id}
     */
    public function update($id, UpdateTokenAPIRequest $request): JsonResponse
    {
        /** @var Token $token */
        $token = Token::find($id);

        if (empty($token)) {
            return $this->sendError('Token not found');
        }

        $token->fill($request->all());
        $token->save();

        return $this->sendResponse($token->toArray(), 'Token updated successfully');
    }

    /**
     * Remove the specified Token from storage.
     * DELETE /tokens/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Token $token */
        $token = Token::find($id);

        if (empty($token)) {
            return $this->sendError('Token not found');
        }

        $token->delete();

        return $this->sendSuccess('Token deleted successfully');
    }
}
