<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tax_info_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_tin',9)->nullable();
            $table->mediumInteger('year')->nullable();
            $table->mediumInteger('period')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('salary_tax_sum')->nullable();
            $table->integer('inps_sum')->nullable();
            $table->integer('prop_income')->nullable();
            $table->integer('other_income')->nullable();
            $table->timestamps();
            $table->index(['tax_info_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_details');
    }
}
