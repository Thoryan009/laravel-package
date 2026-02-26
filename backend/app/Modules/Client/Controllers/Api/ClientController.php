<?php

namespace App\Modules\Client\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Client\Requests\ClientRequest;
use App\Http\Requests\ApiIndexRequest;
use App\Modules\Client\Services\CountryDbService;
use App\Modules\Client\Resources\ClientResource;
use App\Modules\Client\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController extends Controller
{
    public function __construct(
        private readonly ClientService $service,
        private readonly CountryDbService $countryDbService

    ) {}

    public function index(ApiIndexRequest $request): AnonymousResourceCollection
    {
         $filters = $request->filters();
         $filters['country_id'] = $request->get('country_id', null);
         $data = $this->service->getPaginatedDataWithCache($filters);
         return ClientResource::collection($data);
    }

    public function store(ClientRequest $request): JsonResponse
    {
        $record = $this->service->create($request->validated());
        $this->countryDbService->flushCountriesCache();
        return apiSuccess(
            new ClientResource($record),
            'created'
        );
    }

    public function show(int $id): ClientResource
    {
        return new ClientResource(
            $this->service->getById($id)
        );
    }

    public function update(ClientRequest $request, int $id): JsonResponse
    {
        $record = $this->service->update($id, $request->validated());
        $this->countryDbService->flushCountriesCache();
        return apiSuccess(
            new ClientResource($record),
            'updated'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return apiSuccess(
             null,
            'deleted'
        );
    }

    public function bulkDelete(Request $request): JsonResponse
    {
        $this->service->bulkDelete($request->ids);
        return apiSuccess(
             null,
            'deleted',
             200,
            'Records'
        );
    }

    public function getClientCountries(): JsonResponse
    {
        $countries = $this->countryDbService->getCountries();
        return apiSuccess(
             $countries,
            'fetched',
             200,
            'Countries'
        );
    }
}
