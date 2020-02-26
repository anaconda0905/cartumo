<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUpgradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_upgrades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('upgrade_id');
            $table->integer('payment_id');
            $table->string('type');            
            $table->tinyInteger('payment_status');            
            $table->tinyInteger('status');            
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
        Schema::dropIfExists('user_upgrades');
    }
}
