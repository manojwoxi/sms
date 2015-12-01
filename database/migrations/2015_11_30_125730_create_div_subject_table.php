<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('div_subject', function (Blueprint $table) {
            $table->increments('id')->unsigned();;
            $table->integer('div_id')->unsigned();;
            $table->integer('teacher_id')->unsigned();;
            $table->integer('subject_id')->unsigned();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('div_subject');
    }
}
