<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ReportRequest;
use App\Services\v1\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(private ReportService $reportService)
    {
    }

    public function get(ReportRequest $reportRequest)
    {

        return $this->reportService->handlerGet($reportRequest->all());
    }
}
