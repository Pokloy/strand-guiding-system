<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblusers', function (Blueprint $table) {
            $table->bigIncrements('user_id')->unsigned();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('uname');
            $table->string('pass');
            $table->string('utype');
            $table->string('status')->default('Inactive');
            $table->text('sec_ques')->nullable();
            $table->text('sec_ans')->nullable();
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
        Schema::dropIfExists('user_models');
    }
}
