<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunnelStepAutomationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funnel_step_automations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('funnel_id');
            $table->integer('step_id');
            $table->string('type');
            $table->string('from_name');
            $table->string('subject');
            $table->string('automation_condition');
            $table->text('details');
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
        Schema::dropIfExists('funnel_step_automations');
    }
}
