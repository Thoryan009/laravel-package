<?php

namespace App\Modules\Reports\ATS\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Shared\Helpers\DateTimeFormatter;

class ATSResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'job_name'      => $this->jobList?->name,
            'work_order'    => $this->jobList?->workOrder?->work_order_id,
            'client'        => $this->jobList?->workOrder?->client?->user?->name,
            'payer'         => $this->jobList?->payer,
            'candidate'     => $this->sur_name . ' ' . $this->given_name,
            'phone'         => $this->mobile,
            'process'       => $this->current_process_name,
            'duration'      => $this->currentProcess->process->duration,
            'age'           => $this->currentProcess->getDurationInDays() . ' ' . ($this->currentProcess->getDurationInDays() <= 1 ? 'Day' : 'Days'),
            'started_at'    => DateTimeFormatter::formatDateTime(optional($this->currentProcess)->started_at),
            'completed_at'  => DateTimeFormatter::formatDateTime(optional($this->currentProcess)->completed_at),
            'created_at' => DateTimeFormatter::formatDateTime($this->created_at),
            'updated_at' => DateTimeFormatter::formatDateTime($this->updated_at),
        ];
    }
}
