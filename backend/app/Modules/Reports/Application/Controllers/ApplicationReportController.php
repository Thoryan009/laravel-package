<?php

namespace App\Modules\Reports\Application\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Reports\Application\Services\ApplicationReportService;

class ApplicationReportController extends Controller
{
    public function index(Request $request, ApplicationReportService $service)
    {
        $data = $service->getDashboardData();
        return response()->json($data);

    }

    public function show(Request $request, ApplicationReportService $service)
    {
         $type = $request->get('type'); // application
        $filters = $request->all();

        $filters['country_id'] = $request->get('country_id');
        $filters['client_id'] = $request->get('client_id');
        $filters['job_list_id'] = $request->get('job_list_id');
        $filters['work_order_id'] = $request->get('work_order_id');
        $filters['from_date'] = $request->get('from_date');
        $filters['to_date'] = $request->get('to_date');

        if ($type) {
            $report = $service->resolve($type);
            return $report->generate($filters);
        }
        return $service->getAllApplication($filters);
    }
}

