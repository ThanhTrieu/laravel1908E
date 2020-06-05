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
            $table->increments('id');
            $table->integer('categories_id')->unsigned();
            $table->integer('brands_id')->unsigned();
            $table->string('name_product',180);
            $table->string('slug_product',200);
            $table->string('image',200);
            $table->integer('qty')->unsigned();
            $table->integer('price')->unsigned();
            $table->tinyInteger('status')->default(1);
            $table->integer('sale_off')->nullable();
            $table->string('code_product')->nullable();
            $table->integer('view')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
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
