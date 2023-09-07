<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamDetailsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblstudent_exam_details', function (Blueprint $table) {
            $table->bigIncrements('student_exam_details_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('stem_score')->default('0');
            $table->bigInteger('humss_score')->default('0');
            $table->bigInteger('gas_score')->default('0');
            $table->bigInteger('abm_score')->default('0');
            $table->timestamps();
            $table->foreign('student_id')->references('student_id')->on('tblstudent')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student__exam__details_models');
    }
}
