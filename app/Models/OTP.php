<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $table = 'otps'; 
    protected $fillable = ['phone_number', 'otp', 'created_at'];
}

