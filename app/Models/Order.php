<?php

namespace App\Models;

use App\Classes\CurrencyConversion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function insertOrder($request, $destination, $products,$subtotalCZK, $subtotalEUR, $postageCZK, $postageEUR) {

        // get payment
        $payment = $request->cookie('payment');

        // get currency
        $language = $_COOKIE['language'];
        if ($language == "cs") $currency = "CZK";
        else $currency = "EUR";


        $sameBilAddress = $request->get("sameBilAddress");

        if ($sameBilAddress) {
            $orderId = self::insertGetId([
                "name" => $request->get("name"),
                "del_address_line_1" => $request->get("delAddressLine1"),
                "del_address_line_2" => $request->get("delAddressLine2"),
                "del_address_line_3" => $request->get("delAddressLine3"),
                "del_city" => $request->get("delCity"),
                "del_postcode" => $request->get("delPostcode"),
                "del_country" => $destination,
                "bil_address_line_1" => $request->get("delAddressLine1"),
                "bil_address_line_2" => $request->get("delAddressLine2"),
                "bil_address_line_3" => $request->get("delAddressLine3"),
                "bil_postcode" => $request->get("delPostcode"),
                "bil_city" => $request->get("delCity"),
                "bil_country" => $destination,
                "phone" => $request->get("phone"),
                "email" => $request->get("email"),
                "payment" => $payment,
                "currency" => $currency,
                "subtotal_czk" => $subtotalCZK,
                "subtotal_eur" => $subtotalEUR,
                "postage_eur" => $postageEUR,
                "postage_czk" => $postageCZK,
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()
            ]);
        }
        else {
            $orderId = self::insertGetId([
                "name" => $request->get("name"),
                "del_address_line_1" => $request->get("delAddressLine1"),
                "del_address_line_2" => $request->get("delAddressLine2"),
                "del_address_line_3" => $request->get("delAddressLine3"),
                "del_city" => $request->get("delCity"),
                "del_postcode" => $request->get("delPostcode"),
                "del_country" => $destination,
                "bil_address_line_1" => $request->get("bilAddressLine1"),
                "bil_address_line_2" => $request->get("bilAddressLine2"),
                "bil_address_line_3" => $request->get("bilAddressLine3"),
                "bil_postcode" => $request->get("bilPostcode"),
                "bil_city" => $request->get("bilCity"),
                "bil_country" => $request->get("bilCountry"),
                "phone" => $request->get("phone"),
                "email" => $request->get("email"),
                "payment" => $payment,
                "currency" => $currency,
                "subtotal_czk" => $subtotalCZK,
                "subtotal_eur" => $subtotalEUR,
                "postage_eur" => $postageEUR,
                "postage_czk" => $postageCZK,
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()
            ]);
        }

        $insertProducts = [];
        foreach ($products as $product) {
            array_push($insertProducts, [
                "order_id" => $orderId,
                "product_id" => $product->productId,
                "quantity" => $product->quantity,
                "colour" => $product->colour,
                "size" => $product->size,
                "file_name" => $product->image,
                "total_eur" => $product->price * $product->quantity,
                "total_czk" => CurrencyConversion::EURtoCZK($product->price) * $product->quantity,
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now()
            ]);
        }
        OrderItem::insert($insertProducts);
    }
}
