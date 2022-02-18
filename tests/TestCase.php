<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // public function setup()
    // {
    //     parent::setUp();
    //     $this->withExceptionHandling();
    // }

    public function loginInUser($args = null)
    {
        $user = factory(User::class)->create($args);
        $this->actingAs($user);
    }
}
