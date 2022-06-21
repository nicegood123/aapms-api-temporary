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
            $table->bigInteger('mobile_number');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('position')->nullable();
            // $table->enum('role', ['Super Admin', 'Admin', 'Regular']);
            $table->enum('status', ['Pending', 'Declined', 'Approved'])->default('Pending');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('access_id')->default('0');
            $table->enum('access_to', ['College', 'Program']);

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
