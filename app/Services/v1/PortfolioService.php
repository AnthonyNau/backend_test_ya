<?php

namespace App\Services\v1;

use App\Models\Portfolio;
use App\Repositories\v1\DataSetRepository;
use App\Repositories\v1\PortfolioRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class PortfolioService
{
    public function __construct(
        private readonly PortfolioRepository $portfolioRepository,
        private readonly DataSetRepository   $dataSetRepository
    )
    {
        //
    }

    /**
     * @param $data
     * @param $user
     * @return JsonResponse
     */
    public function handleAdd($data, $user): JsonResponse
    {
        foreach ($data as $val) {
            if (!$this->dataSetRepository->confirmSymbol($val['symbol'])) {
                return response()->json(['message' => 'Wrong symbol for data set'], 422);
            }

            $val['user_id'] = $user->id;
            Portfolio::create($val);
        }

        return response()->json(['message' => 'Portfolio added'], 200);
    }

    /**
     * @param $data
     * @param $id
     * @return JsonResponse
     */
    public function handlerModify($data, $id): JsonResponse
    {
        if (!$this->dataSetRepository->confirmSymbol($data['symbol'])) {
            return response()->json(['message' => 'Wrong symbol for data set'], 422);
        }

        try {
            $portfolio = $this->portfolioRepository->getPortfolio($id);
        } catch (Exception) {
            return response()->json(['message' => 'Please add the symbol to portfolio first'], 406);
        }

        $portfolio->symbol = $data['symbol'];
        $portfolio->number_of_shares = $data['number_of_shares'];
        $modifyPortfolio = $portfolio->save();

        if ($modifyPortfolio) {
            return response()->json(['message' => 'Portfolio modified'], 200);
        }

        return response()->json(['message' => 'Something went wrong'], 500);
    }
}
