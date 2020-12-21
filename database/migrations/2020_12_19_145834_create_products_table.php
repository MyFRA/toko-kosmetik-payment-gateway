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
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('product_slug')->unique();
            $table->unsignedBigInteger('product_category_id');
            $table->bigInteger('price');
            $table->bigInteger('weight');
            $table->bigInteger('amount');
            $table->enum('condition', ['baru', 'bekas']);
            $table->longText('product_images');
            $table->text('description');
            $table->bigInteger('sold')->default(0);
            $table->bigInteger('counter')->default(0);
            $table->timestamps();

            $table->index(['product_category_id']);
            $table->foreign('product_category_id')->references('id')->on('product_categories');
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
