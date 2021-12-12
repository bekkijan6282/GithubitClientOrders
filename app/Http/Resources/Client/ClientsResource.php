<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'surname' => $this->surname,
            'contacts' => json_decode($this->contacts),
        ];
    }
}
