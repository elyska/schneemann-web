<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GeneralController extends Controller
{
    public function index() {
        return view('welcome',[
        ]);
    }

    public function changeLanguage(Request $request)
    {
        $language = $request->get('language');
        // cookie expires in 1 month = 48800 minutes
        //Cookie::queue('cartItems', $cookieValue, 43800);
        setcookie("language", $language, time() + (86400 * 30), "/"); // 86400 = 1 day
        return redirect()->back();
    }
}
