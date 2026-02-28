<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Client\Controllers\Api\ClientController;
use App\Modules\Client\Controllers\Api\SubCategoryController;
use App\Modules\Client\Controllers\Api\SubCategory1Controller;
use App\Modules\Client\Controllers\Api\SubCategory2Controller;

Route::middleware('permission:super_admin,admin,recruiter')->group(function () {
    Route::apiResource('clients', ClientController::class);
    Route::get('/client-countries', [ClientController::class, 'getClientCountries']);
    Route::post('clients/bulk-delete', [ClientController::class, 'bulkDelete']);
});

Route::apiResource('sub-categories', SubCategoryController::class);
Route::post('sub-categories/bulk-delete', [SubCategoryController::class, 'bulkDelete']);

Route::apiResource('sub-category1s', SubCategory1Controller::class);
Route::post('sub-category1s/bulk-delete', [SubCategory1Controller::class, 'bulkDelete']);

Route::apiResource('sub-category2s', SubCategory2Controller::class);
Route::post('sub-category2s/bulk-delete', [SubCategory2Controller::class, 'bulkDelete']);
