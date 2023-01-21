<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testRegsiterValid()
    {
        $response = $this->register();
        $response->assertStatus(302)
        ->assertSessionHas('success')
        ->assertRedirect(route('listings.index'));
        
        $this->assertEquals(session('success'), 'Account created!');
    }
}
