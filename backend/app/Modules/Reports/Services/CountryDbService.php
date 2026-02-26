<?php
namespace App\Modules\Reports\Services;
use Illuminate\Support\Facades\Cache;
use App\Modules\Country\Models\Country;
use App\Modules\Reports\Contracts\CountryServiceInterface;

class CountryDbService implements CountryServiceInterface
{
    public function getCountries(): array
    {
       // Cache key
        $cacheKey = 'countries';
        $cacheTTL = 2592000; // 30 days in second

        return Cache::remember($cacheKey, $cacheTTL, function () {
            return Country::query()
                ->select('id', 'name')
                ->get()
                ->map(fn($country) => [
                    'id' => $country->id,
                    'name' => $country->name,
                ])->toArray();
        });

    }
}
