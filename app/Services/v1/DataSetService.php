<?php

namespace App\Services\v1;

use App\Jobs\v1\DataSet\ImportDataSetJob;
use Illuminate\Http\JsonResponse;

class DataSetService
{
    /**
     * @param $file
     * @return JsonResponse
     */
    public function handlerImport($file): JsonResponse
    {
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
