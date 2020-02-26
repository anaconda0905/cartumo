<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateProfilesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'affiliate_profiles', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'user_id' );
			$table->string( 'affiliate_id' )->nullable()->default( null );
			$table->text( 'settings' )->nullable()->default( null );
			$table->text( 'address' )->nullable()->default( null );
			$table->text( 'payments' )->nullable()->default( null );
			$table->text( 'user_settings' )->nullable()->default( null );
			$table->text( 'tax_forms' )->nullable()->default( null );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'affiliate_profiles' );
	}
}
