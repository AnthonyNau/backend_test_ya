<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Jobs\v1\DataSet\ImportDataSetJob;


class DataSetController extends Controller
{
    public function import()
    {
        $file = request()->file('file');

        if (!$file) {
            return response()->json(['error' => 'File not loaded'], 400);
        }
        $fileName = $this->saveFile($file);
        dispatch(new ImportDataSetJob($fileName));

        return response()->json(['message' => 'Data set is uploading'], 200);
    }

    public function saveFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('uploads', $fileName);

    }
}
