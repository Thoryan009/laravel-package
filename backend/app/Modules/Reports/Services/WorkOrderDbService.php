<?php
namespace App\Modules\Reports\Services;
use App\Modules\Reports\Contracts\WorkOrderServiceInterface;
use App\Modules\WorkOrder\Models\WorkOrder;
use Illuminate\Support\Facades\Cache;

class WorkOrderDbService implements WorkOrderServiceInterface
{
    public function getWorkOrders(): array
    {
        // Cache key
        $cacheKey = 'work_order';
        $cacheTTL = 2592000; // 30 days in second

        return Cache::remember($cacheKey, $cacheTTL, function () {
           return WorkOrder::select('id', 'work_order_id')
            ->get()
            ->map(fn ($workOrder) => [
                'id'   => $workOrder->id,
                'name' => $workOrder->work_order_id,
            ])
            ->toArray();
        });

    }
}
