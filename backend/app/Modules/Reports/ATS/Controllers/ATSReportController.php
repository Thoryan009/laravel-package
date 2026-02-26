<?php

namespace App\Modules\Reports\ATS\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Reports\ATS\Services\ATSReportService;
use App\Http\Requests\ReportIndexRequest;
use App\Modules\Reports\ATS\Resource\ATSDashboardResource;

class ATSReportController extends Controller
{

    public function index(Request $request, ATSReportService $service)
    {
         $data = $service->getDashboardData();

        return new ATSDashboardResource($data);

    }

     public function show(ReportIndexRequest $request, ATSReportService $service)
    {
         $type = $request->get('type'); // active | expired | expiring | null

        // base filters
        $filters = $request->all();
        $filters['process_id'] = $request->get('process_id');
        $filters['job_list_id']     = $request->get('job_list_id');
        $filters['work_order_id']     = $request->get('work_order_id');

        // 🔹 when type is provided → specific report
        if ($type) {
            $report = $service->resolve($type);
            return $report->generate($filters);
            // generate() already returns ATSResource::collection()
        }

        // 🔹 initial hit → all applications whereHas process
        return $service->getAllAtsReport($filters);


    }

        private function validateRequest(array $data)   : array
        {
            $rules = [
                'type' => 'required|in:active,expired,expiring',
                'process_id' => 'nullable|integer|exists:processes,id',
                'job_list_id' => 'nullable|integer|exists:job_lists,id',
                'work_order_id' => 'nullable|integer|exists:work_orders,id',
            ];

            validator($data, $rules)->validate();
            return $data;
        }
}
