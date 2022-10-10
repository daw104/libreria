<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('order_product', function (Blueprint $table) {
            $table->primary(['order_id','product_id']);
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('quantity');
            $table->timestamps();
            $table->foreign('order_id') //referencia fk a la tabla orders
                ->references('id')
                ->on('orders');
            $table->foreign('product_id') //referencia fk a la tabla products
                ->references('id')
                ->on('products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};
