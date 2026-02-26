<?php

namespace App\Modules\Client\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Shared\Helpers\DateTimeFormatter;


class ClientResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,

            // Client-specific
            'client_id'  => $this->client_id,

            'name'  => $this->user->name,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'type'  => $this->user->type,
            'country' => $this->country->name,
            'country_id' => $this->country_id,
            'work_orders' => $this->workOrders->map(function ($workOrder) {
                return [
                    'id' => $workOrder->id,
                    'work_order_id' => $workOrder->work_order_id,
                    'candidates' => $workOrder->candidates,
                    'end_date' => $workOrder->end_date,
                    'end_date_formatted' => DateTimeFormatter::formatDate($workOrder->end_date),
                    'price' => $workOrder->price,
                    'price_usd' => $workOrder->price_usd,
                    'client_id' => $workOrder->client_id,
                    'client' => $workOrder->client->user->name,
                    'created_at' => DateTimeFormatter::formatDateTime($workOrder->created_at),
                    'updated_at' => DateTimeFormatter::formatDateTime($workOrder->updated_at),
                    'created_by' => $workOrder->createdBy ? $workOrder->createdBy->name : null,
                    'updated_by' => $workOrder->updatedBy ? $workOrder->updatedBy->name : null,
                ];
            }),

            'created_at' => DateTimeFormatter::formatDateTime($this->created_at),
            'updated_at' => DateTimeFormatter::formatDateTime($this->updated_at),
            'created_by' => $this->createdBy ? $this->createdBy->name : null,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : null,
        ];
    }
}
