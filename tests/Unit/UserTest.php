<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function cacheOTPKey()
    {
        $user = factory(User::class)->create();
        // dd($user->otpKey());
    }

    /**
     * @test
     *
     * @return void
     */
    public function sendOTPNotification()
    {
        $user = factory(User::class)->create();
        $user->sendOTP('email-otp');
        // $cUser = auth()->user;
        dd(cache($user->otp()));
    }
}
