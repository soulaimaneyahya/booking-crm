<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password', // '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'created_at' => fake()->dateTimeBetween('-5 weeks')
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function john()
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'john doe',
            'username' => 'johndoe',
            'email' => 'johndoe@gmail.com'
        ]);
    }

    public function admin()
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin' => 1
        ]);
    }
}
