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
            'distance' => 'required',
            'user' => 'required|exists:users,email'
        ]);

        /** @var Beacon $beacon */
        $beacon = Beacon::where('beacon_id', $request->beacon)->firstOrFail();
        $beacon->last_seen = $beacon->freshTimestamp();
        $beacon->save();
        //TODO::Move to authenticated user.
        $user = User::where('email', $request->user)->first();
        if(empty($beacon->visits)) {
            $this->recordVisit($request, $user, $beacon);
        } else {
            if(Carbon::now()->subMinutes(config('beacon.timeout', 1))->greaterThan($beacon->visits()->latest()->first()->created_at)) {
                $this->recordVisit($request, $user, $beacon);
            } else {
                return $beacon->visits()->latest()->first();
            }
        }
        return $this->visit;
    }

    private function recordVisit($request, $user, $beacon)
    {
        $this->visit->distance = $request->distance;
        $this->visit->beacon()->associate($beacon);
        $this->visit->user()->associate($user);
        $this->visit->save();
        event(new UserVisitEvent($this->visit));
    }
}
