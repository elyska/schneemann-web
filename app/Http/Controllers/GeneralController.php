<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class GeneralController extends Controller
{
    public function index() {
        return view('welcome',[
        ]);
    }

    public function changeLanguage(Request $request)
    {
        $language = $request->get('language');
        setcookie("language", $language, time() + (86400 * 30), "/"); // 86400 = 1 day
        return redirect()->back();
    }
}
