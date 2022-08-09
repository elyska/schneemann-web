<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title_cz', 100);
            $table->string('title_en', 100);
            $table->string('url', 100);
            $table->unsignedDecimal("price", $precision = 6, $scale = 2);
            $table->unsignedDecimal("weight", $precision = 4, $scale = 2);
            $table->text("description_cz");
            $table->text("description_en");
            $table->smallInteger("stock_quantity")->nullable();
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
        Schema::dropIfExists('products');
    }
}
