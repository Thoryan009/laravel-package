<?php

namespace App\Modules\Country\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiIndexRequest;
use App\Modules\Country\Requests\CountryRequest;
use App\Modules\Country\Services\CountryService;
use App\Modules\Country\Resources\CountryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class CountryController extends Controller
{
    public function __construct(
        private CountryService $service
    ) {}

    public function index(ApiIndexRequest $request): AnonymousResourceCollection
    {
         $filters = $request->filters();
         $data = $this->service->getPaginatedDataWithCache(
            $filters
        );
        return CountryResource::collection($data);
    }

    public function store(CountryRequest $request)
    {
            $country = $this->service->create(
            $request->validated()
        );
        return apiSuccess(
            new CountryResource($country),
            'created'
        );
    }

    public function show($id)
    {
        return new CountryResource($this->service->getById($id));
    }

    public function update(CountryRequest $request, $id)
    {
        $record = $this->service->update(
            $id,
            $request->validated()
        );
         return apiSuccess(
            new CountryResource($record),
            'updated'
        );
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return apiSuccess(
            null,
            'deleted'
        );
    }

    public function bulkDelete(Request $request)
    {
        $this->service->bulkDelete($request->ids);
        return apiSuccess(
            null,
            'deleted',
            200,
            'Records'
        );
    }
}
