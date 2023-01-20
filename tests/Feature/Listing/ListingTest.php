<?php

namespace Tests\Feature\Listing;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListingTest extends TestCase
{
    use RefreshDatabase;

    public function testLinstingIndex()
    {
        // Arrange
        $listing = $this->listing();
        // Assert
        $this->assertDatabaseHas('listings', $this->loremListing);
    }
}
