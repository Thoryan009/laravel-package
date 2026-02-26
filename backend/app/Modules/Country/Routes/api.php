<?php

use App\Modules\Country\Controllers\Api\CountryController;
use Illuminate\Support\Facades\Route;

Route::middleware('permission:super_admin,admin,recruiter')->group(function () {
    Route::apiResource('countries', CountryController::class);
    Route::post('countries/bulk-delete', [CountryController::class, 'bulkDelete']);
});
