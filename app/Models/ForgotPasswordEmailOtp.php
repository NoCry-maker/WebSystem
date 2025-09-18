<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForgotPasswordEmailOtp extends Model
{
    //
            protected $fillable = [
        'email',
        'otp',
        'expired_at',
    ];
}
