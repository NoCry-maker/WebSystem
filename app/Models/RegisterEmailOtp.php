<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterEmailOtp extends Model
{
    //
          protected $fillable = [
        'email',
        'otp',
        'expired_at',
    ];
}
