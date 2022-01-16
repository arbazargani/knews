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

            $table->integer('user_id', false, true);
            $table->string('title');
            $table->string('descr');
            $table->text('fulltext');
            $table->text('imgs');
            $table->text('files');
            $table->text('video');
            $table->text('audio');
            $table->text('cats')->nullable();
            $table->integer('show_order')->default(0);
            $table->string('lang', 20)->default('fa');
            $table->integer('price')->default(0);
            $table->integer('visit')->default(0);
            $table->enum('status',['active','inactive'])->default('active');

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
        Schema::dropIfExists('products');
    }
}
