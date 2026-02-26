<?php

use Illuminate\Support\Facades\Route;
use App\Modules\__MODEL__\Controllers\Api\__MODEL__Controller;

Route::apiResource('__TABLE__', __MODEL__Controller::class);
Route::post('__TABLE__/bulk-delete', [__MODEL__Controller::class, 'bulkDelete']);
