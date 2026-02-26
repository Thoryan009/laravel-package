<?php

namespace App\Modules\Client\Repositories;

use App\Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use App\Repositories\BaseRepository;

class ClientRepository extends BaseRepository
{
    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    /* ================= INTERNAL HELPERS ================= */

    protected function applyFilters(Builder $query, array $filters): void
    {
        $this->applySearch($query, $filters['search'] ?? null);
        $this->applyCountryFilter($query, $filters['country_id'] ?? null);
        $this->applyDateFilter($query, $filters);
    }

    /**
     * Apply search on client_id + related user fields
     */
    protected function applySearch(Builder $query, ?string $search): void
    {
        if (!$search) {
            return;
        }
        $query->where(function (Builder $q) use ($search) {
            $q->where('client_id', 'like', "%{$search}%")
                ->orWhereHas('user', function (Builder $q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
        });
    }

    /**
     * Optional filter for country_id
     */
    protected function applyCountryFilter(Builder $query, ?int $countryId): void
    {
        if (!$countryId) {
            return;
        }

        $query->where('country_id', $countryId);
    }

    /* ================= Helper Methods ================= */

    public function createUser(array $data)
    {
        return \App\Modules\Auth\Models\User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'type'     => 'client',
        ]);
    }

    public function createClient($userId, array $data)
    {
        $client = Client::create([
            'user_id'    => $userId,
            'client_id'  => $data['client_id'],
            'country_id' => $data['country_id'],
        ]);
        $this->trackCreateClient($client);

        return $client;
    }

    /**
     * Update an existing user
     */
    public function updateUser($user, array $data, $client)
    {
        $updateData = [
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
        ];

        $this->trackUpdateClient($client);

        // Only update password if provided
        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);
    }
    public function updateClient($client, $data)
    {
        $client->update([
            'client_id'  => $data['client_id'],
            'country_id' => $data['country_id'],
        ]);
        return $client;
    }

    private function trackUpdateClient($client)
    {
        $client->updated_by = auth()->id();
        $client->save();
    }

    private function trackCreateClient($client)
    {
        $client->created_by = auth()->id();
        $client->save();
    }
}
