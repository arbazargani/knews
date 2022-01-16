<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id',false,true);
            $table->integer('cat_id',false,true);

            /*$table->integer('user_id', false, true)->index();
            $table->string('title');
            $table->text('descr');
            $table->string('image_url');
            $table->string('module');
            $table->text('property');
            $table->string('lang', 20)->default('fa');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->integer('show_order')->default(0);
            $table->integer('parent_id', false, true)->index()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('parent_id')->references('id')->on('product_cats');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_cats');
    }
}
