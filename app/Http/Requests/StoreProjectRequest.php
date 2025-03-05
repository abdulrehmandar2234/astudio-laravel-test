<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'status' => ['required', 'string'],
            'attributes' => ['sometimes', 'array'],
        ];
    }
}
