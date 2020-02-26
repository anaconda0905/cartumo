<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messengers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message_from');
            $table->integer('message_to'); 
            $table->text('message_text');           
            $table->tinyInteger('is_ip');
            $table->tinyInteger('unread_show');            
            $table->tinyInteger('type'); 
            $table->tinyInteger('status'); 
            $table->string('conversation');
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
        Schema::dropIfExists('chat_messengers');
    }
}
