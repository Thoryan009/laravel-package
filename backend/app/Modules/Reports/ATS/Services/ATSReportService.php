<?php

namespace App\Modules\Reports\ATS\Services;

use App\Modules\Reports\ATS\Reports\{
    ActiveProcessReport,
    ExpiredProcessReport,
    ExpiringProcessReport
};
use Illuminate\Support\Facades\Cache;
use App\Modules\Reports\ATS\Repositories\ATSReportRepository;
use App\Modules\Reports\ATS\Resource\ATSResource;
use InvalidArgumentException;

class ATSReportService
{
    public function resolve(string $type)
    {
        return match ($type) {
            'active'   => app(ActiveProcessReport::class),
            'expired'  => app(ExpiredProcessReport::class),
            'expiring' => app(ExpiringProcessReport::class),
            default => throw new InvalidArgumentException('Invalid employee report type'),
        };
    }
       public function getAllAtsReport(array $filters)
    {
        $repository = app(ATSReportRepository::class);

        $query = $repository->baseQuery($filters);

        return ATSResource::collection(
            $query->get()
        );
    }


  public function getDashboardData()
    {
        $cacheKey = 'ats_dashboard_data';

        return Cache::remember($cacheKey, now()->addMinutes(10), function ()  {
            $repository = app(ATSReportRepository::class);

            $baseQuery = $repository->baseQuery($filters = []); // No filters for dashboard, consider all data

            $expired   = $repository->filterByDuration(clone $baseQuery, 100)->count();
            $expiring  = $repository->filterByDuration(clone $baseQuery, 50, 100)->count();
            $active    = $repository->filterByDuration(clone $baseQuery, 0, 50)->count();

            $totalProcess = $expired + $expiring + $active;

            $recentProcesses = (clone $baseQuery)
                ->latest()
                ->take(10)
                ->get();

            return (object)[
                'total_expired_process'  => $expired,
                'total_expiring_process' => $expiring,
                'total_active_process'   => $active,
                'total_process'          => $totalProcess,
                'recent_process_reports' => $recentProcesses,
            ];
        });
    }
}
