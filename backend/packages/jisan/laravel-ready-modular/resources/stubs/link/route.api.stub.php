<?php

use Illuminate\Support\Facades\Route;
use App\Modules\__MODEL__\Controllers\Api\__MODEL__Controller;

Route::apiResource('__TABLE__', __MODEL__Controller::class);
Route::post('__TABLE__/bulk-delete', [__MODEL__Controller::class, 'bulkDelete']);
Route::get('/client-__plural_parent_model__', [__MODEL__Controller::class, 'get__MODEL___PLURAL_PARENT_MODEL__']);
