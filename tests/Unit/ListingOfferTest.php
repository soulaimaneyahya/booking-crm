<?php

namespace Tests\Unit\Listing;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListingOfferTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->user();
        $this->actingAs($this->user);
    }

    /**
     * @return void
     */
    public function testListingOffer()
    {
        $listing = $this->listing($this->user->id);
        $this->post("/listings/{$listing->id}/offer", [
            'amount' => 25000
        ])
        ->assertStatus(302)
        ->assertSessionHas('success');

        $this->assertEquals(session('success'), "Offer was made!");
    }

    public function testListingFailed()
    {
        $listing = $this->listing($this->user->id);
        $this->post("/listings/{$listing->id}/offer", [
            'amount' => 100
        ])
        ->assertStatus(302)
        ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['amount'][0], 'The amount must be between 10000 and  1000000.');
    }
}
