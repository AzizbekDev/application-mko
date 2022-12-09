<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockedApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('application_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('fio')->nullable();
            $table->string('serial_number',9)->nullable();
            $table->string('pin',9)->nullable();
            $table->string('phone',15)->nullable();
            $table->datetime('blocked_date')->nullable();
            $table->datetime('unblock_date')->nullable();
            $table->tinyInteger('status_id')->default(1)->comment('1-blocked, 0-unblocked');
            $table->string('status_message')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('blocked_applications');
    }
}
