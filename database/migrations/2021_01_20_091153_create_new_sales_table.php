<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewSalesTable extends Migration
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
            $table->unsignedBigInteger('weight_total');
            $table->unsignedBigInteger('price_total');
            $table->string('bank_sender_account_name')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->enum('status', [
                'belum bayar', 
                'menunggu konfirmasi bukti pembayaran',
                'dikemas',
                'dikirim',
                'diterima']);
            $table->timestamp('start_payment_date')->nullable();
            $table->timestamp('limit_payment_date')->nullable();
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
