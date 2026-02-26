<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Reports\Employee\Controllers\EmployeeReportController;
use App\Modules\Reports\Transaction\Controllers\TransactionReportController;
use App\Modules\Reports\ATS\Controllers\ATSReportController;
use App\Modules\Reports\Controller\ReportController;
use App\Modules\Reports\Application\Controllers\ApplicationReportController;

Route::prefix('reports/transactions')->group(function () {
    Route::get('/', [TransactionReportController::class, 'index']);
});

Route::prefix('reports/employees')->group(function () {
    Route::get('/', [EmployeeReportController::class, 'index']);
});

Route::prefix('reports/ats')->group(function () {
    Route::get('/', [ATSReportController::class, 'index']);
    Route::get('/show', [ATSReportController::class, 'show']);
});

Route::prefix('reports/transaction')->group(function () {
    Route::get('/', [TransactionReportController::class, 'index']);
    Route::get('/show', [TransactionReportController::class, 'show']);
});

Route::prefix('reports/application')->group(function () {
    Route::get('/', [ApplicationReportController::class, 'index']);
     Route::get('/show', [ApplicationReportController::class, 'show']);
});

Route::get('/report-countries', [ReportController::class, 'getCountryReport']);
Route::get('/report-clients', [ReportController::class, 'getClientReport']);
Route::get('/report-processes', [ReportController::class, 'getProcessReport']);
Route::get('/report-jobs', [ReportController::class, 'getJobReport']);
Route::get('/report-work-orders', [ReportController::class, 'getWorkOrderReport']);
Route::get('/report-payment-methods', [ReportController::class, 'getTransactionPaymentMethodReport']);
Route::get('/report-transaction-status', [ReportController::class, 'getTransactionStatusReport']);


