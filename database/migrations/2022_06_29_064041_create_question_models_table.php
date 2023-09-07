<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblquestion', function (Blueprint $table) {
            $table->bigIncrements('question_id')->unsigned();
            $table->text('question');
            $table->string('answer');
            $table->bigInteger('strand_id')->unsigned();
            $table->timestamps();
            $table->foreign('strand_id')->references('strand_id')->on('tblstrand')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblquestion');
    }
}
