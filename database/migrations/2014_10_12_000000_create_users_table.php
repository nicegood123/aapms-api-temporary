<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('phone_number')->unique();
            $table->string('email_address')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('position');
            $table->string('password');
            $table->enum('role', ['Super Admin', 'Admin', 'Regular']);
            $table->enum('status', ['Active', 'Inactive']);
            $table->bigInteger('access_id')->default('0');
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
}
