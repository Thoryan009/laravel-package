<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Category\Controllers\Api\CategoryController;

Route::apiResource('categories', CategoryController::class);
Route::post('categories/bulk-delete', [CategoryController::class, 'bulkDelete']);
