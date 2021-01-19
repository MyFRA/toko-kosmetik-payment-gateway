<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('product_name');
            $table->string('product_image_url');
            $table->string('product_url');
            $table->string('product_amount');
            $table->unsignedBigInteger('product_discount_percent')->nullable();
            $table->unsignedBigInteger('product_price');
            $table->unsignedBigInteger('product_price_after_discount');
            $table->unsignedBigInteger('product_weight');
            $table->string('product_variant')->nullable();
            $table->string('address_name');
            $table->string('customer_name');
            $table->string('number_phone');
            $table->string('province');
            $table->string('city');
            $table->string('postal_code');
            $table->string('full_address');
            $table->string('type_expedition');
            $table->unsignedBigInteger('price_expedition');
            $table->string('estimation_expedition');
            $table->string('desc_expedition');
            $table->unsignedBigInteger('price_total_payment');
            $table->unsignedBigInteger('product_weight_total');
            $table->string('proof_of_payment')->nullable();
            $table->string('bank_name');
            $table->string('bank_logo');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->enum('status', [
                'menunggu bukti pembayaran', 
                'menunggu konfirmasi bukit pembayaran',
                'dikemas',
                'dikirim',
                'diterima']);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
