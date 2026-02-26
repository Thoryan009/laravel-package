<?php

namespace App\Modules\Setting\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Setting\Requests\SettingRequest;
use App\Modules\Setting\Services\SettingService;
use App\Modules\Setting\Resources\SettingResource;
use App\Modules\Setting\Models\Setting;

class SettingController extends Controller
{
    public function __construct(
        private SettingService $service
    ) {}

     public function show($id)
    {
        return new SettingResource($this->service->getById($id));
    }


    public function update(SettingRequest $request, $id)
    {

     $record = $this->service->update(
            $id,
            $request->validated()
        );

        return apiSuccess(
            new SettingResource($record),
            'updated'
        );
    }
}
