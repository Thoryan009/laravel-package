<?php

namespace App\Modules\Client\Services;

use App\Modules\Client\Models\SubCategory;
use App\Services\BaseCachedService;
use App\Modules\Client\Repositories\SubCategoryRepository;

class SubCategoryService extends BaseCachedService
{
    public function __construct(protected SubCategoryRepository $repository)
    {
        parent::__construct(new SubCategory());
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

    public function getSubCategory(SubCategory $subCategory)
    {
        return $this->remember(
            $this->byIdCacheKey($subCategory->id),
            fn () => $subCategory
        );
    }

    /* ==========================================================
     | Write Operations (Invalidate Cache)
     |========================================================== */

    public function createSubCategory(array $data)
    {
        $subCategory = $this->mutate(fn() => $this->model->create($data));
        return $subCategory;
    }

    public function updateSubCategory(SubCategory $subCategory, array $data)
    {
        return $this->mutate(fn() => tap($subCategory)->update($data));
    }

    public function deleteSubCategory(SubCategory $subCategory): bool
    {
        return $this->mutate(fn() => $subCategory->delete());
    }

    public function bulkDelete(array $ids): int
    {
        return $this->mutate(fn() => $this->model->whereIn('id', $ids)->delete());
    }
}
