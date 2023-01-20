<?php

namespace Tests;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $loremListing = [
        'city' => 'Tetouan',
        'street' => 'Tetouan, Rue mohamed 6',
        'beds' => 2,
        'baths' => 2,
        'area' => 100,
        'code' => 'A1',
        'street_nr' => 100,
        'price' => 1000000,
    ];

    protected function user(): User
    {
        return User::factory()->create();
    }

    protected function admin(): User
    {
        return User::factory()->create();
    }

    protected function john(): User
    {
        return User::factory()->create();
    }

    protected function listing($id = null)
    {
        return Listing::factory()->lorem()->create([
            'owner_id' => $id ?? $this->user()->id
        ]);
    }
}
