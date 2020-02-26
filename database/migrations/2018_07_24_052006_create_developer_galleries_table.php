<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperGalleriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'developer_galleries', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'developer_id' );
			$table->text( 'path' );
			$table->string( 'image_type' )->default( 'gallery' );
			$table->tinyInteger( 'status' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'developer_galleries' );
	}
}
