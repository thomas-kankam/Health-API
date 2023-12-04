<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable()->default(null);
            $table->string('role')->default('doctor');
            $table->string('email')->unique();
            $table->string('password');
            $table->string("gender")->nullable();
            $table->string('phone_number')->nullable()->default(null);
            $table->string('bio_info')->nullable()->default(null);
            $table->string('hospital_name')->nullable()->default(null);
            $table->string('national_id')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->binary('national_id_front_image')->nullable(); // Add this line for image storage
            $table->binary('national_id_back_image')->nullable();
            $table->brinary('passport_picture')->nullable();
            $table->string('specialty')->nullable()->default(null);
            $table->json('working_hours')->nullable()->default(null);
            $table->string('appointment_type')->nullable()->default(null);
            $table->string('appointment_duration')->nullable()->default(null);
            $table->string('consultation_fee')->nullable()->default(null);
            $table->date('date_range')->nullable()->default(null);
            $table->string('no_show_fee')->nullable()->default(null);
            $table->timestamp("phone_verified_at")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
