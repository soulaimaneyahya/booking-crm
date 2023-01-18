<?php

namespace App\Observers;

use App\Models\Offer;

class OfferObserver
{
    public function creating(Offer $offer)
    {
        $today = date('Ymd');
        $offersToday = Offer::where('offer_no', 'like', "{$today}%")->pluck('offer_no');
        do {
            $offerNo = $today . rand(10000, 99999);
        } while ($offersToday->contains($offerNo));
        $offer->offer_no = $offerNo;
    }
}
