<?php

namespace App\Modules\Client\Services;

use App\Modules\Client\Contracts\CountryServiceInterface;
use App\Modules\Country\Models\Country;
use Illuminate\Support\Facades\Cache;

class CountryDbService implements CountryServiceInterface
{
    public $cacheKey = 'countries_all';
    public function getCountries(): array
    {
        $cacheKey = $this->cacheKey;
        $cacheTTL = 3600;
        return Cache::remember($cacheKey, $cacheTTL, function () {
            $countries = Country::all(); // fetch from DB

            return $countries->map(function ($country) {
                return [
                    'id' => $country->id,
                    'name' => $country->name,
                ];
            })->toArray();
        });
    }

}
