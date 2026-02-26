<?php

namespace App\Modules\Category\Repositories;

use App\Modules\Category\Models\SubCategory;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class SubCategoryRepository extends BaseRepository
{
    public function __construct(SubCategory $model)
    {
        parent::__construct($model);
    }

    protected function applyFilters(Builder $query, array $filters): void
    {
        $this->applySearch($query, $filters['search'] ?? null);
        $this->applyDateFilter($query, $filters);
    }

    protected function applySearch(Builder $query, ?string $search): void
    {
        if (!$search) return;

        $query->where('name', 'like', "%{$search}%");
    }
}
