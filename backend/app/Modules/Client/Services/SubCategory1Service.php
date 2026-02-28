<?php

namespace App\Modules\Client\Services;

use App\Modules\Client\Models\SubCategory1;
use App\Services\BaseCachedService;
use App\Modules\Client\Repositories\SubCategory1Repository;

class SubCategory1Service extends BaseCachedService
{
    public function __construct(protected SubCategory1Repository $repository)
    {
        parent::__construct(new SubCategory1());
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

    public function getSubCategory1(SubCategory1 $subCategory1)
    {
        return $this->remember(
            $this->byIdCacheKey($subCategory1->id),
            fn () => $subCategory1
        );
    }

    /* ==========================================================
     | Write Operations (Invalidate Cache)
     |========================================================== */

    public function createSubCategory1(array $data)
    {
        $subCategory1 = $this->mutate(fn() => $this->model->create($data));
        return $subCategory1;
    }

    public function updateSubCategory1(SubCategory1 $subCategory1, array $data)
    {
        return $this->mutate(fn() => tap($subCategory1)->update($data));
    }

    public function deleteSubCategory1(SubCategory1 $subCategory1): bool
    {
        return $this->mutate(fn() => $subCategory1->delete());
    }

    public function bulkDelete(array $ids): int
    {
        return $this->mutate(fn() => $this->model->whereIn('id', $ids)->delete());
    }
}
