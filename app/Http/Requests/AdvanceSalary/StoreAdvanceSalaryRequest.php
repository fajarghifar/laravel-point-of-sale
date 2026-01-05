<?php

namespace App\Http\Requests\AdvanceSalary;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvanceSalaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date_format:Y-m-d|max:10',
            'advance_salary' => 'required|numeric|min:0|max:999999999999',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'Please select an employee.',
            'employee_id.exists' => 'The selected employee is invalid.',
            'date.required' => 'Please select a date.',
            'date.date_format' => 'The date format is invalid.',
            'advance_salary.required' => 'Please enter the advance salary amount.',
            'advance_salary.numeric' => 'The advance salary must be a number.',
        ];
    }
}
