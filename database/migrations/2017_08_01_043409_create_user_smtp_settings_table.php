<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSmtpSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_smtp_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('form_name');
            $table->string('form_email');
            $table->string('smtp_server');
            $table->string('smtp_port');
            $table->string('smtp_user');
            $table->string('smtp_password');
            $table->string('smtp_domain');
            $table->text('smtp_footer');
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
        Schema::dropIfExists('user_smtp_settings');
    }
}
