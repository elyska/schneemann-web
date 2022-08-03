<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("name",255);
            $table->string("del_address_line_1",80);
            $table->string("del_address_line_2",80)->nullable();
            $table->string("del_address_line_3",80)->nullable();
            $table->string("del_city",80);
            $table->string("del_postcode",15);
            $table->string("delCountry",60);
            $table->string("bil_address_line_1",80);
            $table->string("bil_address_line_2",80)->nullable();
            $table->string("bil_address_line_3",80)->nullable();
            $table->string("bil_city",80);
            $table->string("bil_postcode",15);
            $table->string("bil_country",60);
            $table->string("phone",20);
            $table->string("email",60);
            $table->string("delivery",60);
            $table->string("payment",60);
            $table->string("currency",3);
            $table->unsignedDecimal("total_eur", $precision = 6, $scale = 2);
            $table->unsignedDecimal("total_czk", $precision = 7, $scale = 2);
            $table->unsignedDecimal("postage_eur", $precision = 5, $scale = 2);
            $table->unsignedDecimal("postage_czk", $precision = 6, $scale = 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
