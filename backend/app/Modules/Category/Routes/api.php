<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Category\Controllers\Api\CategoryController;
use App\Modules\Category\Controllers\Api\SubCategoryController;

Route::apiResource('categories', CategoryController::class);
Route::post('categories/bulk-delete', [CategoryController::class, 'bulkDelete']);

Route::apiResource('sub-categories', SubCategoryController::class);
Route::post('sub-categories/bulk-delete', [SubCategoryController::class, 'bulkDelete']);
