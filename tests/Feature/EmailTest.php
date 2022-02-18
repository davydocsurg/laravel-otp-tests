<?php

namespace Tests\Feature;

use App\Mail\OTPMail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     *
     * @return void
     */
    public function sendOTPEmail()
    {
        Mail::fake();

        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $password = 'password';
        // $req = $this->post('/login', ['email' => $user->email, 'password' => $user->password]);
        $this->post('/login', ['email' => $user->email, 'password' => $password]);
        Mail::assertSent(OTPMail::class);

    }

    /**
     * A basic feature test example.
     *
     * @test
     *
     * @return void
     */
    public function verifyAuthCredentials()
    {
        $this->withExceptionHandling();

        Mail::fake();
        $user = factory(User::class)->create();
        $password = 'password1';
        // $req = $this->post('/login', ['email' => $user->email, 'password' => $password]);
        $this->post('/login', ['email' => $user->email, 'password' => $password]);
        // $req->assertRedirect('/');
        Mail::assertNotSent(OTPMail::class);
        // $this->assertNotNull($user->otp());

    }

    /**
     * A basic feature test example.
     *
     * @test
     *
     * @return void
     */
    public function cacheUserOTP()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();
        $password = 'password';
        $this->post('/login', ['email' => $user->email, 'password' => $password]);
        $this->assertNotNull($user->otp());

    }
}
