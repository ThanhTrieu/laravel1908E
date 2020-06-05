<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInfoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            //sua ten cot name tag
            $table->renameColumn('name', 'name_tag');
            // sua lai kieu du lieu cua cot
            $table->string('slug_tag',180)->change();
            $table->string('meta_seo')->nullable()->change();
            $table->dateTime('created_at')->nullable()->after('description_seo');
            $table->dateTime('updated_at')->nullable()->after('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            //
        });
    }
}
