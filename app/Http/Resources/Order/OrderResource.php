<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'client' => $this->client,
            'cur_status' => $this->cur_status,
            'date' => $this->date,
        ];
    }
}
