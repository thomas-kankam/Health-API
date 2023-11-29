<?php

namespace App\Http\Requests\Actors\Doctor;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:doctors',
            'phone_number' => 'required|numeric|unique:doctors,phone_number',
            'password' => ['required', Password::defaults(), 'confirmed'],
            'agree' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            "first_name.required" => "Your first name is required",
            "last_name.required" => "Your last name is required",
            "email.required" => "Your Email is required",
            "phone_number.required" => "Your phone number is required",
            "password.required" => "Your password is required",
            "password.confirmed" => "Your password does not match",
            "email.unique:users" => "The email is already taken",
            "agree" => "You need to accept the agreement policy"
        ];
    }
}
