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
            $table->increments('id');
            $table->string('name_customer',60);
            $table->string('add_customer',200);
            $table->string('phone_customer',20);
            $table->string('email_customer',60)->unique();
            $table->text('note_customer')->nullable();
            $table->integer('qty_buy')->unsigned();
            $table->tinyInteger('type_payment')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->string('code',100)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
