<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',60)->unique();
            $table->string('password',60);
            $table->string('email',60)->unique();
            $table->string('phone',20);
            $table->string('fullname',60);
            $table->string('address',180);
            $table->string('avatar',100)->nullable();
            $table->tinyInteger('gender')->default(1);
            $table->date('birthday')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('last_login')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
