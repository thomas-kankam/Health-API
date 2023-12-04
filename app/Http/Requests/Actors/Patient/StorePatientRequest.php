<?php

namespace App\Http\Requests\Actors\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            "agree" => ["required", "numeric"],
            'middle_name' => 'nullable|string',
            'hospital_name' => 'required|string',
            'national_id' => 'required|string',
            'phone_number' => 'required|string',
            'password' => 'required|string|',
            'email' => 'required|string|email|unique:patient',
            'national_id_front_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'national_id_back_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'passport_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
