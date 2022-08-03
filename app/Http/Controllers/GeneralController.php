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

        $product = Product::where("url", $url)->with(['images'])->get()[0];

        return view('product-detail',[
            "product" => $product
        ]);
    }

    public function productDetailColour($url, $colour) {

        //$product = Product::where("url", $url)->with(['colours.images', 'colours.sizes'])->get()[0];

        $product = Product::where("url", $url)->with(['colours' => function ($query) use ($colour) {
            $query->where('colour', $colour);
        }, 'colours.images', 'colours.sizes'])->get()[0];


        $otherColours = Product::where("url", $url)->with(['colours.images' => function ($query) {
            $query->where('main', true);
        }])->get()[0];

        return view('product-detail',[
            "product" => $product,
            "colour" => $colour,
            "otherColours" => $otherColours
        ]);
    }

    public function changeLanguage(Request $request)
    {
        $language = $request->get('language');
        setcookie("language", $language, time() + (86400 * 30), "/"); // 86400 = 1 day
        return redirect()->back();
    }

    public function addToCart(Request $request) {
        $id = $request->get("product-id");
        $qty = $request->get("quantity");
        $colour = $request->get("colour");
        $size = $request->get("size");

        $array = [$id, $qty, $colour, $size];
        $cookie_value = json_encode($array);

        setcookie("cart", $cookie_value, time() + (86400 * 30)); // 86400 = 1 day

        return redirect()->back()->with("status", "Product was added to cart successfully.{$id} {$qty} {$colour} {$size}");
    }
}
