<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class ListingImage extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = ['path'];
    protected $appends = ['src'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    // getRealSrcAttribute -> real_src
    public function getSrcAttribute()
    {
        return Storage::url($this->path);
    }
}
