<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' =>'required|string|max:100',
            'parent_department_id' => [
                'sometimes',
                'nullable',
                'exists:departments,id',
            ],
        ];
    }
}
