<?php

namespace Database\Seeders\database\seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->admin()->create();
        $john = User::factory()->john()->create();
        $users = User::factory(10)->create();
        $listings = Listing::factory(100)->create();
        $offers = Offer::factory(100)->make()->each(function($offer) use($listings, $users) {
            $offer->listing_id = $listings->random();
            $offer->bidder_id = $users->random();
            $offer->save();
        });
    }
}
