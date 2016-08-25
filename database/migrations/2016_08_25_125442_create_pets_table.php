<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('pet_id');
            $table->string('title',100)->comment('');
            $table->string('image',255)->nullable()->comment('');
            $table->unsignedInteger('point2_day')->default(0)->comment('');
            $table->unsignedInteger('life')->default(0)->comment('');
            $table->unsignedInteger('money')->default(0)->comment('');
            $table->unsignedInteger('min_level')->default(1)->comment('');
            $table->unsignedInteger('buy_limit')->default(0)->comment('');
            $table->unsignedInteger('max_limit')->default(0)->comment('');
            $table->unsignedInteger('sort_order')->default(100)->comment('');
            $table->dateTime('add_time')->nullable()->comment('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pets');
    }
}
