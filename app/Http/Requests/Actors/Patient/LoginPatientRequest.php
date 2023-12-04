<?php

namespace App\Http\Requests\Actors\Patient;

use Illuminate\Foundation\Http\FormRequest;

class LoginPatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone_number' => 'required|numeric|exists:patients,phone_number',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            "phone_number.required" => "Your phone number is required",
            "password.required" => "Your password is required",
        ];
    }
}
