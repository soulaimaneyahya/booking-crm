<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'beds' => fake()->numberBetween(1, 20),
            'baths' => fake()->numberBetween(1, 20),
            'area' => fake()->numberBetween(15, 1500),
            'city' => fake()->city(),
            'code' => fake()->postcode(),
            'street' => fake()->streetName(),
            'street_nr' => fake()->numberBetween(1, 1000),
            'price' => fake()->randomFloat(2, 30000, 1000000),
            'owner_id' => User::all()->random()->id,
            'created_at' => fake()->dateTimeBetween('-3 weeks')
        ];
    }

    // state fn for testing
    public function lorem()
    {
        return $this->state(fn () => [
            'city' => 'Tetouan',
            'street' => 'Tetouan, Rue mohamed 6',
            'city' => 'Tetouan',
            'street' => 'Tetouan, Rue mohamed 6',
            'city' => 'Tetouan',
            'street' => 'Tetouan, Rue mohamed 6',
            'city' => 'Tetouan',
            'street' => 'Tetouan, Rue mohamed 6',
            'beds' => 2,
            'baths' => 2,
            'area' => 100,
            'code' => 'A1',
            'street_nr' => 100,
            'price' => 1000000,
        ]);
    }
}
