<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFileAPIRequest;
use App\Http\Requests\API\UpdateFileAPIRequest;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class FileAPIController
 */
class FileAPIController extends AppBaseController
{
    /**
     * Display a listing of the Files.
     * GET|HEAD /files
     */
    public function index(Request $request): JsonResponse
    {
        $query = File::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $files = $query->get();

        return $this->sendResponse($files->toArray(), 'Files retrieved successfully');
    }

    /**
     * Store a newly created File in storage.
     * POST /files
     */
    public function store(CreateFileAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var File $file */
        $file = File::create($input);

        return $this->sendResponse($file->toArray(), 'File saved successfully');
    }

    /**
     * Display the specified File.
     * GET|HEAD /files/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var File $file */
        $file = File::find($id);

        if (empty($file)) {
            return $this->sendError('File not found');
        }

        return $this->sendResponse($file->toArray(), 'File retrieved successfully');
    }

    /**
     * Update the specified File in storage.
     * PUT/PATCH /files/{id}
     */
    public function update($id, UpdateFileAPIRequest $request): JsonResponse
    {
        /** @var File $file */
        $file = File::find($id);

        if (empty($file)) {
            return $this->sendError('File not found');
        }

        $file->fill($request->all());
        $file->save();

        return $this->sendResponse($file->toArray(), 'File updated successfully');
    }

    /**
     * Remove the specified File from storage.
     * DELETE /files/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var File $file */
        $file = File::find($id);

        if (empty($file)) {
            return $this->sendError('File not found');
        }

        $file->delete();

        return $this->sendSuccess('File deleted successfully');
    }
}
