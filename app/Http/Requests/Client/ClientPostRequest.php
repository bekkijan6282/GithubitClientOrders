<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientPostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => 'required|string',
            'surname' => 'required|string',
            'contacts' => 'sometimes|json',
        ];
    }
}
