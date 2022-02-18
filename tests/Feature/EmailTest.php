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
        $password = 'password';
        // $req = $this->post('/login', ['email' => $user->email, 'password' => $password]);
        $this->post('/login', ['email' => $user->email, 'password' => $password]);
        // $req->assertRedirect('/');
        Mail::assertSent(OTPMail::class);

    }
}
