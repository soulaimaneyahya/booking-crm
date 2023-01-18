<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Listing\ListingController;
use App\Http\Controllers\Listing\ListingOfferController;
use App\Http\Controllers\Listing\RealtorListingController;
use App\Http\Controllers\Listing\RealtorListingImageController;
use App\Http\Controllers\Listing\RealtorListingAcceptOfferController;

use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\NotificationSeenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    dd($token);
});

Route::GET('/', [IndexController::class, 'index'])->name('index');
Route::resource('listings', ListingController::class)->only(['index', 'show']);

Route::group(['middleware' => ['guest']], function(){
    Route::GET('login', [LoginController::class, 'index'])->name('login');
    Route::POST('login', [LoginController::class, 'store']);
    Route::GET('register', [RegisterController::class, 'index'])->name('register');
    Route::POST('register', [RegisterController::class, 'store']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::resource('listings.offer', ListingOfferController::class)->only(['store']);
    Route::group(['prefix' => 'realtor', 'as' => 'realtor.'], function () {
        Route::name('listings.restore')->put('listings/{listing}/restore', [RealtorListingController::class, 'restore'])->withTrashed();
        Route::resource('listings', RealtorListingController::class)->withTrashed();
        Route::resource('listings.image', RealtorListingImageController::class)->only(['create', 'store', 'destroy']);
        Route::PUT('offers/{offer}/accept', RealtorListingAcceptOfferController::class)->name('offer.accept');
    });
    
    Route::PUT('notifications/{notification}/seen', NotificationSeenController::class)->name('notifications.seen');
    Route::GET('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::POST('logout', [LogoutController::class, 'logout'])->name('logout');
});
