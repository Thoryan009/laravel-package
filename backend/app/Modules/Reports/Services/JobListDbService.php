<?php
namespace App\Modules\Reports\Services;
use App\Modules\Reports\Contracts\JobServiceInterface;
use App\Modules\JobList\Models\JobList;
use Illuminate\Support\Facades\Cache;

class JobListDbService implements JobServiceInterface
{
    public function getJobs(): array
    {
       // Cache key
        $cacheKey = 'job_list';
        $cacheTTL = 2592000; // 30 days in second

        return Cache::remember($cacheKey, $cacheTTL, function () {
            return JobList::select('id', 'name', 'job_code')
                ->where('status', 'open')
                    ->get()
                    ->map(fn ($job) => [
                        'id'   => $job->id,
                        'name' => $job->name,
                        'job_code' => $job->job_code,
                    ])
                    ->toArray();
        });

    }
}
