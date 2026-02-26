<?php

namespace App\Modules\Reports\Transaction\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Reports\Transaction\Resources\TransactionReportResource;

class TransactionDashboardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'total_candidate_transactions_count'  => $this->total_candidate_transactions_count,
            'total_client_transactions_count'     => $this->total_client_transactions_count,
            'total_transactions_count'            => $this->total_transactions_count,
            'total_amount'                        => $this->total_amount,
            'total_paid_amount'                   => $this->total_paid_amount,
            'total_due_amount'                    => $this->total_due_amount,
            'recent_transactions'                 => TransactionReportResource::collection(
                                                $this->recent_transactions
            ),
        ];
    }
}
