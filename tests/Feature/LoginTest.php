<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic  test example.
     *
     * @test
     *
     * @return void
     */
    public function verifyBeforeLogin()
    {
        $this->loginInUser();
        // $this->get('/home');
        // $this->get('/home')->assertRedirect('/');
    }

    /**
     *
     * @test
     *
     */
    public function loginVerifiedUser()
    {
        $this->loginInUser(['is_verified' => true]);
        $this->get('/home')->assertStatus(200);
    }

}
