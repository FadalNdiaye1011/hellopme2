<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends AppBaseController
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        /** @var User $users */
        $users = User::paginate(10);

        return view('users.index')
            ->with('users', $users);
    }


    /**
     * Show the form for creating a new User.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $input['password'] = bcrypt("123456789");

        /** @var User $user */
        $user = User::create($input);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     */
    public function show($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     */
    public function edit($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     */
    public function update($id, Request $request)
    {
        /** @var User $user */
        $user = User::find($id);

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $user->fill($input);
        $user->save();

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user->delete();

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    function assignUserRole(Request $request) {
        $user_id = $request->input('user_id');
        $role_id = $request->input('role_id');
        $role = Role::where('id', $role_id)->first();
        $user = User::where('id', $user_id)->first();

        //Added by MAXBIRD
        if(empty($user) || empty($role)):
            Flash::error('Something wrong : User or Role not found !');
            return redirect()->back();
        endif;
        if($user->hasRole($role->name)):
            Flash::error('Role already assigned to this user !');
            return redirect()->back();
        endif;

        //Reinitialized
        $user->syncRoles([]);

        // Your code
        // if(!empty($user_role)){
        //     dd($user_role);
        //     Flash::error('User already have role.');
        //     return redirect()->back();
        // }

        // if ($role) {
        //     $user->assignRole($role);
        //     Flash::success('Role assigned successfully.');
        //     return redirect()->back();
        // } else {
        //     Flash::error('Role already exist.');
        // }

        // Assign role - added by maxbird
        $user->assignRole($role);
        Flash::success('Role ' . $role->name  . ' assigned successfully to ' . $user->first_name);
        return redirect()->back();



    }

    function assignPermissionToRole(Request $request) {
        $name = $request->input('name');
        $role = Role::create(['name' => $name]);
        if ($role) {
            Flash::success('Role assigned successfully.');
            return redirect()->back();
        } else {
            Flash::error('Role exist.');
        }
    }

    public function parameter_page()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::all();

        return view('parameters.create', compact('roles', 'users', 'permissions'));
    }

}
