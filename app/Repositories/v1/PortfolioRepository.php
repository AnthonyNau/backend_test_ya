<?php

namespace App\Repositories\v1;

use App\Models\Portfolio;

class PortfolioRepository
{

    public function getUserPortfolio($user)
    {
        return Portfolio::where('user_id', $user->id)->get();
    }

    public function getPortfolio($id)
    {
        return Portfolio::findOrFail($id);
    }

    public function getUserPortfolioSymbol($user)
    {
        return Portfolio::where('user_id', $user->id)->pluck('symbol')->toArray();
    }

    public function getUserPortfolioBySymbol($user, $symbol)
    {
        return Portfolio::
        where('user_id', $user->id)->
        where('symbol', $symbol)->value('number_of_shares');
    }
}
