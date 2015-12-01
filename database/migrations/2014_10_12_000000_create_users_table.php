<?php

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
            $table->increments('id')->unsigned();
            $table->string('fname', 255);
            $table->string('lname', 255);
            $table->string('username', 255)
                ->unique()
                ->nullable();
            $table->string('password', 255);
            $table->string('email')->unique();
            $table->string('phone_no', 20)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('address')->nullable();
            $table->date('birthdate')->nullable();
            $table->boolean('is_active');
            $table->integer('status_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('creator_id');
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
