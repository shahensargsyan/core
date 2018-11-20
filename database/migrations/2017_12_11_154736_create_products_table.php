<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('image')->nullable();
            $table->string('additional_product_features');
            $table->string('product_code');
            $table->integer('fuel_type_id')->unsigned();
            $table->integer('fireplace_type_id')->unsigned();
            $table->integer('fireplace_size_range_id')->unsigned();
            $table->integer('heat_output_range_id')->unsigned();
            $table->integer('price_range_id')->unsigned();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            
        });
    }
    /**
     * Reverse the migrations.
     * 
        

     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
