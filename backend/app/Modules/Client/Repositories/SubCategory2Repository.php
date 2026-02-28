<?php

namespace App\Modules\Client\Repositories;

use App\Modules\Client\Models\SubCategory2;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class SubCategory2Repository extends BaseRepository
{
    public function __construct(SubCategory2 $model)
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
