<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PortfolioRequest;
use App\Services\v1\PortfolioService;


class PortfolioController extends Controller
{
    public function __construct(private PortfolioService $portfolioService)
    {
    }

    public function add(PortfolioRequest $portfolioRequest)
    {
        $data = $portfolioRequest->validated();
        $response = $this->portfolioService->handleAdd($data, auth()->user());
    }

    public function update()
    {

    }
}
