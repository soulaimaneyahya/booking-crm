<?php

namespace Tests\Feature\Listing;

use App\Models\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RealtorListingTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->user();
        $this->actingAs($this->user);
    }

    public function testStoreValid()
    {
        $params = [
            'beds' => fake()->numberBetween(1, 20),
            'baths' => fake()->numberBetween(1, 20),
            'area' => fake()->numberBetween(15, 1500),
            'city' => fake()->city(),
            'code' => fake()->postcode(),
            'street' => fake()->streetName(),
            'street_nr' => fake()->numberBetween(1, 1000),
            'price' => fake()->randomFloat(2, 30000, 1000000),
        ];

        $this->post('/realtor/listings', $params)
            ->assertStatus(302)
            ->assertSessionHas('success');

        $this->assertEquals(session('success'), 'Listing was created!');
    }

    public function testStoreFail()
    {
        $this->actingAs($this->user())
            ->post('/realtor/listings', [
                'beds' => 0,
                'baths' => 0,
                'area' => 0,
                'price' => 0,
                'city' => null,
                'street' => null,
                'code' => null,
            ])
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['beds'][0], 'The beds must be at least 1.');
        $this->assertEquals($messages['baths'][0], 'The baths must be at least 1.');
        $this->assertEquals($messages['area'][0], 'The area must be at least 15.');
        $this->assertEquals($messages['city'][0], 'The city must be a string.');
        $this->assertEquals($messages['code'][0], 'The code must be a string.');
        $this->assertEquals($messages['street'][0], 'The street must be a string.');
        $this->assertEquals($messages['street_nr'][0], 'The street nr field is required.');
        $this->assertEquals($messages['price'][0], 'The price must be between 10000 and 1000000.');
    }

    public function testUpdateValid()
    {
        $listing = $this->listing($this->user->id);

        $this->assertDatabaseHas('listings', $this->loremListing);

        $listing->street = 'Tetouan, rue 1';

        $this->put("/realtor/listings/{$listing->id}", $listing->toArray())
            ->assertStatus(302)
            ->assertSessionHas('success');

        $this->assertEquals(session('success'), 'Listing was updated!');
        $this->assertDatabaseMissing('listings', [
            'street' => 'Tetouan, Rue mohamed 6',
        ]);
        $this->assertDatabaseHas('listings', [
            'street' => 'Tetouan, rue 1',
        ]);
    }

    public function testDelete()
    {
        $listing = $this->listing($this->user->id);

        // prevent 403 error & listingPolicy
        $this->assertTrue($this->user->id == $listing->owner_id);
        $this->tryDeleting($listing->id);
        $this->assertEquals(session('success'), 'Listing was deleted!');

        // $this->assertDatabaseMissing('listings', $listing->fresh()->toArray());
        // dump(Listing::withTrashed()->latest()->first()->id);
        // $this->assertTrue($listing->trashed());
        $this->assertSoftDeleted('listings', $this->loremListing);
    }

    public function testRestore()
    {
        $listing = $this->listing($this->user->id);

        // prevent 403 error & listingPolicy
        $this->assertTrue($this->user->id == $listing->owner_id);

        // deleting
        $this->tryDeleting($listing->id);

        // restoring
        $this->put("/realtor/listings/{$listing->id}/restore")
        ->assertStatus(302)
        ->assertSessionHas('success');
        $this->assertEquals(session('success'), 'Listing was restored!');
        $this->assertNull($listing->deleted_at);
    }

    protected function tryDeleting($id)
    {
        return $this->delete("/realtor/listings/{$id}")
        ->assertStatus(302)
        ->assertSessionHas('success');
    }
}
