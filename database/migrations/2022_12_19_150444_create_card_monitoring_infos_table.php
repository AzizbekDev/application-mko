<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardMonitoringInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_monitoring_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('salary_card_id')->nullable();
            $table->string('salary_average', 15)->nullable()->comment('tyin');
            $table->string('min_limit', 15)->nullable()->comment('tyin');
            $table->string('max_limit', 15)->nullable()->comment('tyin');
            $table->text('response_info')->nullable();
            $table->tinyInteger('status_id')->default(1)->comment('1-New, 2-Scoring Success, 3-Scoring Failed, 4-Service Error');
            $table->string('status_message')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['salary_card_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_monitoring_infos');
    }
}
