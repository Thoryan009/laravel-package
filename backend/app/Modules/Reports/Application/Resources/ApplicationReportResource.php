<?php

namespace App\Modules\Reports\Application\Resources;

use App\Modules\Application\Helpers\ApplicationPresenter;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Shared\Helpers\DateTimeFormatter;
class ApplicationReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'job_name'          => $this->jobList->name,
            'sur_name'          => $this->sur_name,
            'given_name'        => $this->given_name,
            'sex'               => strtolower($this->sex),
            'mobile'            => $this->mobile,
            'email'             => $this->email,
            'payer'             => $this->jobList?->payer,
            'client'            => $this->jobList?->workOrder?->client?->user?->name,
            'country'           => $this->jobList?->workOrder?->client?->country?->name,
            'passport_no'       => $this->passport_no,
            'application_id'    => $this->application_id,
            'work_order_id'     => $this->jobList->workOrder->work_order_id ?? null,
            'status'            => $this->current_process_name  ?? 'hiring_list',
            'created_at'       => DateTimeFormatter::formatDateTime($this->created_at),
            'updated_at'       => DateTimeFormatter::formatDateTime($this->updated_at),
        ];
    }
}
