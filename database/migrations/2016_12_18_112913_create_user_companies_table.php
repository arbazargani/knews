<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->index();
            $table->string('company_name');
            $table->string('brand');
            $table->string('company_addr');
            $table->string('country_id');
            $table->string('zone_id');
            $table->string('city');
            $table->string('postcode');
            $table->string('tel');
            $table->string('fax');
            $table->text('slider');
            $table->timestamp('slider_start_at');
            $table->timestamp('slider_end_at');
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
        Schema::dropIfExists('user_companies');
    }
}
