<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class VendorScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::check() && Auth::user()->hasRole('Vendor') && Auth::user()->vendor) {
            $builder->where('vendor_id', Auth::user()->vendor->vendor_id);
        }
    }
}
