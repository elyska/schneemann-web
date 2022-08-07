<?php

namespace App\Http\Controllers;

use App\Models\ColourImage;
use App\Models\Product;
use App\Models\ProductColour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use stdClass;

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
        // validate inputs
        $request->validate([
            "quantity" => 'min:1'
        ]);

        // get input values
        $id = $request->get("product-id");
        $quantity = $request->get("quantity");
        $colour = $request->get("colour");
        $size = $request->get("size");

        // create an object { productId: "", quantity: "", colour: "", size: "" }
        $newItem = new stdClass();
        $newItem->productId = $id;
        $newItem->quantity = $quantity;
        $newItem->colour = $colour;
        $newItem->size = $size;

        if($request->hasCookie('cartItems') == false) {
            // if the cart was empty

            //$cookieValue = '[{"productName":"'. $productName .'","quantity":'. $quantity .'}]';
            $cookieValue = json_encode(array($newItem));
        }
        else {
            $cookie = $request->cookie('cartItems');
            $cartItems = json_decode($cookie);

            $recordExists = false;
            foreach ($cartItems as $item) {
                if ($item->productId == $id && $item->colour == $colour && $item->size == $size) {
                    // if item exists, increase quantity
                    $recordExists = true;
                    $item->quantity = intval($item->quantity) + $quantity;
                    break;
                }
            }
            if (!$recordExists) {
                // if item does not exist, add new item
                array_push($cartItems, $newItem);
            }
            $cookieValue = json_encode($cartItems);
        }
        //dd($cookieValue);
        // cookie expires in 1 month = 48800 minutes
        Cookie::queue('cartItems', $cookieValue, 43800);

        //return redirect()->back()->with("status", "Product was added to cart successfully.{$id} {$quantity} {$colour} {$size}");
        return redirect("/cart");
    }

    public function removeFromCart(Request $request) {
        // get input values
        $productId = $request->get("productId");
        $colour = $request->get("colour");
        $size = $request->get("size");

        // get cart items from cookies
        $cookie = $request->cookie('cartItems');
        $cartItems = json_decode($cookie);


        // remove the product
        $newCartItems = [];
        foreach ($cartItems as $item) {
            if (!($item->productId == $productId && $item->colour == $colour && $item->size == $size)) {
                array_push($newCartItems, $item);
            }
        }

        $cookieValue = json_encode($newCartItems);
        // cookie expires in 1 month = 48800 minutes
        Cookie::queue('cartItems', $cookieValue, 43800);

        return redirect()->back();
    }

    public function changeQuantity(Request $request) {
        // validate inputs
        $request->validate([
            "quantity" => 'min:1'
        ]);

        // get input values
        $id = $request->get("productId");
        $colour = $request->get("colour");
        $size = $request->get("size");
        $quantity = $request->get("quantity");

        // get cart items from cookies
        $cookie = $request->cookie('cartItems');
        $cartItems = json_decode($cookie);

        // update quantity
        foreach ($cartItems as $item) {
            if ($item->productId == $id && $item->colour == $colour && $item->size == $size)  {
                // change quantity
                $item->quantity = $quantity;
                break;
            }
        }

        // save updates to cookies
        $cookieValue = json_encode($cartItems);
        // cookie expires in 1 month = 48800 minutes
        Cookie::queue('cartItems', $cookieValue, 43800);
    }

    public function cart(Request $request) {
        // if there are items in the cart
        if($request->hasCookie('cartItems')) {

            // get cartItems cookie
            $cookie = $request->cookie('cartItems');
            $cookieObj = json_decode($cookie);

            // get cartItems
            $cartProducts = Product::getCartItems($cookieObj);
        }
        else {
            $cartProducts = [];
        }
        return view('cart',[
            "cartItems" => $cartProducts
        ]);
    }
}
