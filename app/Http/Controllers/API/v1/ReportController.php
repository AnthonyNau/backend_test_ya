<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ReportRequest;
use App\Services\v1\ReportService;

/**
 * @group Report
 *
 */
class ReportController extends Controller
{
    public function __construct(private ReportService $reportService)
    {
    }

    /**
     * Get report
     * @param ReportRequest $reportRequest
     * @return array
     */
    public function get(ReportRequest $reportRequest): array
    {

        return $this->reportService->handlerGet($reportRequest->all());
    }
}
