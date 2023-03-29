<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ReportRequest;
use App\Services\v1\ReportService;
use Illuminate\Http\JsonResponse;

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
     * @return JsonResponse
     */
    public function get(ReportRequest $reportRequest): JsonResponse
    {

        $response = $this->reportService->handlerGet($reportRequest->all());
        return response()->json($response);
    }
}
