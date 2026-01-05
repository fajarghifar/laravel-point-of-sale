<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee')->id;

        return [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => ['required', 'email', 'max:50', Rule::unique('employees')->ignore($employeeId)],
            'phone' => ['required', 'string', 'max:20', Rule::unique('employees')->ignore($employeeId)],
            'salary' => 'numeric',
            'vacation' => 'max:50|nullable',
            'city' => 'max:50',
            'address' => 'required|max:100',
        ];
    }
}
