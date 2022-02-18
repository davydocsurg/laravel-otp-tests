<?php

namespace Tests\Feature;

use App\User;
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
        // $response = $this->get('/');

        // $response->assertStatus(200);
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->get('/home')->assertRedirect('/');
    }

    /**
     *
     * @test
     *
     */
    public function loginVerifiedUser()
    {
        $user = factory(User::class)->create(['is_verified' => true]);
        $this->actingAs($user);
        $this->get('/home')->assertStatus(200);
    }

}
