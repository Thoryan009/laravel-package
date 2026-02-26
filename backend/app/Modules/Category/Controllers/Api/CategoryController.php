<?php

namespace App\Modules\Category\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Category\Models\Category;
use App\Modules\Category\Requests\CategoryRequest;
use App\Modules\Category\Resources\CategoryResource;
use App\Modules\Category\Services\CategoryService;
use App\Http\Requests\ApiIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $service
    ) {}

    public function index(ApiIndexRequest $request): AnonymousResourceCollection
    {
        $filters = $request->filters();

        $categoryData = $this->service->getPaginatedDataWithCache(
            $filters
        );

        return CategoryResource::collection($categoryData);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $category = $this->service->createCategory($request->validated());

        return apiSuccess(
            new CategoryResource($category),
            'created'
        );
    }

    public function show(Category $category): CategoryResource
    {
        return new CategoryResource(
            $this->service->getCategory($category)
        );
    }

    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $category = $this->service->updateCategory(
            $category,
            $request->validated()
        );

        return apiSuccess(
            new CategoryResource($category),
            'updated'
        );
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->service->deleteCategory($category);

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
