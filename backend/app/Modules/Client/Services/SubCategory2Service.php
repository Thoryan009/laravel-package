<?php

namespace App\Modules\Client\Services;

use App\Modules\Client\Models\SubCategory2;
use App\Services\BaseCachedService;
use App\Modules\Client\Repositories\SubCategory2Repository;

class SubCategory2Service extends BaseCachedService
{
    public function __construct(protected SubCategory2Repository $repository)
    {
        parent::__construct(new SubCategory2());
    }

    /* ==========================================================
     | Read Operations (Cached)
     |========================================================== */

    public function getPaginatedDataWithCache(array $filters = [])
    {
        return $this->remember(
            $this->filtersCacheKey($filters),
            fn () => $this->repository->getPaginatedData($filters)
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getSubCategory2(SubCategory2 $subCategory2)
    {
        return $this->remember(
            $this->byIdCacheKey($subCategory2->id),
            fn () => $subCategory2
        );
    }

    /* ==========================================================
     | Write Operations (Invalidate Cache)
     |========================================================== */

    public function createSubCategory2(array $data)
    {
        $subCategory2 = $this->mutate(fn() => $this->model->create($data));
        return $subCategory2;
    }

    public function updateSubCategory2(SubCategory2 $subCategory2, array $data)
    {
        return $this->mutate(fn() => tap($subCategory2)->update($data));
    }

    public function deleteSubCategory2(SubCategory2 $subCategory2): bool
    {
        return $this->mutate(fn() => $subCategory2->delete());
    }

    public function bulkDelete(array $ids): int
    {
        return $this->mutate(fn() => $this->model->whereIn('id', $ids)->delete());
    }
}
