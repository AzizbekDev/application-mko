<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsokiClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asoki_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('claim_id')->nullable()->comment('Customers table id');
            $table->date('claim_date')->nullable();
            $table->string('claim_number',10)->nullable();
            $table->string('agreement_number',10)->nullable();
            $table->date('agreement_date')->nullable();
            $table->tinyInteger('resident')->nullable();
            $table->tinyInteger('document_type')->nullable();
            $table->tinyInteger('client_type')->nullable();
            $table->string('nibbd',8)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('katm_sir',20)->nullable();
            $table->string('live_cadastr',21)->nullable();
            $table->string('registration_cadastr',21)->nullable();
            $table->index(['claim_number','nibbd']);
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
        Schema::dropIfExists('asoki_clients');
    }
}
