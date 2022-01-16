<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->index();
            $table->string('title');
            $table->string('descr');
            $table->string('full_text');
            $table->string('image_url');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->enum('show_part', ['menu', 'service', 'menu_service', 'footer', 'agencies'])->default('menu');
            $table->string('lang');
            $table->string('cats');
            $table->text('tags')->comment('ای دی تگ ها');
            $table->integer('visit');
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
        Schema::dropIfExists('static_pages');
    }
}
