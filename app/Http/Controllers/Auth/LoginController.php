<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use NextApps\VerificationCode\VerificationCode;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        // if the user verified the account on this device before, do not require a code again
        if(!isset($_COOKIE['trusted-device']) || !in_array($user->email, json_decode($request->cookie('trusted-device')))) { //|| in_array(json_decode($request->cookie('trusted-device')), $user->email)
            // send verification code
            VerificationCode::send($user->email);
        }/*
        else {
            $cookie = json_decode($request->cookie('trusted-device'));
            dd(in_array($user->email, $cookie));
        }*/
    }
}
