<?php

namespace Tests\Feature\Listing;

use App\Models\ListingImage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RealtorListingImageTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $path;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->user();
        $this->actingAs($this->user);

        $this->path = public_path('img/1.jpg');
    }
    public function testStoreValid()
    {
        $listing = $this->listing($this->user->id);
        $path = public_path('img/1.jpg');
        $image = new UploadedFile($path, '1.jpg', 'image/jpg', 0, true);
        $params = [
            'images' => $image,
        ];
        $this->post("/realtor/listings/{$listing->id}/image", $params)
            ->assertStatus(302)
            ->assertSessionHas('success');
        $this->assertEquals(session('success'), 'Images uploaded!');
    }

    public function testStoreFailed()
    {
        $listing = $this->listing($this->user->id);
        $this->post("/realtor/listings/{$listing->id}/image", [])
            ->assertStatus(302)
            ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['images'][0], 'The images field is required.');
    }

    public function testDestroy()
    {
        $listing = $this->listing($this->user->id);
        $image1 = $this->uploadImage($listing->id);

        $params = [
            'images' => [
                $image1
            ],
        ];

        $this->post("/realtor/listings/{$listing->id}/image", $params)
            ->assertStatus(302)
            ->assertSessionHas('success');

        $listingImage = ListingImage::latest()->select(['id', 'path', 'listing_id'])->first();

        $this->assertDatabaseHas('listing_images', [
            'id' => $listingImage->id,
            'listing_id' => $listing->id,
            'path' => $listingImage->path,
        ]);

        $this->delete("/realtor/listings/{$listing->id}/image/{$listingImage->id}", $params)
        ->assertStatus(302)
        ->assertSessionHas('success');

        $this->assertEquals(session('success'), 'Image was deleted!');
        $this->assertTrue(Storage::disk('public')->delete($listingImage->path));
    }

    protected function uploadImage()
    {
        return new UploadedFile($this->path, '1.jpg', 'image/jpg', 0, true);
    }
}
