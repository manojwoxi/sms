<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marksheet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stud_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('marks');

            $table->timestamps();
        });

        Schema::table('marksheet', function($table) {
            $table->foreign('stud_id')->references('id')->on('student')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exam')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subject')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marksheet', function (Blueprint $table) {
        $table->dropForeign('marksheet_stud_id_foreign');
        $table->dropForeign('marksheet_teacher_id_foreign');
        $table->dropForeign('marksheet_exam_id_foreign');
        $table->dropForeign('marksheet_subject_id_foreign');

        });
    }
}
