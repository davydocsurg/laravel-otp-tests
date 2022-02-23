<?php

namespace Tests\Feature;

use Tests\TestCase;

class VerifyOTPTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @tes
     *
     * @return void
     */
    public function submitAndVerifyOTP()
    {
        // $this->withExceptionHandling();
        $this->logInUser();
        // $user = factory(User::class)->create();
        // $this->actingAs($user);
        // $otp = rand(100000, 999999);
        // Cache::put(['OTP' => $   otp, now()->addSeconds(20)]);
        $otp = auth()->user()->cacheOTP();
        $this->post('/verifyOTP', [auth()->user()->otpKey() => $otp])->assertStatus(201);
        $this->assertDatabaseHas('users', ['is_verified' => true]);
    }

    /**
     *
     * @tes
     *
     *
     */
    public function navigateToOTPVerificationPage()
    {
        $this->logInUser();
        $this->get('/verifyOTP')
            ->assertStatus(200)
            ->assertSee('enter otp');
    }

    /**
     *
     * @test
     *
     */
    public function handleInvalidOTP()
    {
        $this->logInUser();
        $this->post('/verifyOTP', ['OTP' => 'InvalidOTP'])->assertSessionHasErrors();

    }

    /**
     *
     * @test
     *
     */
    public function handleEmptyOTP()
    {
        $this->logInUser();
        $this->post('/verifyOTP', ['OTP' => null])->assertSessionHasErrors();

    }
}
