<?php

namespace App\Http\Requests\Actors\Doctor;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class LoginDoctorRequest extends FormRequest
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
            'email' => 'required|email|unique:doctors',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "Your email is required",
            "password.required" => "Your password is required",
        ];
    }
}
