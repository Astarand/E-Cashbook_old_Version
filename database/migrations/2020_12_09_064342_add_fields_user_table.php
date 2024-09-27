<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('u_type')->length(2)->default('2');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('phone_prefix');
            $table->string('phone_number');
            $table->string('paypal');
            $table->string('zipcode');
            $table->string('skype');
            $table->string('viber');
            $table->tinyInteger('receive_news')->length(2)->default('0');
            $table->tinyInteger('accept_policy')->length(2)->default('0');
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('u_type')->length(2)->default('2');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('phone_prefix');
            $table->string('phone_number');
            $table->string('paypal');
            $table->string('zipcode');
            $table->string('skype');
            $table->string('viber');
            $table->tinyInteger('receive_news')->length(2)->default('0');
            $table->tinyInteger('accept_policy')->length(2)->default('0');
        });
    }
}
