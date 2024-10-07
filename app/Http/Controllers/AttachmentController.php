<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Flash;

class AttachmentController extends AppBaseController
{
    /**
     * Display a listing of the Attachment.
     */
    public function index(Request $request)
    {
        /** @var Attachment $attachments */
        $attachments = Attachment::paginate(10);

        return view('attachments.index')
            ->with('attachments', $attachments);
    }


    /**
     * Show the form for creating a new Attachment.
     */
    public function create()
    {
        return view('attachments.create');
    }

    /**
     * Store a newly created Attachment in storage.
     */
    public function store(CreateAttachmentRequest $request)
    {
        $input = $request->all();

        /** @var Attachment $attachment */
        $attachment = Attachment::create($input);

        Flash::success('Attachment saved successfully.');

        return redirect(route('attachments.index'));
    }

    /**
     * Display the specified Attachment.
     */
    public function show($id)
    {
        /** @var Attachment $attachment */
        $attachment = Attachment::find($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        return view('attachments.show')->with('attachment', $attachment);
    }

    /**
     * Show the form for editing the specified Attachment.
     */
    public function edit($id)
    {
        /** @var Attachment $attachment */
        $attachment = Attachment::find($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        return view('attachments.edit')->with('attachment', $attachment);
    }

    /**
     * Update the specified Attachment in storage.
     */
    public function update($id, UpdateAttachmentRequest $request)
    {
        /** @var Attachment $attachment */
        $attachment = Attachment::find($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        $attachment->fill($request->all());
        $attachment->save();

        Flash::success('Attachment updated successfully.');

        return redirect(route('attachments.index'));
    }

    /**
     * Remove the specified Attachment from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Attachment $attachment */
        $attachment = Attachment::find($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        $attachment->delete();

        Flash::success('Attachment deleted successfully.');

        return redirect(route('attachments.index'));
    }
}
