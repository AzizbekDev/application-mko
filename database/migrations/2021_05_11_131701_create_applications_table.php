<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('key_app')->nullable();
            $table->string('serial_number',9)->nullable();
            $table->string('pin',14)->nullable();
            $table->string('card_mask',16)->nullable();
            $table->string('phone',15)->nullable();
            $table->integer('step')->default(0)->comment(
                "0-New Application," .
                "1-MyID Identification," .
                "2-Card/Salary/Credit Scoring," .
                "3-Limit Confirmation," .
                "4-Success Application,");
            $table->unsignedInteger('partner_id')->nullable();
            $table->unsignedInteger('status_id')->default(0)
                ->comment(
                    "0-New Application," .
                    "1-Identification Error," .
                    "2-Identified Success," .
                    "3-Card Scoring Error," .
                    "4-Card Scoring Success," .
                    "5-Salary Scoring Error," .
                    "6-Salary Scoring Success," .
                    "7-Credit Scoring Error," .
                    "8-Credit Scoring Success," .
                    "9-Confirmation Limit," .
                    "10-Rejected Limit," .
                    "11-Client Opened," .
                    "12-Client Rejected");
            $table->string('status_message')->default("New Application");
            $table->boolean('is_test')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['key_app','serial_number','pin','phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
