<?php

namespace App\Repositories\v1;

use App\Models\DataSet;

class PortfolioRepository
{
    public function confirmSymbol($symbol)
    {
        return DataSet::where('symbol', $symbol)->firstOrFail();
    }
}
