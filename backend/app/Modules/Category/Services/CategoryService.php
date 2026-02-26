<?php

namespace App\Modules\Category\Services;

use App\Modules\Category\Models\Category;
use App\Services\BaseCachedService;
use App\Modules\Category\Repositories\CategoryRepository;

class CategoryService extends BaseCachedService
{
    public function __construct(protected CategoryRepository $repository)
    {
        parent::__construct(new Category());
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

    public function getCategory(Category $category)
    {
        return $this->remember(
            $this->byIdCacheKey($category->id),
            fn () => $category
        );
    }

    /* ==========================================================
     | Write Operations (Invalidate Cache)
     |========================================================== */

    public function createCategory(array $data)
    {
        $category = $this->mutate(fn() => $this->model->create($data));
        return $category;
    }

    public function updateCategory(Category $category, array $data)
    {
        return $this->mutate(fn() => tap($category)->update($data));
    }

    public function deleteCategory(Category $category): bool
    {
        return $this->mutate(fn() => $category->delete());
    }

    public function bulkDelete(array $ids): int
    {
        return $this->mutate(fn() => $this->model->whereIn('id', $ids)->delete());
    }
}
