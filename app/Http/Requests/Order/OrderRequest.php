<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'client_id' => 'required|integer|exists:clients,id',
            'status_id' => 'sometimes|integer|exists:order_statuses,id',
            'date' => 'required|date',
        ];
    }
}
