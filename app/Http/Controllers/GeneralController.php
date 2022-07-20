<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index() {
        return redirect('/cs');
    }
    public function indexCS() {
        return view('home',[
            "language" => 'cs'
        ]);
    }
    public function indexEN() {
        return view('home',[
            "language" => 'en'
        ]);
    }
}
