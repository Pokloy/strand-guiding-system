<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblstudent_exam', function (Blueprint $table) {
            $table->bigIncrements('student_exam_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('student_exam_details_id')->unsigned();
            $table->bigInteger('is_answered')->default('0');
            $table->timestamps();
            $table->foreign('student_id')->references('student_id')->on('tblstudent')->onDelete('cascade');
            $table->foreign('question_id')->references('question_id')->on('tblquestion')->onDelete('cascade');
            $table->foreign('student_exam_details_id')->references('student_exam_details_id')->on('tblstudent_exam_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student__exam_models');
    }
}
