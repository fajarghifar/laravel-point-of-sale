<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        $rules = [
            'name' => 'required|max:50',
            'photo' => 'nullable|image|file|max:1024',
            'email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'username' => [
                'required',
                'min:4',
                'max:25',
                'alpha_dash:ascii',
                Rule::unique('users', 'username')->ignore($userId),
            ],
            'role' => 'nullable|exists:roles,name',
        ];

        // Only validate password if it is provided
        if ($this->filled('password') || $this->filled('password_confirmation')) {
            $rules['password'] = 'required|min:6|required_with:password_confirmation';
            $rules['password_confirmation'] = 'required|min:6|same:password';
        }

        return $rules;
    }
}
