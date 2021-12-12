<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'order_id' => 'required|integer|exists:orders,id',
            'total' => 'required|integer',
        ];
    }
}
