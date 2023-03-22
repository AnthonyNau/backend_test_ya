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
        if (!$this->portfolioRepository->confirmSymbol($data['symbol'])) {
            abort(422, 'Wrong symbol for data set.');
        }
        $data['user_id'] = $user->id;
        return Portfolio::create($data);
    }
}
