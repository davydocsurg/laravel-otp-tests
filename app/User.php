<?php

namespace App;

use App\Mail\OTPMail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

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

    public function otp()
    {
        return Cache::get($this->otpKey());
    }

    public function otpKey()
    {
        return "OTP_for_{$this->id}";
    }

    public function cacheOTP()
    {
        $otp = rand(100000, 999999);
        // dd($otp);
        Cache::put([$this->otpKey() => $otp], now()->addSeconds(20));
        return $otp;
    }

    public function sendOTP()
    {

        Mail::to('dellivaseges@gmail.com')->send(new OTPMail($this->cacheOTP()));
    }
}
