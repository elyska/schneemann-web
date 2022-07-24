<?php

namespace App\Http\Middleware;

use App\Models\VerificationCode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $email = Auth::user()->email;
        //$now = Carbon::now();

        // get the expiration date of the code
        $expiration = VerificationCode::select('expires_at')->where('verifiable', $email)->get();

        // if the user is logged in and a code is required, ask for the code
        //if (Auth::check() && count($expiration) > 0 && $expiration[0]->expires_at > $now) {
        if (Auth::check() && count($expiration) > 0) {
            return redirect()->route('verify.index');
        }
        return $next($request);
    }
}
