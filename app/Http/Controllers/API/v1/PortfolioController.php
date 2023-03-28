<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ModifyPortfolioRequest;
use App\Http\Requests\v1\PortfolioRequest;
use App\Models\Portfolio;
use App\Repositories\v1\PortfolioRepository;
use App\Services\v1\PortfolioService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * @group Portfolio
 *
 */
class PortfolioController extends Controller
{
    public function __construct(
        private readonly PortfolioService    $portfolioService,
        private readonly PortfolioRepository $portfolioRepository
    )
    {
        //
    }


    /**
     * Add portfolio
     *
     * @param PortfolioRequest $portfolioRequest
     * @return JsonResponse
     */
    public function add(PortfolioRequest $portfolioRequest): JsonResponse
    {
        $data = $portfolioRequest->validated();

        return $this->portfolioService->handleAdd($data, auth()->user());
    }

    /**
     * Modify portfolio
     * @param ModifyPortfolioRequest $modifyPortfolioRequest
     * @param $id
     * @return JsonResponse
     */
    public function update(ModifyPortfolioRequest $modifyPortfolioRequest, $id): JsonResponse
    {
        $data = $modifyPortfolioRequest->validated();

        return $this->portfolioService->handlerModify($data, $id);
    }

    /**
     * Get User portfolio
     * @return Collection|Portfolio
     */
    public function getPortfolio(): Collection|Portfolio
    {
        return $this->portfolioRepository->getUserPortfolio(auth()->user());
    }
}
