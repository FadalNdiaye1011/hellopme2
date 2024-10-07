<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Controllers\AppBaseController;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Flash;

class PermissionController extends AppBaseController
{
    /**
     * Display a listing of the Permission.
     */
    public function index(Request $request)
    {
        /** @var Permission $permissions */
        $permissions = Permission::paginate(10);

        return view('permissions.index')
            ->with('permissions', $permissions);
    }


    /**
     * Show the form for creating a new Permission.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     */
    public function store(Request $request)
    {
        $name = $request['name'];

        /** @var Permission $permission */
        $permission = Permission::create([
            'name' => $name,
            'guard_name' => 'web',
        ]);

        Flash::success('Permission saved successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permission.
     */
    public function show($id)
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        return view('permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     */
    public function edit($id)
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        return view('permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $permission->fill($request->all());
        $permission->save();

        Flash::success('Permission updated successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $permission->delete();

        Flash::success('Permission deleted successfully.');

        return redirect(route('permissions.index'));
    }
}
