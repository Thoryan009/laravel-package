<?php
namespace App\Modules\Reports\Services;
use App\Modules\Reports\Contracts\ClientServiceInterface;
use App\Modules\Client\Models\Client;
use Illuminate\Support\Facades\Cache;

class ClientDbService implements ClientServiceInterface
{
    public function getClients(): array
    {
       // Cache key
        $cacheKey = 'clients';
        $cacheTTL = 2592000; // 30 days in second

        return Cache::remember($cacheKey, $cacheTTL, function () {
            return Client::query()
                ->select('id', 'user_id')
                ->with('user:id,name')   // eager load user
                ->get()
                ->map(fn($client) => [
                    'id' => $client->id,
                    'name' => optional($client->user)->name,
                ])->toArray();
        });

    }
}
