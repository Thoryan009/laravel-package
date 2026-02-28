<?php

namespace App\Modules\Client\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Client\Models\SubCategory1;
use App\Modules\Client\Requests\SubCategory1Request;
use App\Modules\Client\Resources\SubCategory1Resource;
use App\Modules\Client\Services\SubCategory1Service;
use App\Http\Requests\ApiIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubCategory1Controller extends Controller
{
    public function __construct(
        private readonly SubCategory1Service $service
    ) {}

    public function index(ApiIndexRequest $request): AnonymousResourceCollection
    {
        $filters = $request->filters();

        $subCategory1Data = $this->service->getPaginatedDataWithCache(
            $filters
        );

        return SubCategory1Resource::collection($subCategory1Data);
    }

    public function store(SubCategory1Request $request): JsonResponse
    {
        $subCategory1 = $this->service->createSubCategory1($request->validated());

        return apiSuccess(
            new SubCategory1Resource($subCategory1),
            'created'
        );
    }

    public function show(SubCategory1 $subCategory1): SubCategory1Resource
    {
        return new SubCategory1Resource(
            $this->service->getSubCategory1($subCategory1)
        );
    }

    public function update(SubCategory1Request $request, SubCategory1 $subCategory1): JsonResponse
    {
        $subCategory1 = $this->service->updateSubCategory1(
            $subCategory1,
            $request->validated()
        );

        return apiSuccess(
            new SubCategory1Resource($subCategory1),
            'updated'
        );
    }

    public function destroy(SubCategory1 $subCategory1): JsonResponse
    {
        $this->service->deleteSubCategory1($subCategory1);

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
}
