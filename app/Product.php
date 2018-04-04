<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Product extends Model
{
    public function beacons()
    {
        return $this->belongsToMany(Beacon::class, 'beacon_products');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
