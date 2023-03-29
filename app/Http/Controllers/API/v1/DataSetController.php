<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\FileRequest;
use App\Services\v1\DataSetService;
use Illuminate\Http\JsonResponse;

/**
 * @group Import csv
 *
 */
class DataSetController extends Controller
{
    public function __construct(
        private readonly DataSetService $dataSetService
    )
    {
        //
    }

    /**
     * Import csv
     * @param FileRequest $fileRequest
     * @return JsonResponse
     */
    public function import(FileRequest $fileRequest): JsonResponse
    {
        $file = $fileRequest->file('file');

        if (!$file) {
            return response()->json(['error' => 'File not loaded'], 400);
        }
        return $this->dataSetService->handlerImport($file);
    }
}
