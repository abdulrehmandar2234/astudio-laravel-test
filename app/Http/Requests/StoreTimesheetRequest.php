<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'project_id' => ['required', 'exists:projects,id'],
            'task_name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'hours' => ['required', 'integer', 'min:1'],
        ];
    }
}
