<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use NextApps\VerificationCode\VerificationCode;

class TwoFactorController extends Controller
{
    public function index()
    {
        // if the user is logged in and needs two-factor authentication, ask for an authentication code
        if (Auth::check()) {
            $email = Auth::user()->email;
            // get the expiration date of the code
            $expiration = \App\Models\VerificationCode::select('expires_at')->where('verifiable', $email)->get();

            // if the user needs two-factor authentication
            if (count($expiration) != 0) return view('auth.two-factor');
        }
        return redirect()->route('login');
    }

    public function sendCode() {
        VerificationCode::send(Auth::user()->email);
        return redirect()->back();
    }

    public function checkCode(Request $request) {
        $code = $request->get("two_factor_code");
        $email = Auth::user()->email;
        // check the code
        if (VerificationCode::verify($code, $email)) { // correct code
            // if the trusted-device cookie is set, add new email address
            if($request->hasCookie('trusted-device')) {
                // get trusted-device cookie
                $cookie = $request->cookie('trusted-device');
                // cookie value to array
                $emails = json_decode($cookie);
                // add new email address
                array_push($emails, $email);
                // cookie value to json string
                $cookieValue = json_encode($emails);
            }
            // if the trusted-device cookie is not set, create an array with the new email address
            else {
                $cookieValue = json_encode(array($email));
            }
            Cookie::queue('trusted-device', $cookieValue, 43800);
            return redirect()->route('home');
        }
        // incorrect code
        return redirect()->back()
            ->withErrors(['two_factor_code' =>
                'The two factor code you have entered is incorrect or expired.']);
    }
}
