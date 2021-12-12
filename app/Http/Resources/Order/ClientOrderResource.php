<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Transaction\TransactionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientOrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'cur_status' => $this->cur_status,
            'date' => $this->date,
            'transactions' => TransactionResource::collection($this->transactions),
        ];
    }
}
