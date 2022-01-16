<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_uses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('title');
            $table->text('descr');
            $table->text('fulltext');
            $table->string('address');
            $table->string('ip');
            $table->string('lang',20);
            $table->enum('department', ['support', 'technical', 'feedback'])->default('support');
            $table->enum('status', ['read', 'unread'])->default('unread');
            $table->enum('type', ['about', 'contact'])->default('contact');

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
        Schema::dropIfExists('contact_uses');
    }
}
