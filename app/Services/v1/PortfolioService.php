<?php

namespace App\Services\v1;

use App\Models\Portfolio;
use App\Repositories\v1\PortfolioRepository;

class PortfolioService
{
    public function __construct(private PortfolioRepository $portfolioRepository)
    {
    }

    public function handleAdd($data, $user)
    {
        foreach ($data as $val) {
            if (!$this->portfolioRepository->confirmSymbol($val['symbol'])) {
                return response()->json(['message' => 'Wrong symbol for data set'], 422);
            }
            $val['user_id'] = $user->id;
            Portfolio::create($val);
        }
        return response()->json(['message' => 'Portfolio added'], 200);

    }

    public function handlerModify($data, $id)
    {
        if (!$this->portfolioRepository->confirmSymbol($data['symbol'])) {
            return response()->json(['message' => 'Wrong symbol for data set'], 422);
        }
        $portfolio = $this->portfolioRepository->getPortfolio($id);
        $portfolio['symbol'] = $data['symbol'];
        $portfolio['number_of_shares'] = $data['number_of_shares'];
        $modifyPortfolio = $portfolio->save();
        if ($modifyPortfolio) {
            return response()->json(['message' => 'Portfolio modified'], 200);
        }
        return response()->json(['message' => 'Something went wrong'], 500);
    }
}
