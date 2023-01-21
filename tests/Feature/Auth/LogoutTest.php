<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testLogoutFailed()
    {
        $user = $this->user();
        $this->actingAs($user);
        
        $response = $this
        ->post('/logout')
        ->assertStatus(302)
        ->assertSessionHas('success')
        ->assertRedirect(route('listings.index'));
        
        $this->assertEquals(session('success'), 'Logout Success!');
    }
}
