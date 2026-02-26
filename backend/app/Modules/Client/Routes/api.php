<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Client\Controllers\Api\ClientController;

Route::middleware('permission:super_admin,admin,recruiter')->group(function () {
    Route::apiResource('clients', ClientController::class);
    Route::get('/client-countries', [ClientController::class, 'getClientCountries']);
    Route::post('clients/bulk-delete', [ClientController::class, 'bulkDelete']);
});
