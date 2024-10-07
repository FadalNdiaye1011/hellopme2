<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRoleAPIRequest;
use App\Http\Requests\API\UpdateRoleAPIRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RoleAPIController
 */
class RoleAPIController extends AppBaseController
{
    /**
     * Display a listing of the Roles.
     * GET|HEAD /roles
     */
    public function index(Request $request): JsonResponse
    {
        $query = Role::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $roles = $query->get();

        return $this->sendResponse($roles->toArray(), 'Roles retrieved successfully');
    }

    /**
     * Store a newly created Role in storage.
     * POST /roles
     */
    public function store(CreateRoleAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Role $role */
        $role = Role::create($input);

        return $this->sendResponse($role->toArray(), 'Role saved successfully');
    }

    /**
     * Display the specified Role.
     * GET|HEAD /roles/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        return $this->sendResponse($role->toArray(), 'Role retrieved successfully');
    }

    /**
     * Update the specified Role in storage.
     * PUT/PATCH /roles/{id}
     */
    public function update($id, UpdateRoleAPIRequest $request): JsonResponse
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        $role->fill($request->all());
        $role->save();

        return $this->sendResponse($role->toArray(), 'Role updated successfully');
    }

    /**
     * Remove the specified Role from storage.
     * DELETE /roles/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        $role->delete();

        return $this->sendSuccess('Role deleted successfully');
    }
}
