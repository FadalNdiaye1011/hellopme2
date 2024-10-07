<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAttachmentAPIRequest;
use App\Http\Requests\API\UpdateAttachmentAPIRequest;
use App\Models\Attachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AttachmentAPIController
 */
class AttachmentAPIController extends AppBaseController
{
    /**
     * Display a listing of the Attachments.
     * GET|HEAD /attachments
     */
    public function index(Request $request): JsonResponse
    {
        $query = Attachment::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $attachments = $query->get();

        return $this->sendResponse($attachments->toArray(), 'Attachments retrieved successfully');
    }

    /**
     * Store a newly created Attachment in storage.
     * POST /attachments
     */
    public function store(CreateAttachmentAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Attachment $attachment */
        $attachment = Attachment::create($input);

        return $this->sendResponse($attachment->toArray(), 'Attachment saved successfully');
    }

    /**
     * Display the specified Attachment.
     * GET|HEAD /attachments/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Attachment $attachment */
        $attachment = Attachment::find($id);

        if (empty($attachment)) {
            return $this->sendError('Attachment not found');
        }

        return $this->sendResponse($attachment->toArray(), 'Attachment retrieved successfully');
    }

    /**
     * Update the specified Attachment in storage.
     * PUT/PATCH /attachments/{id}
     */
    public function update($id, UpdateAttachmentAPIRequest $request): JsonResponse
    {
        /** @var Attachment $attachment */
        $attachment = Attachment::find($id);

        if (empty($attachment)) {
            return $this->sendError('Attachment not found');
        }

        $attachment->fill($request->all());
        $attachment->save();

        return $this->sendResponse($attachment->toArray(), 'Attachment updated successfully');
    }

    /**
     * Remove the specified Attachment from storage.
     * DELETE /attachments/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Attachment $attachment */
        $attachment = Attachment::find($id);

        if (empty($attachment)) {
            return $this->sendError('Attachment not found');
        }

        $attachment->delete();

        return $this->sendSuccess('Attachment deleted successfully');
    }
}
