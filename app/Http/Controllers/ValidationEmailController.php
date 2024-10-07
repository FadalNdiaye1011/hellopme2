<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValidationEmailRequest;
use App\Http\Requests\UpdateValidationEmailRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\ValidationEmail;
use Illuminate\Http\Request;
use Flash;

class ValidationEmailController extends AppBaseController
{
    /**
     * Display a listing of the ValidationEmail.
     */
    public function index(Request $request)
    {
        /** @var ValidationEmail $validationEmails */
        $validationEmails = ValidationEmail::paginate(10);

        return view('validation_emails.index')
            ->with('validationEmails', $validationEmails);
    }


    /**
     * Show the form for creating a new ValidationEmail.
     */
    public function create()
    {
        return view('validation_emails.create');
    }

    /**
     * Store a newly created ValidationEmail in storage.
     */
    public function store(CreateValidationEmailRequest $request)
    {
        $input = $request->all();

        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::create($input);

        Flash::success('Validation Email saved successfully.');

        return redirect(route('validationEmails.index'));
    }

    /**
     * Display the specified ValidationEmail.
     */
    public function show($id)
    {
        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::find($id);

        if (empty($validationEmail)) {
            Flash::error('Validation Email not found');

            return redirect(route('validationEmails.index'));
        }

        return view('validation_emails.show')->with('validationEmail', $validationEmail);
    }

    /**
     * Show the form for editing the specified ValidationEmail.
     */
    public function edit($id)
    {
        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::find($id);

        if (empty($validationEmail)) {
            Flash::error('Validation Email not found');

            return redirect(route('validationEmails.index'));
        }

        return view('validation_emails.edit')->with('validationEmail', $validationEmail);
    }

    /**
     * Update the specified ValidationEmail in storage.
     */
    public function update($id, UpdateValidationEmailRequest $request)
    {
        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::find($id);

        if (empty($validationEmail)) {
            Flash::error('Validation Email not found');

            return redirect(route('validationEmails.index'));
        }

        $validationEmail->fill($request->all());
        $validationEmail->save();

        Flash::success('Validation Email updated successfully.');

        return redirect(route('validationEmails.index'));
    }

    /**
     * Remove the specified ValidationEmail from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var ValidationEmail $validationEmail */
        $validationEmail = ValidationEmail::find($id);

        if (empty($validationEmail)) {
            Flash::error('Validation Email not found');

            return redirect(route('validationEmails.index'));
        }

        $validationEmail->delete();

        Flash::success('Validation Email deleted successfully.');

        return redirect(route('validationEmails.index'));
    }
}
