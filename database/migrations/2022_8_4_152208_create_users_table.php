<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('local_id')->nullable()->constrained('local_teams')->nullOnDelete();
            $table->foreignId('global_id')->nullable()->constrained('global_teams')->nullOnDelete();
            $table->foreignId('national_id')->nullable()->constrained('national_teams')->nullOnDelete();
            $table->text('desc')->nullable();
            $table->boolean('status')->default(1);
            $table->string('device_token')->nullable();
            $table->
            //---Socialite ----
          
            $table->string('provider_id')->nullable();
            $table->string('provider_type')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
