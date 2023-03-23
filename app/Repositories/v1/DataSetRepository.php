<?php

namespace App\Repositories\v1;

use App\Models\DataSet;
use Illuminate\Support\Facades\DB;

class DataSetRepository
{
    public function confirmSymbol($symbol)
    {
        try {
            return DataSet::where('symbol', $symbol)->firstOrFail();
        } catch (\Exception) {
            return false;
        }
    }

    public function firstDataSetBySymbol($symbol)
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->orderBy('date', 'ASC')
            ->first();
    }

    public function lastDataSetBySymbol($symbol)
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->orderBy('date', 'DESC')
            ->first();
    }

    public function dataSetByDateSymbol($symbol, $date)
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->where('date', $date)
            ->first();
    }

}
