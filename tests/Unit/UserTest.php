<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
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
        // dd(cache($user->otp()));
    }

    /**
     *
     * @test
     *
     */
    public function reqNewOTP()
    {
        $this->logInUser();
        $req = $this->post('/resendOTP', ['via' => 'email']);
        $req->assertStatus(201);

    }

    /**
     *
     * @test
     *
     */
    public function sendNewOTP()
    {
        Notification::fake();
        $user = $this->logInUser();
        $req = $this->post('/resendOTP', ['via' => 'sms']);
        Notification::assertSentTo([$user], OTPNotification::class);

    }
}
