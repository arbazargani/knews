<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('News', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->comment('تیتر')->index();
            $table->string('descr', 500)->comment('لید');
            $table->text('full_text')->comment('متن');
            $table->string('type')->comment('نوع خبر');
            $table->string('image_url', 250)->comment('تصویر شاخص');
            $table->integer('user_id', false, true)->index();
            $table->integer('cat_id', false, true)->index();
            $table->string('lang', 20)->default('fa');
            $table->text('tags')->comment('ای دی تگ ها');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->enum('slider', ['yes', 'no'])->default('no');
            $table->integer('visit');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cat_id')->references('id')->on('news_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('News');
    }
}
