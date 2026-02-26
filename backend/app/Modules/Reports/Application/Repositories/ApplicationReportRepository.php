<?php

namespace App\Modules\Reports\Application\Repositories;
use App\Modules\Application\Models\Application;
use Illuminate\Database\Eloquent\Builder;

class ApplicationReportRepository
{
    public function baseQuery(array $filters): Builder
    {
        return Application::query()
            ->with([
                'jobList.workOrder.client.country'
            ])
              ->when($filters['country_id'] ?? null, function ($query, $countryId) {
            $query->whereHas('jobList.workOrder.client.country', function ($q) use ($countryId) {
                $q->where('id', $countryId);
                });
            })
              ->when($filters['client_id'] ?? null, function ($query, $clientId) {
            $query->whereHas('jobList.workOrder.client', function ($q) use ($clientId) {
                $q->where('id', $clientId);
                });
            })
             ->when($filters['work_order_id'] ?? null, function ($query, $workOrderId) {
            $query->whereHas('jobList.workOrder', function ($q) use ($workOrderId) {
                $q->where('id', $workOrderId);
                });
            })
            ->when($filters['job_list_id'] ?? null, function ($query, $jobListId) {
            $query->whereHas('jobList', function ($q) use ($jobListId) {
                $q->where('id', $jobListId);
                });
            })
            ->when($filters['from_date'] ?? null,
                fn ($q, $from) => $q->whereDate('from_date', '>=', $from)
            )
            ->when($filters['to_date'] ?? null,
                fn ($q, $to) => $q->whereDate('to_date', '<=', $to)
            );
    }

    public function filterByApplication(Builder $query, string $application): Builder
    {
        return $query;
    }

}

