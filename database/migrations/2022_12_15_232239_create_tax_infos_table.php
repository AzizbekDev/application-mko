<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('tin',9)->nullable();
            $table->string('pinfl',14)->nullable();
            $table->string('serial_number',9)->nullable();
            $table->mediumInteger('ns10_code')->nullable();
            $table->mediumInteger('ns11_code')->nullable();
            $table->mediumInteger('last_year')->nullable();
            $table->mediumInteger('last_period')->nullable();
            $table->integer('average_salary')->nullable();
            $table->tinyInteger('status_id')->default(0)->comment('0-New Info, 1-Success, 2-Null Salary, 3-Error Service');
            $table->string('status_message', 100)->default('New Info');
            $table->timestamps();
            $table->index(['tin','pinfl','serial_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_infos');
    }
}
