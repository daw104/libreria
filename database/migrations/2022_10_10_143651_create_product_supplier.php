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
    public function up()
    {
        Schema::create('product_supplier', function (Blueprint $table) {
            $table->primary(['product_id','supplier_id']);
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('supplier_id')->unsigned();
            $table->string('quantity');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products'); //referencia fk a la tabla orders
            $table->foreign('supplier_id')->references('id')->on('suppliers'); //referencia fk a la tabla products
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_supplier');
    }
};
