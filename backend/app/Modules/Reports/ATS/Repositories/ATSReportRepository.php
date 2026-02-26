<?php

namespace App\Modules\Reports\ATS\Repositories;

use App\Modules\Application\Models\Application;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ATSReportRepository
{
    public function baseQuery(array $filters): Builder
    {
        return Application::query()
            ->whereHas('processes')
            ->with([
                'jobList.workOrder.client',
                'currentProcess.process'
            ])
           ->when($filters['work_order_id'] ?? null, function ($query, $workOrderId) {
            $query->whereHas('jobList.workOrder', function ($q) use ($workOrderId) {
                $q->where('id', $workOrderId);
                });
            })
            ->when($filters['job_list_id'] ?? null, fn ($q, $jobId) =>
                $q->where('job_list_id', $jobId)
            )
            ->when($filters['process_id'] ?? null, function ($query, $processId) {
            $query->whereHas('currentProcess', function ($q) use ($processId) {
                $q->where('process_id', $processId);
                });
            })
            ->when($filters['from_date'] ?? null, fn ($q, $from) =>
                $q->whereDate('created_at', '>=', $from)
            )
            ->when($filters['to_date'] ?? null, fn ($q, $to) =>
                $q->whereDate('created_at', '<=', $to)
            );
    }

    public function filterByDuration(
        Builder $query,
    float $min,
        ?float $max = null
    ): Builder {
        return $query->whereHas('currentProcess', function ($q) use ($min, $max) {
            $q->join('processes', 'processes.id', '=', 'application_processes.process_id')
              ->whereRaw("
                    (DATEDIFF(CURDATE(), application_processes.started_at)
                    / processes.duration) * 100 >= ?
                ", [$min]);

            if (!is_null($max)) {
                $q->whereRaw("
                    (DATEDIFF(CURDATE(), application_processes.started_at)
                    / processes.duration) * 100 < ?
                ", [$max]);
            }
        });
    }
}
