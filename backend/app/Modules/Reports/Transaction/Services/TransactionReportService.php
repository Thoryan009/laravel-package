<?php

namespace App\Modules\Reports\Transaction\Services;
use App\Modules\Reports\Transaction\Reports\{
    CandidateTransactionReport,
    ClientTransactionReport
};
use Illuminate\Support\Facades\Cache;
use App\Modules\Reports\Transaction\Repositories\TransactionReportRepository;
use App\Modules\Reports\Transaction\Resources\TransactionReportResource;
use InvalidArgumentException;

class TransactionReportService
{
    public function resolve(string $type)
    {
        return match ($type) {
            'candidate' => app(CandidateTransactionReport::class),
            'client'    => app(ClientTransactionReport::class),
            default     => throw new InvalidArgumentException('Invalid transaction report type'),
        };
    }

     public function getAllTransactionsReport(array $filters)
    {
         $repository = app(TransactionReportRepository::class);

        $query = $repository->baseQuery($filters);

        // Clone query for summary calculation
        $summaryQuery = clone $query;

        $transactions = $query->get();

        $totalAmount = $summaryQuery->sum('total_amount');
        $totalPaidAmount = $summaryQuery->sum('paid_amount');
        $totalDueAmount = $totalAmount - $totalPaidAmount;

        return response()->json([
            'data' => TransactionReportResource::collection($transactions),
            'summary' => [
                'total_amount' => $totalAmount,
                'total_paid_amount' => $totalPaidAmount,
                'total_due_amount' => $totalDueAmount,
            ]
    ]);
    }

    public function getDashboardData()
    {
          $cacheKey = 'transaction_dashboard_data';

         return Cache::remember($cacheKey, now()->addMinutes(10), function ()  {
            $repository = app(TransactionReportRepository::class);

            $baseQuery = $repository->baseQuery($filters = []); // No filters for dashboard, consider all data

            $candidate   = $repository->filterByPayer(clone $baseQuery, 'candidate')->count();
            $client  = $repository->filterByPayer(clone $baseQuery, 'client')->count();

            $totalTransactions = $candidate + $client;
            $totalAmount = (clone $baseQuery)->sum('total_amount');
            $totalPaidAmount = (clone $baseQuery)->sum('paid_amount');
            $totalDueAmount = $totalAmount - $totalPaidAmount;
            $recentTransactions = (clone $baseQuery)
                ->latest()
                ->take(10)
                ->get();

            return (object)[
                'total_candidate_transactions_count'  => $candidate,
                'total_client_transactions_count'     => $client,
                'total_transactions_count'            => $totalTransactions,
                'total_amount'                        => $totalAmount,
                'total_paid_amount'                   => $totalPaidAmount,
                'total_due_amount'                    => $totalDueAmount,
                'recent_transactions'                 => $recentTransactions,
            ];
        });
    }

}


