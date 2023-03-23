<?php

namespace App\Repositories\v1;

use App\Models\DataSet;
use App\Models\Portfolio;

class PortfolioRepository
{
    public function confirmSymbol($symbol)
    {
        try {
            return DataSet::where('symbol', $symbol)->firstOrFail();
        } catch (\Exception) {
            return false;
        }

    }

    public function getPortfolio($id)
    {
        return Portfolio::findOrFail($id);
    }
}
