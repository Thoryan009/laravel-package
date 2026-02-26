<?php

namespace App\Modules\Category\Repositories;

use App\Modules\Category\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
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
