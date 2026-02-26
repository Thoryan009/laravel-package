<?php

namespace App\Modules\__MODEL__\Services;

use App\Modules\__MODEL__\Contracts\__PARENT_MODEL__ServiceInterface;
use App\Modules\__PARENT_MODEL__\Models\__PARENT_MODEL__;
use Illuminate\Support\Facades\Cache;

class __PARENT_MODEL__DbService implements __PARENT_MODEL__ServiceInterface
{
    public function get__PLURAL_PARENT_MODEL__(): array
    {
    $cacheKey = '__plural_parent_model___all';
    $cacheTTL = 3600;

      return Cache::remember($cacheKey, $cacheTTL, function () {
            $__plural_parent_model__ = __PARENT_MODEL__::all(); // fetch from DB

            return $__plural_parent_model__->map(function ($__model__) {
                return [
                    'id' => $__model__->id,
                    'name' => $__model__->name,
                ];
            })->toArray();
        });
}
}
