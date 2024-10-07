<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttachmentsRequest;
use App\Http\Requests\UpdateAttachmentsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Attachments;
use Illuminate\Http\Request;
use Flash;

class AttachmentsController extends AppBaseController
{
    /**
     * Display a listing of the Attachments.
     */
    public function index(Request $request)
    {
        /** @var Attachments $attachments */
        $attachments = Attachments::paginate(10);

        return view('attachments.index')
            ->with('attachments', $attachments);
    }


    /**
     * Show the form for creating a new Attachments.
     */
    public function create()
    {
        return view('attachments.create');
    }

    /**
     * Store a newly created Attachments in storage.
     */
    public function store(CreateAttachmentsRequest $request)
    {
        $input = $request->all();

        /** @var Attachments $attachments */
        $attachments = Attachments::create($input);

        Flash::success('Attachments saved successfully.');

        return redirect(route('attachments.index'));
    }

    /**
     * Display the specified Attachments.
     */
    public function show($id)
    {
        /** @var Attachments $attachments */
        $attachments = Attachments::find($id);

        if (empty($attachments)) {
            Flash::error('Attachments not found');

            return redirect(route('attachments.index'));
        }

        return view('attachments.show')->with('attachments', $attachments);
    }

    /**
     * Show the form for editing the specified Attachments.
     */
    public function edit($id)
    {
        /** @var Attachments $attachments */
        $attachments = Attachments::find($id);

        if (empty($attachments)) {
            Flash::error('Attachments not found');

            return redirect(route('attachments.index'));
        }

        return view('attachments.edit')->with('attachments', $attachments);
    }

    /**
     * Update the specified Attachments in storage.
     */
    public function update($id, UpdateAttachmentsRequest $request)
    {
        /** @var Attachments $attachments */
        $attachments = Attachments::find($id);

        if (empty($attachments)) {
            Flash::error('Attachments not found');

            return redirect(route('attachments.index'));
        }

        $attachments->fill($request->all());
        $attachments->save();

        Flash::success('Attachments updated successfully.');

        return redirect(route('attachments.index'));
    }

    /**
     * Remove the specified Attachments from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Attachments $attachments */
        $attachments = Attachments::find($id);

        if (empty($attachments)) {
            Flash::error('Attachments not found');

            return redirect(route('attachments.index'));
        }

        $attachments->delete();

        Flash::success('Attachments deleted successfully.');

        return redirect(route('attachments.index'));
    }
}
