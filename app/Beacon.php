<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Beacon extends Model
{

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'beacon_products');
    }
}
