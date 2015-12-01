<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFKToDivsubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('div_subject', function (Blueprint $table) {
            $table->foreign('div_id')->references('id')->on('division')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('div_subject', function (Blueprint $table) {
            $table->dropForeign('div_subject_div_id_foreign');
        });
    }
}
