<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            // kieu varchar(60)
            // mac dinh ko null - khong trung nhau
            $table->string('username',60)->unique();
            $table->string('password',60);
            $table->string('email',100)->unique();
            $table->tinyInteger('role')->default(1);
            $table->string('phone',20);
            $table->string('fullname',60);
            $table->string('address',180);
            // avatar dc phep null
            $table->string('avatar',150)->nullable();
            $table->date('birthday')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
