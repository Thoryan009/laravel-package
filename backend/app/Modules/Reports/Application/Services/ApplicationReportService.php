<?php

namespace App\Modules\Reports\Application\Services;
use App\Modules\Reports\Application\Reports\{
    ApplicationReport,

};
use App\Modules\Reports\Application\Repositories\ApplicationReportRepository;
use App\Modules\Reports\Application\Resources\ApplicationReportResource;
use InvalidArgumentException;
use App\Modules\Application\Models\ApplicationProcess;
use Illuminate\Support\Facades\Cache;

class ApplicationReportService
{
    public function resolve(string $type)
    {
        return match ($type) {
            'application' => app(ApplicationReport::class),
            default     => throw new InvalidArgumentException('Invalid application report type'),
        };
    }

    public function getAllApplication(array $filters)
    {
        $repository = app(ApplicationReportRepository::class);

        return ApplicationReportResource::collection(
            $repository->baseQuery($filters)->get()
        );
    }

    public function getDashboardData()
    {
         $cacheKey = 'application_dashboard_data';

         return Cache::remember($cacheKey, now()->addMinutes(10), function ()  {
            $repository = app(ApplicationReportRepository::class);

            $baseQuery = $repository->baseQuery($filters = []); // No filters for dashboard, consider all data

            $totalApplications = $baseQuery->count();
            $totalApplicationProcess = ApplicationProcess::count();
            $recentApplications = $baseQuery->latest()->take(10)->get();

            return [
                'total_applications' => $totalApplications,
                'total_application_process' => $totalApplicationProcess,
                'recent_applications' => ApplicationReportResource::collection($recentApplications),
            ];
         });
    }
}


