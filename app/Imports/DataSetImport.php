<?php

namespace App\Imports;

use App\Models\DataSet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataSetImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DataSet([
            'symbol' => $row['symbol'],
            'date' => $row['date'],
            'price' => $row['price'],
        ]);
    }
}
