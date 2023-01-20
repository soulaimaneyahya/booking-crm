<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\ListingRequest;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        return inertia('Realtor/Index', [
            'filters' => [
                'deleted' => $request->boolean('deleted'),
                ...$request->only(['by', 'order'])
            ],
            'listings' => auth()->user()
            ->listings()
            ->withCount('images')
            ->withCount('offers')
            ->withTrashed()
            ->paginate(6)
            ->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Realtor/Create');
    }

    /**
     * show
     *
     * @param Listing $listing
     * @return void
     */
    public function show(Listing $listing)
    {
        return inertia(
            'Realtor/Show',
            ['listing' => $listing->load('offers', 'offers.bidder')]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ListingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingRequest $request)
    {
        $listing = auth()->user()->listings()->create($request->validated());
        return redirect()->route('listings.show', $listing)->with('success', 'Listing was created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        // $this->authorize('update');
        return inertia('Realtor/Edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ListingRequest  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(ListingRequest $request, Listing $listing)
    {
        // $this->authorize('update');
        $listing->update($request->validated());
        return redirect()->route('listings.show', $listing)->with('success', 'Listing was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->back()->with('success', 'Listing was deleted!');
    }

    /**
     * Restore item
     *
     * @param Listing $listing
     * @return void
     */
    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
