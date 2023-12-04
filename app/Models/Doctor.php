<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'role',
        'email',
        'password',
        'phone_number',
        'bio_info',
        'hospital_name',
        'national_id',
        'country',
        'national_id_front_image',
        'national_id_back_image',
        'passport_picture',
        'specialty',
        'working_hours',
        'appointment_type',
        'appointment_durattion',
        'consultation_fee',
        'data_range',
        'no_show_fee',
        'gender'
    ];

    // protected static function booted()
    // {
    //     if (auth()->check) {
    //     }
    // }

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'phone_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'working_hours' => 'array',
        'data_range' => 'array',
        // 'password' => 'string', // or remove this line if not needed

        "phone_verified_at" => "datetime",
        "login_at" => "datetime",
        "logout_at" => "datetime",
        "agree" => "boolean",
        "working_hours" => "array",
    ];


    // protected $dates = ['transaction_date'];

    // public function setAmountAttribute($value)
    // {
    //     $this->attributes['amount'] = $value * 100;
    // }

    // public function setTransactionDateAttribute($value)
    // {
    //     $this->attributes['transaction_date'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    // }
}
