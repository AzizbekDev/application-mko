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
            $table->string('token')->nullable();
            $table->longText('info')->nullable();
            $table->tinyInteger('status_id')->default(1)->comment('1-New Info, 2-Success, 3-Error(claim not found), 4-Limit exceeded, 5-Awaits confirmation');
            $table->string('status_message')->default('New Info');
            $table->text('response_info')->nullable();
            $table->index(['asoki_client_id','claim_id','token']);
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
        Schema::dropIfExists('asoki_infos');
    }
}
