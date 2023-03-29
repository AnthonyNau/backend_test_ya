<?php
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataSetImport;
use App\Models\DataSet;

it('check import data set', function () {
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $dataSet = DataSet::all()->toArray();
    expect($dataSet)->toBeArray()
        ->not()->toBeEmpty();
});













