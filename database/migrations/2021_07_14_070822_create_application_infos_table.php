<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('application_id')->nullable();
            $table->string('fio')->nullable();
            $table->string('phone',15)->nullable();
            $table->string('phone2',15)->nullable();
            $table->string('telegram',15)->nullable();
            $table->string('email',50)->nullable();
            $table->string('work_place')->nullable();
            $table->string('work_title')->nullable();
            $table->string('work_address')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('profession')->nullable();
            $table->string('serial_number',9)->nullable();
            $table->string('inn',9)->nullable();
            $table->string('pin',14)->nullable();
            $table->integer('gender')->nullable();
            $table->string('birth_date',10)->nullable();
            $table->string('source')->nullable();
            $table->longText('person_photo')->nullable();
            $table->string('passport_image')->nullable();
            $table->string('passport_image1')->nullable();
            $table->string('passport_image2')->nullable();
            $table->string('file',100)->nullable();
            $table->string('file2',100)->nullable();
            $table->timestamps();
            $table->index(['serial_number','pin','phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_infos');
    }
}
