<?php

namespace App\Services\v1;

use App\Repositories\v1\DataSetRepository;
use App\Repositories\v1\PortfolioRepository;
use stdClass;

class ReportService
{
    public function __construct(private PortfolioRepository $portfolioRepository, private DataSetRepository $dataSetRepository)
    {
    }

    /**
     * @param $data
     * @return array
     */
    public function handlerGet($data)
    {
        $userPortfolioSymbols = empty($data['symbol']) ? $this->portfolioRepository->getUserPortfolioSymbol(auth()->user()) : [$data['symbol']];
        $date = $data['date'] ?? null;
        $report = [];
        foreach ($userPortfolioSymbols as $symbol) {
            $firstDataSets = $this->dataSetRepository->firstDataSetBySymbol($symbol);
            $currentDataSets = $date ? $this->dataSetRepository->dataSetByDateSymbol($symbol, $date) : $this->dataSetRepository->lastDataSetBySymbol($symbol);

            $numberOfShares = $this->portfolioRepository->getUserPortfolioBySymbol(auth()->user(), $symbol);
            $report[$symbol] = $this->calculate($numberOfShares, $firstDataSets, $currentDataSets);

        }
        $report['portfolio_value'] = $this->calculateTotalPortfolioValue($report);
        return $report;
    }

    /**
     * @param $numberOfShares
     * @param $firstDataSets
     * @param $currentDataSets
     * @return stdClass
     */
    private function calculate($numberOfShares, $firstDataSets, $currentDataSets)
    {
        $result = new stdClass();
        $result->firstAvailableDateValue = $numberOfShares * $firstDataSets->price;
        $result->currentValue = $numberOfShares * $currentDataSets->price;
        $result->changeDifValue = $result->currentValue - $result->firstAvailableDateValue;
        $result->changeDifPercent = ($result->currentValue - $result->firstAvailableDateValue) / $result->firstAvailableDateValue * 100;

        return $result;
    }

    /**
     * @param $portfolio
     * @return stdClass
     */
    private function calculateTotalPortfolioValue($portfolio)
    {
        $result = new stdClass();

        $totalCurrentValue = 0;
        $totalFirstValue = 0;

        foreach ($portfolio as $val) {
            $totalCurrentValue += $val->currentValue;
        }
        foreach ($portfolio as $val) {
            $totalFirstValue += $val->firstAvailableDateValue;
        }
        $result->totalCurrentValue = $totalCurrentValue;
        $result->totalfirstAvailableDateValue = $totalFirstValue;
        $result->changeDifValue = $totalCurrentValue - $totalFirstValue;
        $result->changeDifPercent = ($totalCurrentValue - $totalFirstValue) / $totalFirstValue * 100;

        return $result;
    }

}
