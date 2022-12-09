<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('login', 50)->nullable();
            $table->string('password', 100)->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->string('token')->nullable();
            $table->mediumInteger('token_valid_period')->default(180);
            $table->tinyInteger('is_active')->default(0);
            $table->timestamp('token_expires_at')->nullable();
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
        Schema::dropIfExists('api_users');
    }
}
