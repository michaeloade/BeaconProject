<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Support\Carbon last_seen
 */
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
