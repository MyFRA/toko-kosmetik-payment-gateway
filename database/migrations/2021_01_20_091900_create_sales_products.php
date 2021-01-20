<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_id');
            $table->string('product_name');
            $table->string('product_image_url');
            $table->string('product_url');
            $table->string('product_amount');
            $table->unsignedBigInteger('product_discount_percent')->nullable();
            $table->unsignedBigInteger('product_price');
            $table->unsignedBigInteger('product_price_after_discount');
            $table->unsignedBigInteger('product_weight');
            $table->string('product_variant')->nullable();
            $table->timestamps();

            $table->foreign('sales_id')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_products');
    }
}
