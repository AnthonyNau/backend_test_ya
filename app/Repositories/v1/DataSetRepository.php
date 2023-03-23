<?php

namespace App\Repositories\v1;

use App\Models\DataSet;
use Illuminate\Support\Facades\DB;

class DataSetRepository
{
    /**
     * @param $symbol
     * @return false
     */
    public function confirmSymbol($symbol): bool
    {
        try {
            DataSet::where('symbol', $symbol)->firstOrFail();
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    /**
     * @param $symbol
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function firstDataSetBySymbol($symbol)
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->orderBy('date', 'ASC')
            ->first();
    }

    /**
     * @param $symbol
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function lastDataSetBySymbol($symbol)
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->orderBy('date', 'DESC')
            ->first();
    }

    /**
     * @param $symbol
     * @param $date
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function dataSetByDateSymbol($symbol, $date)
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->where('date', $date)
            ->first();
    }

}
