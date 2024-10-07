<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserAbonnementRequest;
use App\Http\Requests\UpdateUserAbonnementRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\UserAbonnement;
use Illuminate\Http\Request;
use Flash;

class UserAbonnementController extends AppBaseController
{
    /**
     * Display a listing of the UserAbonnement.
     */
    public function index(Request $request)
    {
        /** @var UserAbonnement $userAbonnements */
        $userAbonnements = UserAbonnement::paginate(10);

        return view('user_abonnements.index')
            ->with('userAbonnements', $userAbonnements);
    }


    /**
     * Show the form for creating a new UserAbonnement.
     */
    public function create()
    {
        return view('user_abonnements.create');
    }

    /**
     * Store a newly created UserAbonnement in storage.
     */
    public function store(CreateUserAbonnementRequest $request)
    {
        $input = $request->all();

        /** @var UserAbonnement $userAbonnement */
        $userAbonnement = UserAbonnement::create($input);

        Flash::success('User Abonnement saved successfully.');

        return redirect(route('user-abonnements.index'));
    }

    /**
     * Display the specified UserAbonnement.
     */
    public function show($id)
    {
        /** @var UserAbonnement $userAbonnement */
        $userAbonnement = UserAbonnement::find($id);

        if (empty($userAbonnement)) {
            Flash::error('User Abonnement not found');

            return redirect(route('user-abonnements.index'));
        }

        return view('user_abonnements.show')->with('userAbonnement', $userAbonnement);
    }

    /**
     * Show the form for editing the specified UserAbonnement.
     */
    public function edit($id)
    {
        /** @var UserAbonnement $userAbonnement */
        $userAbonnement = UserAbonnement::find($id);

        if (empty($userAbonnement)) {
            Flash::error('User Abonnement not found');

            return redirect(route('user-abonnements.index'));
        }

        return view('user_abonnements.edit')->with('userAbonnement', $userAbonnement);
    }

    /**
     * Update the specified UserAbonnement in storage.
     */
    public function update($id, UpdateUserAbonnementRequest $request)
    {
        /** @var UserAbonnement $userAbonnement */
        $userAbonnement = UserAbonnement::find($id);

        if (empty($userAbonnement)) {
            Flash::error('User Abonnement not found');

            return redirect(route('user-abonnements.index'));
        }

        $userAbonnement->fill($request->all());
        $userAbonnement->save();

        Flash::success('User Abonnement updated successfully.');

        return redirect(route('user-abonnements.index'));
    }

    /**
     * Remove the specified UserAbonnement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var UserAbonnement $userAbonnement */
        $userAbonnement = UserAbonnement::find($id);

        if (empty($userAbonnement)) {
            Flash::error('User Abonnement not found');

            return redirect(route('user-abonnements.index'));
        }

        $userAbonnement->delete();

        Flash::success('User Abonnement deleted successfully.');

        return redirect(route('user-abonnements.index'));
    }
}
