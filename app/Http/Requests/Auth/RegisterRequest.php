<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:15'],
            'lastname'  => ['required', 'string', 'max:15'],
            'phone'      => ['required', 'string', 'max:10', 'unique:users,phone'],
            'email'      => ['nullable', 'email', 'max:150', 'unique:users,email'],
            'password'   => ['required', 'confirmed', Password::min(8)],
        ];
    }
}
