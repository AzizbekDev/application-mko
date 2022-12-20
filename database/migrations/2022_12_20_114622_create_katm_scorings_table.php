<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatmScoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katm_scorings', function (Blueprint $table) {
            $table->id();
            $table->integer('request_id')->nullable();
            $table->string('status')->nullable();
            $table->string('pinfl');
            $table->string('passport',20);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
            $table->date('passport_given_date')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->integer('type')->nullable();
            $table->longText('html')->nullable();
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
        Schema::dropIfExists('katm_scorings');
    }
}
