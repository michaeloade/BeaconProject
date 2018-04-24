<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        try {
            /** @var User $user */
            $user = User::where('email', $request->username)->firstOrFail();
            if($user->authAttempt($request->password)) {
                $user = Auth::user();
                if(empty($user->api_token)) {
                    $user->api_token = base64_encode("{$request->username}:{$request->password}");
                    $user->save();
                }
                return $user;
            } else {
                throw new UnauthorizedException("Bad Login");
            };
        } catch (\Exception $e) {
            abort(Response::HTTP_UNAUTHORIZED, "Incorrect credentials");
        }


    }
}
