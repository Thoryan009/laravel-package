<?php

namespace App\Modules\Category\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Category\Models\SubCategory;
use App\Modules\Category\Requests\SubCategoryRequest;
use App\Modules\Category\Resources\SubCategoryResource;
use App\Modules\Category\Services\SubCategoryService;
use App\Http\Requests\ApiIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubCategoryController extends Controller
{
    public function __construct(
        private readonly SubCategoryService $service
    ) {}

    public function index(ApiIndexRequest $request): AnonymousResourceCollection
    {
        $filters = $request->filters();

        $subCategoryData = $this->service->getPaginatedDataWithCache(
            $filters
        );

        return SubCategoryResource::collection($subCategoryData);
    }

    public function store(SubCategoryRequest $request): JsonResponse
    {
        $subCategory = $this->service->createSubCategory($request->validated());

        return apiSuccess(
            new SubCategoryResource($subCategory),
            'created'
        );
    }

    public function show(SubCategory $subCategory): SubCategoryResource
    {
        return new SubCategoryResource(
            $this->service->getSubCategory($subCategory)
        );
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory): JsonResponse
    {
        $subCategory = $this->service->updateSubCategory(
            $subCategory,
            $request->validated()
        );

        return apiSuccess(
            new SubCategoryResource($subCategory),
            'updated'
        );
    }

    public function destroy(SubCategory $subCategory): JsonResponse
    {
        $this->service->deleteSubCategory($subCategory);

        return apiSuccess(
            null,
            'deleted'
        );
    }

    public function bulkDelete(Request $request): JsonResponse
    {
       $data= $this->service->bulkDelete($request->ids);

        return apiSuccess(
            $data,
            'deleted',
            200,
            'Records'
        );
    }
}
