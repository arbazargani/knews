<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('family');
            $table->string('mobile');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->default('images/blank-avatar.jpg');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->enum('isadmin', ['yes', 'no'])->default('no');
            $table->enum('newsletter', ['yes', 'no'])->default('yes');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
