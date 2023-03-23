<?php

namespace App\Repositories\v1;

use App\Models\Portfolio;

class PortfolioRepository
{

    /**
     * @param $user
     * @return mixed
     */
    public function getUserPortfolio($user)
    {
        return Portfolio::where('user_id', $user->id)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPortfolio($id)
    {
        return Portfolio::findOrFail($id);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getUserPortfolioSymbol($user)
    {
        return Portfolio::where('user_id', $user->id)->pluck('symbol')->toArray();
    }

    /**
     * @param $user
     * @param $symbol
     * @return mixed
     */
    public function getUserPortfolioBySymbol($user, $symbol)
    {
        return Portfolio::
        where('user_id', $user->id)->
        where('symbol', $symbol)->value('number_of_shares');
    }
}
