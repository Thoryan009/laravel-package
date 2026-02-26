<?php
namespace App\Modules\Reports\Services;
use App\Modules\Reports\Contracts\ProcessServiceInterface;
use App\Modules\Application\Models\Process;
use Illuminate\Support\Facades\Cache;

class ProcessDbService implements ProcessServiceInterface
{
    public function getProcesses(): array
    {
        // Cache key
        $cacheKey = 'processes';
        $cacheTTL = 2592000; // 30 days in second

        return Cache::remember($cacheKey, $cacheTTL, function () {
            return Process::select('id', 'name')
                    ->get()
                    ->map(fn ($process) => [
                        'id'   => $process->id,
                        'name' => $process->name,
                    ])
                    ->toArray();
        });

    }
}
