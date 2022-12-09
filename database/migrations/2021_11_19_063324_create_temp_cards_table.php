<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('temp_type')->default(1)->comment('1-ForSalaryCard');
            $table->string('owner',50)->nullable();
            $table->string('card_number',16)->nullable();
            $table->string('expire',4)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('balance',10)->nullable();
            $table->boolean('sms')->nullable();
            $table->boolean('is_corporate')->nullable();
            $table->string('otp',10)->nullable();
            $table->tinyInteger('status_id')->default(0)->comment('0-New, 1-OTP was sent, 2-Confirmation success, 3-OTP Expired, 4-Dismissed');
            $table->string('status_message')->default('New');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['card_number','phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_cards');
    }
}
