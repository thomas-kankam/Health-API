<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->firstName(),
            'role' => $this->faker->randomElement(['doctor', 'patient']), // Randomly select 'doctor' or 'patient'
            'agree' => $this->faker->boolean(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Hash the password
            'phone_number' => $this->faker->phoneNumber(),
            'bio_info' => $this->faker->text(),
            'hospital_name' => $this->faker->company(),
            'national_id' => $this->faker->randomNumber(),
            'country' => $this->faker->country(),
            'national_id_front_image' => $this->faker->imageUrl(),
            'national_id_back_image' => $this->faker->imageUrl(),
            'passport_picture' => $this->faker->imageUrl(),
            'specialty' => $this->faker->jobTitle(),
            'working_hours' => $this->faker->randomNumber(),
            'appointment_type' => $this->faker->randomNumber(),
            'appointment_duration' => $this->faker->randomNumber(),
            'consultation_fee' => $this->faker->randomNumber(),
            'data_range' => $this->faker->randomNumber(),
            'no_show_fee' => $this->faker->randomNumber(),
            'remember_token' => Str::random(10),
            'alias' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['male', 'female']), // Randomly select 'male' or 'female'
            'phone_verified_at' => now(),
        ];
    }
}
