<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('application_id')->nullable();
            $table->string('card_number', 16)->nullable();
            $table->string('expire', 4)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('mask', 16)->nullable();
            $table->string('owner', 50)->nullable();
            $table->string('bank', 50)->nullable();
            $table->boolean('sms')->default(false);
            $table->boolean('is_corporate')->default(false);
            $table->tinyInteger('card_type')->default(1)->comment('1-UZCARD, 2-HUMO, 3-COBAGE');
            $table->tinyInteger('card_order')->default(1);
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('salary_cards');
    }
}
