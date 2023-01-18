<?php

namespace App\Http\Controllers\Listing;

use Inertia\Response;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request): Response
    {
        $listings = Listing::latest()->with('owner')
        ->withoutSold()
        ->paginate(10)
        ->withQueryString();

        // ->where('owner_id', auth()->id())
        return inertia('Listing/Index', [
            'listings' => $listings,
            'filters' => $request->only([
                'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
            ]),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Inertia\Response
     */
    public function show(Listing $listing): Response
    {
        return inertia('Listing/Show', [
            'listing' => $listing->load(['images']),
            'offerMade' => $listing->offers()->offerMade()->first()
        ]);
    }
}
