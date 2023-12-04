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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'hospital_name' => 'required|string',
            'national_id' => 'required|string',
            'phone_number' => 'required|numeric|exists:doctors,phone_number',
            'national_id_front_image' => 'required|string',
            'national_id_back_image' => 'required|string',
            'passport_picture' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            "first_name" => "Your first name is required",
            "last_name" => "Your last name is required",
            "hospital_name" => "Yourhospital name is required",
            "national_id" => "Your National ID is required",
            "phone_number.required" => "Your phone number is required",
            "national_id_front_image" => "Your National ID front is required",
            "national_id_back_image" => "Your National ID back is required",
            "passport_picture" => "Your passport picture is required"
        ];
    }
}
