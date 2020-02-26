<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCustomersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'order_customers', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'order_id' );
			$table->string( 'customer_name' );
			$table->string( 'email' )->default('NULL');
			$table->text( 'details' );
			$table->tinyInteger( 'status' )->default( true );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'order_customers' );
	}
}
