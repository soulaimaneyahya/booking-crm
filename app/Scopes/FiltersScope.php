<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FiltersScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        return $builder->when(request()->filled('priceFrom'), fn (Builder $query) => $query->where('price', '>=', request('priceFrom')))
        ->when(request()->filled('priceTo'), fn (Builder $query) => $query->where('price', '<=', request('priceTo')))
        ->when(request()->filled('beds'), fn (Builder $query) => $query->where('beds', request('beds')))
        ->when(request()->filled('baths'), fn (Builder $query) => $query->where('baths', request('baths')))
        ->when(request()->filled('areaFrom'), fn (Builder $query) => $query->where('area', '>=', request('areaFrom')))
        ->when(request()->filled('areaTo'), fn (Builder $query) => $query->where('area', '<=', request('areaTo')))
        ->when(request()->filled('areaTo'), fn (Builder $query) => $query->where('area', '<=', request('areaTo')))
        ->when(request('deleted') == 'true', fn (Builder $query) => $query->onlyTrashed())
        ->when(request()->filled('by'), fn (Builder $query) => in_array(request('by'), $model->sortable) ? $query->orderBy(request('by'), request('order') ?? 'desc') : $query);
    }
}
