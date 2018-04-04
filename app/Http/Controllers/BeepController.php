<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Product;
use App\Visit;
use Illuminate\Http\Request;

class BeepController extends SecureController
{
    private $visit;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    public function store(Request $request)
    {
        $beacon = Beacon::firstOrFail($request->beacon);

        $this->visit->beacon()->associate($beacon);

    }
}
