<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ModifyPortfolioRequest;
use App\Http\Requests\v1\PortfolioRequest;
use App\Repositories\v1\PortfolioRepository;
use App\Services\v1\PortfolioService;

/**
 * @group Portfolio
 *
 */
class PortfolioController extends Controller
{
    public function __construct(private PortfolioService $portfolioService, private PortfolioRepository $portfolioRepository)
    {
    }


    /**
     * Add portfolio
     *
     * @param PortfolioRequest $portfolioRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(PortfolioRequest $portfolioRequest): \Illuminate\Http\JsonResponse
    {
        $data = $portfolioRequest->validated();
        return $this->portfolioService->handleAdd($data, auth()->user());
    }

    /**
     * Modify portfolio
     * @param ModifyPortfolioRequest $modifyPortfolioRequest
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ModifyPortfolioRequest $modifyPortfolioRequest, $id): \Illuminate\Http\JsonResponse
    {
        $data = $modifyPortfolioRequest->validated();
        return $this->portfolioService->handlerModify($data, $id);
    }

    /**
     * Get User portfolio
     * @return mixed
     */
    public function getPortfolio(): mixed
    {
        return $this->portfolioRepository->getUserPortfolio(auth()->user());
    }
}
