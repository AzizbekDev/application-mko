<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsokiClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asoki_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('claim_id')->nullable()->comment('Application Table ID Start with +000');
            $table->string('family_name',100)->nullable();
            $table->string('name',100)->nullable();
            $table->string('patronymic',100)->nullable();
            $table->string('birth_date',15)->nullable();
            $table->string('pin',14)->nullable();
            $table->string('inn',9)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('claim_number',15)->nullable();
            $table->string('claim_date',15)->nullable();
            $table->string('agreement_number',15)->nullable();
            $table->string('agreement_date',15)->nullable();
            $table->string('katm_sir',50)->nullable();
            $table->string('resident',4)->nullable();
            $table->string('client_type',4)->nullable();
            $table->string('gender',2)->nullable();
            $table->string('document_type',4)->nullable();
            $table->string('document_serial',2)->nullable();
            $table->string('document_number',7)->nullable();
            $table->string('document_date',15)->nullable();
            $table->string('document_region',2)->nullable();
            $table->string('document_district',3)->nullable();
            $table->string('registration_region',2)->nullable();
            $table->string('registration_district',3)->nullable();
            $table->string('registration_address')->nullable();
            $table->string('live_address')->nullable();
            $table->string('registration_cadastr',50)->nullable();
            $table->string('live_cadastr',50)->nullable();
            $table->string('nibbd',8)->nullable();
            $table->tinyInteger('status_id')->default(1)->comment('1-New Client, 2-Success Info, 3-Error, 4-Rejected Client');
            $table->string('status_message', 100)->default('New Client');
            $table->boolean('is_rejected')->default(0);
            $table->text('response_info')->nullable();
            $table->index(['claim_id','pin', 'katm_sir']);
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
        Schema::dropIfExists('asoki_clients');
    }
}
