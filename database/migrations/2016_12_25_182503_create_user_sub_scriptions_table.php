<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubScriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sub_scriptions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id', false, true)->index();
            $table->integer('subscription_id', false, true)->index();

            $table->enum('status', ['active', 'deactive'])->default('active');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subscription_id')->references('id')->on('sub_scriptions');

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
        Schema::dropIfExists('user_sub_scriptions');
    }
}
