<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'twofactor']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // add trusted device after registration
        $email = Auth::user()->email;
        // if the trusted-device cookie is not set, add the new email address
        if($request->hasCookie('trusted-device')) {
            // get trusted-device cookie
            $cookie = $request->cookie('trusted-device');
            // cookie value to array
            $emails = json_decode($cookie);

            // add new email address if it does not exist
            if (!in_array($email, $emails)) {
                array_push($emails, $email);

                // cookie value to json string
                $cookieValue = json_encode($emails);
                Cookie::queue('trusted-device', $cookieValue, 43800);
            }
        }
        // if the trusted-device cookie is not set, create an array with the new email address
        else {
            $cookieValue = json_encode(array($email));
            Cookie::queue('trusted-device', $cookieValue, 43800);
        }

        return view('home');
    }
}
