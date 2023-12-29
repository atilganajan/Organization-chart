<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'photo' => 'nullable|image|max:3072',
            'department_id' => 'required',
        ];
    }
}
