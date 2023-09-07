<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblverification', function (Blueprint $table) {
            $table->bigIncrements('verification_id')->unsigned();
            $table->string('verification_code');
            $table->bigInteger('is_verified')->default('0');
            $table->bigInteger('is_sent')->default('0');
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
        Schema::dropIfExists('verification_models');
    }
}
