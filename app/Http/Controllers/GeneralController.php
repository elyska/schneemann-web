<?php

namespace App\Http\Controllers;

use App\Models\ColourImage;
use App\Models\Product;
use App\Models\ProductColour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class GeneralController extends Controller
{
    public function index() {
        return view('welcome',[
        ]);
    }

    public function products() {

        //$products = Product::has('images')->get();

        $products = Product::with(['images' => function ($query) {
            $query->where('main', true);
        }, 'colours.images'])->get();

        //dd($products);


        return view('products',[
            "products" => $products
        ]);
    }

    public function productDetail($url) {

        //$products = Product::has('images')->get();

        $product = Product::where("url", $url)->with(['images', 'colours.images' => function ($query) {
            $query->where('main', true);
        }, 'colours.sizes'])->get()[0];

        return view('product-detail',[
            "product" => $product
        ]);
    }
    public function productDetailColour($url, $colour) {

        //$products = Product::has('images')->get();


        $product = Product::where("url", $url)->with(['colours', 'colours.images', 'colours.sizes'])->get()[0];


        //$otherColours = Product::where("url", $url)->with(['colours', 'colours.images'])->get();

       // dd($product)   ;

        return view('product-detail',[
            "product" => $product,
            "colour" => $colour
        ]);
    }

    public function changeLanguage(Request $request)
    {
        $language = $request->get('language');
        setcookie("language", $language, time() + (86400 * 30), "/"); // 86400 = 1 day
        return redirect()->back();
    }
}
