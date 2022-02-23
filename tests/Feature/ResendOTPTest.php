<?php

namespace Tests\Feature;

use App\Notifications\OTPNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\Notification;
use Tests\TestCase;

class ResendOTPTest extends TestCase
{
    use DatabaseMigrations;

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
        $req = $this->post('/resendOTP', ['via' => 'email']);
        Notification::assertSentTo([$user], OTPNotification::class);

    }
}
