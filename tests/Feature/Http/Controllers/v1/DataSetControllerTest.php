<?php

use App\Jobs\v1\DataSet\ImportDataSetJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataSetImport;
use App\Models\DataSet;

it('import csv ', function () {
    Queue::fake();
    $filePath = base_path('data_set_example.csv');
    $file = new UploadedFile(
        base_path('data_set_example.csv'),
        'data_set_example.csv',
        'text/csv',
        null,
        true
    );
    $response = $this->post('/api/v1/data-set/import', [
        'file' => $file,
    ]);
    $response->assertStatus(200);
    $response->assertSee('Data set is uploading');
    Queue::assertPushed(ImportDataSetJob::class);
});

it('check import', function () {
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $dataSet = DataSet::all()->toArray();
    expect($dataSet)->toBeArray()
        ->not()->toBeEmpty();
});













