<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('application_id')->nullable();
            $table->string('client_code',9)->nullable();
            $table->string('password',20)->nullable();
            $table->string('lang',2)->default('uz')->comment('');
            $table->date('date_pub')->nullable();
            $table->boolean('print')->default(0);
            $table->integer('status_id')->default(0)->comment(
                "0-New Client," .
                "1-Wallet Opened," .
                "2-Limit Opened," .
                "3-Success Client," .
                "4-Rejected Client," .
                "5-Closed Client");
            $table->string('status_message')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
