<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'image|file|max:1024|nullable',
            'name' => 'required|string|unique:products,name',
            'category_id' => 'required|integer|exists:categories,id',
            'stock' => 'required|integer',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'buying_date' => 'date_format:Y-m-d|nullable',
            'expire_date' => 'date_format:Y-m-d|nullable',
        ];
    }
}
