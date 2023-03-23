<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\FileRequest;
use App\Jobs\v1\DataSet\ImportDataSetJob;

/**
 * @group Import csv
 *
 */
class DataSetController extends Controller
{
    /**
     * Import csv
     * @param FileRequest $fileRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(FileRequest $fileRequest): \Illuminate\Http\JsonResponse
    {
        $file = $fileRequest->file('file');

        if (!$file) {
            return response()->json(['error' => 'File not loaded'], 400);
        }
        $fileName = $this->saveFile($file);
        dispatch(new ImportDataSetJob($fileName));

        return response()->json(['message' => 'Data set is uploading'], 200);
    }

    /**
     * Save file
     * @param $file
     * @return mixed
     */
    public function saveFile($file): mixed
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('uploads', $fileName);
    }
}
