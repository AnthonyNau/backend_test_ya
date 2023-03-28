<?php

namespace App\Repositories\v1;

use App\Models\Portfolio;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PortfolioRepository
{

    /**
     * @param $user
     * @return Portfolio|Collection
     */
    public function getUserPortfolio($user): Portfolio|Collection
    {
        return Portfolio::where('user_id', $user->id)->get();
    }

    /**
     * @param $id
     * @return Portfolio
     * @throws Exception
     */
    public function getPortfolio($id): Portfolio
    {
        return Portfolio::findOrFail($id);
    }

    /**
     * @param $user
     * @return array
     */
    public function getUserPortfolioSymbol($user): array
    {
        return Portfolio::where('user_id', $user->id)
            ->pluck('symbol')
            ->toArray();
    }

    /**
     * @param $user
     * @param $symbol
     * @return mixed
     */
    public function getUserPortfolioBySymbol($user, $symbol): mixed
    {
        return Portfolio::where('user_id', $user->id)
            ->where('symbol', $symbol)
            ->value('number_of_shares');
    }
}
