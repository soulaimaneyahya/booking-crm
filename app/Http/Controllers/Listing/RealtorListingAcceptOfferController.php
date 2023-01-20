<?php

namespace App\Http\Controllers\Listing;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RealtorListingAcceptOfferController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Offer $offer
     * @return void
     */
    public function __invoke(Request $request, Offer $offer)
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);

        // Accept selected offer
        $offer->update(['accepted_at' => now()]);
        $listing->update(['sold_at' => now()]);
        // Reject all other offers
        $listing->offers()->except($offer)
            ->update(['rejected_at' => now()]);

        return redirect()->back()
            ->with(
                'success',
                "Offer #{$offer->offer_no} accepted, other offers rejected"
            );
    }
}
