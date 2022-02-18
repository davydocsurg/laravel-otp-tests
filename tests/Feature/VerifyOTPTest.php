<?php

namespace Tests\Feature;

use Tests\TestCase;

class VerifyOTPTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     *
     * @return void
     */
    public function testExample()
    {
        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        // $otp = rand(100000, 999999);
        // Cache::put(['OTP' => $   otp, now()->addSeconds(20)]);
        $otp = auth()->user()->cacheOTP();
        $this->post('/verifyOTP', ['OTP' => $otp])->assertStatus(201);
        $this->assertDatabaseHas('users', ['is_verified' => true]);
    }
}
