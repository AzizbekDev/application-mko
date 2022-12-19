<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id')->nullable();
            $table->string('owner', 100)->nullable();
            $table->string('card_number',16)->nullable();
            $table->string('card_expire',4)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('token')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0-inactive, 1-active');
            $table->integer('balance')->nullable();
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
        Schema::dropIfExists('client_wallets');
    }
}
