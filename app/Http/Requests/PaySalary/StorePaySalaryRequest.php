<?php

namespace App\Http\Requests\PaySalary;

use Illuminate\Foundation\Http\FormRequest;

class StorePaySalaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:advance_salaries,id',
            'date' => 'required|date_format:Y-m-d|max:10',
            'month' => 'required|string|max:20',
            'year' => 'required|integer|digits:4|min:2000|max:' . (date('Y') + 1),
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Advance salary record is missing.',
            'id.exists' => 'Invalid advance salary record.',
            'date.required' => 'Payment date is required.',
            'date.date_format' => 'Invalid date format.',
            'month.required' => 'Please select the salary month.',
            'year.required' => 'Please select the salary year.',
        ];
    }
}
