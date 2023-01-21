<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginFailed()
    {
        $this->post("/login", [])
            ->assertStatus(302)
            ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['email'][0], 'The email field is required.');
        $this->assertEquals($messages['password'][0], 'The password field is required.');

        $this->post("/login", [
            'email' => "pewys@mailinator.com",
            'password' => "pa--word",
        ])
        ->assertStatus(302)
        ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['email'][0], 'These credentials do not match our records.');
    }

    public function testLoginValid()
    {
        $user = $this->user();
        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);
        $params = [
            'email' => $user->email,
            'password' => $user->password
        ];
        $this->actingAs($user);
    }
}
