<?php

namespace App\Http\Controllers\Listing;

use App\Models\Listing;
use App\Models\ListingImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RealtorListingImageRequest;

class RealtorListingImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Listing $listing
     * @return void
     */
    public function create(Listing $listing)
    {
        return inertia('Realtor/ListingImage/Create', [
            'listing' => $listing->load('images')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Listing $listing
     * @param  \Illuminate\Http\RealtorListingImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Listing $listing, RealtorListingImageRequest $request)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $listing->images()->save(
                    ListingImage::make(['path' => $path])
                );
            }
        }

        return redirect()->back()->with('success', 'Images uploaded!');
    }

    /**
     * delete resource
     *
     * @param Listing $listing
     * @param ListingImage $image
     * @return void
     */
    public function destroy(Listing $listing, ListingImage $image)
    {
        // Storage::disk('public')->delete($image->path);
        $image->delete();
        return redirect()->back()->with('success', 'Image was deleted!');
    }
}
