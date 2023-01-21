<?php

namespace Tests\Unit\Listing;

use Tests\TestCase;
use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingAcceptOfferTest extends TestCase
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
    public function testListingAcceptOffer()
    {
        $user = $this->user;
        $listing = $this->listing($user->id);
        $offer = $this->offer($listing->id, $user->id);
        $this->put("/realtor/offers/{$offer->id}/accept", $offer->toArray())
            ->assertStatus(302)
            ->assertSessionHas('success');

        // dd($offer); // refresh db
        $listing->refresh();
        $offer->refresh();

        $this->assertNotNull($offer->accepted_at);
        $this->assertNotNull($listing->sold_at);
        $this->assertEquals(session('success'), "Offer #{$offer->offer_no} accepted, other offers rejected");
    }
}
