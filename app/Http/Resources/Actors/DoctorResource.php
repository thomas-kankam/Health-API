<?php

namespace App\Http\Resources\Actors;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            "attributes" => [
                'first_name' => $this->first_name,
                'middle_name' => $this->when($this->middle_name, $this->middle_name),
                'last_name' => $this->last_name,
                'email' => $this->email,
                'role' => $this->role,
                'alias' => $this->alias,
                'agree' => $this->agree,
                'phone_number' => $this->phone_number,
                'bio_info' => $this->bio_info,
                'hospital_name' => $this->hospital_name,
                'national_id' => $this->national_id,
                'country' => $this->country,
                'national_id_front_image' => $this->national_id_front_image,
                'national_id_back_image' => $this->national_id_back_image,
                'passport_picture' => $this->passport_picture,
                'specialty' => $this->specialty,
                'working_hours' => $this->working_hours,
                'appointment_type' => $this->appointment_type,
                'appointment_durattion' => $this->appointment_durattion,
                'consultation_fee' => $this->consultation_fee,
                'data_range' => $this->data_range,
                'no_show_fee' => $this->no_show_fee,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
