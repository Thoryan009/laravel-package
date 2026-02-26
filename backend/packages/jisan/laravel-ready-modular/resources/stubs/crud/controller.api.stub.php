<?php

namespace App\Modules\__PARENT_MODEL__\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\__PARENT_MODEL__\Models\__MODEL__;
use App\Modules\__PARENT_MODEL__\Requests\__REQUEST__;
use App\Modules\__PARENT_MODEL__\Resources\__RESOURCE__;
use App\Modules\__PARENT_MODEL__\Services\__SERVICE__;
use App\Http\Requests\ApiIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class __MODEL__Controller extends Controller
{
    public function __construct(
        private readonly __SERVICE__ $service
    ) {}

    public function index(ApiIndexRequest $request): AnonymousResourceCollection
    {
        $filters = $request->filters();

        $__LOWER_MODEL__Data = $this->service->getPaginatedDataWithCache(
            $filters
        );

        return __RESOURCE__::collection($__LOWER_MODEL__Data);
    }

    public function store(__REQUEST__ $request): JsonResponse
    {
        $__LOWER_MODEL__ = $this->service->create__MODEL__($request->validated());

        return apiSuccess(
            new __RESOURCE__($__LOWER_MODEL__),
            'created'
        );
    }

    public function show(__MODEL__ $__LOWER_MODEL__): __RESOURCE__
    {
        return new __RESOURCE__(
            $this->service->get__MODEL__($__LOWER_MODEL__)
        );
    }

    public function update(__REQUEST__ $request, __MODEL__ $__LOWER_MODEL__): JsonResponse
    {
        $__LOWER_MODEL__ = $this->service->update__MODEL__(
            $__LOWER_MODEL__,
            $request->validated()
        );

        return apiSuccess(
            new __RESOURCE__($__LOWER_MODEL__),
            'updated'
        );
    }

    public function destroy(__MODEL__ $__LOWER_MODEL__): JsonResponse
    {
        $this->service->delete__MODEL__($__LOWER_MODEL__);

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
