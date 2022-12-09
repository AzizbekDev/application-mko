php <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('phone',15)->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('lang',2)->default('uz')->comment('ru, uz');
            $table->boolean('is_active')->default(1)->comment('1-is active, 0-is blocked');
            $table->boolean('is_admin')->default(0)->comment('1-supper admin, 0-simple staff');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
