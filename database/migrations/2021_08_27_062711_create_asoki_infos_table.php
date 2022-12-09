<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsokiInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asoki_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('asoki_client_id')->nullable();
            $table->unsignedInteger('claim_id')->nullable();
            $table->string('claim_number',10)->nullable();
            $table->string('token')->nullable();
            $table->longText('info')->nullable();
            $table->tinyInteger('status_id')->default(1)->comment('1-new, 2-success(add_credit_info), 3-error(claim not found), 4-limit exceeded, 5-awaits confirmation');
            $table->string('status_message')->nullable();
            $table->tinyInteger('scoring_status')->default(1)->comment('1-ko`rilmoqda, 2-o`tdi, 3-o`tmadi');
            $table->text('scoring_result')->nullable();
            $table->index(['claim_number','token']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asoki_infos');
    }
}
