<?php

namespace App\Models;

use App\Scopes\LatestScope;
use App\Scopes\FiltersScope;
use App\Scopes\DeletedAdminScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Listing extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price', 'owner_id', 'sold_at'
    ];

    public $sortable = [
        'price', 'created_at'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    // scope, instead of adding new column called, sold_at
    public function scopeWithoutSold(Builder $query): Builder
    {
        // return $query->doesntHave('offers')
        //     ->orWhereHas(
        //         'offers',
        //         fn (Builder $query) => $query->whereNull('accepted_at')
        //             ->whereNull('rejected_at')
        //     );

        return $query->whereNull('sold_at');
    }

    public static function boot()
    {
        // before parent boot, in cause of soft deletes
        static::addGlobalScope(new DeletedAdminScope);
        parent::boot();

        // register global scopes
        static::addGlobalScope(new FiltersScope);
        static::addGlobalScope(new LatestScope);
    }
}
