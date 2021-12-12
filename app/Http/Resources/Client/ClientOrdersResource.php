<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Order\ClientOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'surname' => $this->surname,
            'contacts' => json_decode($this->contacts),
            'orders' => ClientOrderResource::collection($this->orders),
        ];
    }
}
