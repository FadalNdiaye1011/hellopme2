<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Controllers\AppBaseController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Flash;
use FontLib\Table\Type\name;

class RoleController extends AppBaseController
{
    /**
     * Display a listing of the Role.
     */
    public function index(Request $request)
    {
        /** @var Role $roles */
        $roles = Role::paginate(10);

        return view('roles.index')
            ->with('roles', $roles);
    }


    /**
     * Show the form for creating a new Role.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created Role in storage.
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        $name = $request['name'];

        $role = Role::create([
            'name' => $name,
            'guard_name' => 'web',
        ]);

        /** @var Role $role */
        $role->syncPermissions($request['permissions']);
        Flash::success('Role saved successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     */
    public function show($id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     */
    public function edit($id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        return view('roles.edit')->with('role', $role);
    }

    /**
     * Update the specified Role in storage.
     */
    public function update($id, UpdateRoleRequest $request)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $role->fill($request->all());
        $role->save();

        Flash::success('Role updated successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $role->delete();

        Flash::success('Role deleted successfully.');

        return redirect(route('roles.index'));
    }
}
