<?php

namespace App\Http\Controllers\Listing;

use App\Models\Offer;
use App\Models\Listing;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use App\Notifications\OfferMade;
use Illuminate\Validation\ValidationException;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, OfferRequest $request)
    {
        $this->authorize('view', $listing);
        $this->validationException($listing);

        $offer = $listing->offers()->save(
            Offer::make($request->validated())->bidder()->associate($request->user())
        );
        // $request->user()->offers()->save(
        //     Offer::firstOrNew($request->validated())->listing()->associate($listing)
        // );

        $listing->owner->notify(new OfferMade($offer));

        return redirect()->back()->with(
            'success',
            'Offer was made!'
        );
    }

    private function validationException(Listing $listing)
    {
        if ($listing->offers()->offerMade()->first()) {
            $error = ValidationException::withMessages([
                'availability' => ['Offer already made'],
            ]);
            throw $error;
        }
    }
}
