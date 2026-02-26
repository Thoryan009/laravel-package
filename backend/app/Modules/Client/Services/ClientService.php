<?php

namespace App\Modules\Client\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Client\Models\Client;
use App\Services\BaseCachedService;
use App\Modules\Client\Repositories\ClientRepository;
class ClientService extends BaseCachedService
{
    public function __construct(protected ClientRepository $repository)
    {
        parent::__construct(new Client());
    }

    /* ==========================================================
     | Read Operations (Cached)
     |========================================================== */

    public function getPaginatedDataWithCache(
        array $filters = []
    ) {
        return $this->remember(
            $this->filtersCacheKey($filters),
            fn() => $this->repository->getPaginatedData($filters)
        );
    }

    public function getById(int $id)
    {
        return $this->remember(
            $this->byIdCacheKey($id),
            fn() => $this->model->findOrFail($id)
        );
    }

    /* ==========================================================
     | Write Operations (Invalidate Cache)
     |========================================================== */

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = $this->repository->createUser($data);
            $client = $this->repository->createClient($user->id, $data);
            $this->flushCache();
            return $client;
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $client = $this->model->with('user')->findOrFail($id);
            $this->repository->updateUser($client->user, $data, $client);
            $client = $this->repository->updateClient($client,$data);
            $this->flushCache();
            return $client;
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {

            $client = $this->model->findOrFail($id);
            // delete client first (FK safety)
            $client->delete();
            // delete linked user
            $client->user?->delete();
            $this->flushCache();
            return true;
        });
    }

    public function bulkDelete(array $ids): int
    {
        $deletedCount = $this->model->whereIn('id', $ids)->delete();
        $this->flushCache();
        return $deletedCount;
    }
}
