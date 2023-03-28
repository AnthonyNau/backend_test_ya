<?php

namespace App\Repositories\v1;

use App\Models\DataSet;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use stdClass;

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
        } catch (Exception) {
            return false;
        }

        return true;
    }

    /**
     * @param $symbol
     * @return Model|Builder|stdClass|null
     */
    public function firstDataSetBySymbol($symbol): Model|Builder|stdClass|null
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->orderBy('date', 'ASC')
            ->first();
    }

    /**
     * @param $symbol
     * @return Model|Builder|stdClass|null
     */
    public function lastDataSetBySymbol($symbol): Model|Builder|stdClass|null
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->orderBy('date', 'DESC')
            ->first();
    }

    /**
     * @param $symbol
     * @param $date
     * @return Model|Builder|stdClass|null
     */
    public function dataSetByDateSymbol($symbol, $date): Model|Builder|stdClass|null
    {
        return DB::table('data_sets')
            ->where('symbol', $symbol)
            ->where('date', $date)
            ->first();
    }

}
