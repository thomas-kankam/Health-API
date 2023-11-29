<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
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
            'role' => 'patient',
            'agree' => $this->faker->boolean(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'phone_number' => $this->faker->phoneNumber(),
            'bio_info' => $this->faker->text(),
            'national_id' => $this->faker->randomNumber(),
            'country' => $this->faker->country(),
            'national_id_front_image' => $this->faker->imageUrl(),
            'national_id_back_image' => $this->faker->imageUrl(),
            'passport_picture' => $this->faker->imageUrl(),
            'occupation' => $this->faker->jobTitle(),
            'remember_token' => Str::random(10),
        ];
    }
}
