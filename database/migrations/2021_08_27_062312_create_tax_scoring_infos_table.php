<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxScoringInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_scoring_infos', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number', 9)->nullable();
            $table->string('pin', 14)->nullable();
            $table->string('inn', 9)->nullable();
            $table->string('salary_average', 15)->nullable()->comment('tyin');
            $table->string('min_limit', 15)->nullable()->comment('tyin');
            $table->string('max_limit', 15)->nullable()->comment('tyin');
            $table->text('response_info')->nullable();
            $table->tinyInteger('status_id')->default(1)->comment('1-New, 2-Scoring Success, 3-Scoring Failed, 4-Service Error');
            $table->string('status_message')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['serial_number','pin','inn']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_scoring_infos');
    }
}
