<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyIdInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_id_infos', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('pass_data',9)->nullable();
            $table->string('pinfl',14)->nullable();
            $table->boolean('is_mobile')->default(false);
            $table->string('response_id')->nullable();
            $table->string('comparison_value')->nullable()->comment('Comparison result (0.5-1.0 success)');
            $table->integer('result_code')->nullable()->comment('
                1-All checks passed successfully,
                2-Passport data entered incorrectly,
                3-Failed to confirm vitality,
                4-Failed to recognize,
                5-The GSP service is unavailable or does not work correctly,
                6-Person died,
                7-Photo from GSP not received.
            ');
            $table->string('result_note')->nullable();
            $table->text('profile')->nullable();
            $table->timestamps();
            $table->index(['pass_data','pinfl']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_id_infos');
    }
}
