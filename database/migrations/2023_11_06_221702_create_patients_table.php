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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable()->default(null);
            $table->string('role')->default('patient');
            $table->boolean("agree");
            $table->string("gender")->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable()->default(null);
            $table->string('bio_info')->nullable()->default(null);
            $table->string('national_id')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('national_id_front_image')->nullable()->default(null);
            $table->string('national_id_back_image')->nullable()->default(null);
            $table->string('passport_picture')->nullable()->default(null);
            $table->string('occupation')->nullable()->default(null);
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
        Schema::dropIfExists('patients');
    }
};
