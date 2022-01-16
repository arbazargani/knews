<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id', false, true)->index();
            $table->integer('product_id', false, true)->index();

            $table->enum('user_status', ['favorite', 'pre_order', 'order']);
            $table->enum('admin_status', ['wait', 'call', 'pre_order', 'order'])->default('wait');
            $table->text('admin_descr');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');

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
        Schema::dropIfExists('user_products');
    }
}
