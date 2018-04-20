<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Events\UserVisitEvent;
use App\User;
use App\Visit;
use Carbon\Carbon;
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
        $this->validate($request, [
            'beacon' => 'required',
            'distance' => 'required'
        ]);

        /** @var Beacon $beacon */
        $beacon = Beacon::where('beacon_id', $request->beacon)->firstOrFail();
        $beacon->last_seen = $beacon->freshTimestamp();
        $beacon->save();
        $user = User::first();
        if(Carbon::now()->subMinutes(config('beacon.timeout', 0))->greaterThan($beacon->visits()->latest()->first()->created_at)) {
            $this->visit->distance = $request->distance;
            $this->visit->beacon()->associate($beacon);
            $this->visit->user()->associate($user);
            $this->visit->save();
            event(new UserVisitEvent($this->visit));
        }
        return $this->visit;
    }
}
