<?php

namespace App\Modules\Client\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Client\Models\SubCategory2;
use App\Modules\Client\Requests\SubCategory2Request;
use App\Modules\Client\Resources\SubCategory2Resource;
use App\Modules\Client\Services\SubCategory2Service;
use App\Http\Requests\ApiIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubCategory2Controller extends Controller
{
    public function __construct(
        private readonly SubCategory2Service $service
    ) {}

    public function index(ApiIndexRequest $request): AnonymousResourceCollection
    {
        $filters = $request->filters();

        $subCategory2Data = $this->service->getPaginatedDataWithCache(
            $filters
        );

        return SubCategory2Resource::collection($subCategory2Data);
    }

    public function store(SubCategory2Request $request): JsonResponse
    {
        $subCategory2 = $this->service->createSubCategory2($request->validated());

        return apiSuccess(
            new SubCategory2Resource($subCategory2),
            'created'
        );
    }

    public function show(SubCategory2 $subCategory2): SubCategory2Resource
    {
        return new SubCategory2Resource(
            $this->service->getSubCategory2($subCategory2)
        );
    }

    public function update(SubCategory2Request $request, SubCategory2 $subCategory2): JsonResponse
    {
        $subCategory2 = $this->service->updateSubCategory2(
            $subCategory2,
            $request->validated()
        );

        return apiSuccess(
            new SubCategory2Resource($subCategory2),
            'updated'
        );
    }

    public function destroy(SubCategory2 $subCategory2): JsonResponse
    {
        $this->service->deleteSubCategory2($subCategory2);

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
