<?php

namespace App\Http\Resources\Actors;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'middle_name' => $this->when($this->middle_name, $this->middle_name),
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => $this->role,
            'phone_number' => $this->phone_number,
            'bio_info' => $this->bio_info,
            'national_id' => $this->national_id,
            'country' => $this->country,
            'national_id_front_image' => $this->national_id_front_image,
            'national_id_back_image' => $this->national_id_back_image,
            'passport_picture' => $this->passport_picture,
            'occupation' => $this->occupation,
            'agree' => $this->agree,
        ];
    }
}

// fix the data key showing in the response go to AppServiceProvider and in the boot JsonResource::withoutWrapping();
// don't forget to have Accept: application/json as part of the request to api