<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('feedback_source_id');
            $table->text('feedback');
            $table->text('actions_to_be_taken');
            $table->date('expected_compliance_period');
            $table->enum('status', ['Complied', 'On-going', 'Delayed', 'Pending'])->default('Pending');
            $table->string('expected_outcome');
            $table->string('means_of_verification');
            $table->bigInteger('action_to_id');
            $table->enum('action_to', ['College', 'Program']);
            $table->bigInteger('person_in_charge_id');
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
        Schema::dropIfExists('action_plans');
    }
}
