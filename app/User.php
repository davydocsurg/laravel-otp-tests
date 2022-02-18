<?php

namespace App;

use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cacheOTP()
    {
        $otp = rand(100000, 999999);
        // dd($otp);
        Cache::put(['OTP' => $otp, now()->addSeconds(20)]);
    }

    public function sendOTP()
    {
        Mail::to('dellivaseges@gmail.com')->send(new OTPMail($this->otp));
    }
}
