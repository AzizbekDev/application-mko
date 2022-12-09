<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number',9)->nullable();
            $table->string('pin',14)->nullable();
            $table->string('inn',9)->nullable();
            $table->date('birth_date')->nullable();
            $table->date('document_date')->nullable();
            $table->string('document_region',2)->nullable();
            $table->string('document_district',3)->nullable();
            $table->string('family_name')->nullable();
            $table->string('name')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('registration_region',2)->nullable();
            $table->string('registration_district',3)->nullable();
            $table->string('registration_address')->nullable();
            $table->string('live_address')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('1-Male, 2-Female');
            $table->tinyInteger('status_id')->default(1)->comment('1-New, 2-Success');
            $table->string('status_message')->nullable();
            $table->tinyInteger('source')->default(1)->comment('1-MyID, 2-DigID, 3-GSP, 4-TaxInfo');
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
        Schema::dropIfExists('personal_infos');
    }
}