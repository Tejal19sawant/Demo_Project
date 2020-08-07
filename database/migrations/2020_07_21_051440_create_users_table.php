<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->timestamps();
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('country');
            $table->string('pincode');
            $table->string('mobile');
            $table->string('email_verified_at')->nullable();
            $table->boolean('admin')->default('0');
            $table->string('password');
            $table->string('confirmpassword');
            $table->string('remember_token')->nullable();
            $table->boolean('status')->default('1');
            $table->string('role')->default('admin');
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
