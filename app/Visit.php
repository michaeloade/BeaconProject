<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Visit extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beacon()
    {
        return $this->belongsTo(Beacon::class);
    }
}
