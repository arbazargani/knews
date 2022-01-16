<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubScriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_scriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->index();
            $table->string('title');
            $table->integer('count_product');
            $table->string('lang');
            $table->enum('special_page', ['yes', 'no'])->default('no');
            $table->enum('special_page_slider', ['yes', 'no'])->default('no');
            $table->enum('advertising', ['yes', 'no'])->default('no');
            $table->enum('message', ['yes', 'no'])->default('no');
            $table->integer('duration_membership');
            $table->integer('base_price');
            $table->integer('price_product_addition');

            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('sub_scriptions');
    }
}
