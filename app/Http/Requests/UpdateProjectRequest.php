<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'status' => ['sometimes', 'string'],
            'attributes' => ['sometimes', 'array'],
        ];
    }
}
