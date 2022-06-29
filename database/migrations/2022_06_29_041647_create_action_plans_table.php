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
            $table->bigInteger('feedback_source_id');
            $table->longText('feedback')->nullable();
            $table->longText('actions_to_taken')->nullable();
            $table->longText('expected_compliance_period')->nullable();
            $table->enum('status', ['Complied', 'On-going', 'Delayed', 'Pending'])->default('Pending');
            $table->longText('status_note')->nullable();
            $table->longText('expected_outcome')->nullable();
            $table->longText('means_of_verification')->nullable();
            $table->longText('person_in_charge')->nullable();
            $table->tinyInteger('active')->default(0);
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
