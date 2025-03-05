<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttributeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('attributes')->ignore($this->route('attribute'))],
            'type' => ['required', 'in:text,date,number,select'],
        ];
    }
}
