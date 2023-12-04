<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
// use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'role',
        'agree',
        'password',
        'phone_number',
        'bio_info',
        'national_id',
        'country',
        'national_id_front_image',
        'national_id_back_image',
        'passport_picture',
        'occupation',
        'gender',
        'alias',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'password',
        'email_verified_at',
        'phone_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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
