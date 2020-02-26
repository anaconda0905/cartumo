<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserSmtpSetting;

use Auth;

class SmtpSettingsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function index() {
		$data['userSmtpSettings'] = UserSmtpSetting::where( 'user_id', Auth::user()->id )->orderBy( 'id', 'desc' )->paginate();

		return view( 'settings.smtp.list' )->withData( $data );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( 'settings.smtp.add' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$userSmtpSetting                = new UserSmtpSetting();
		$userSmtpSetting->user_id       = Auth::user()->id;
		$userSmtpSetting->form_name     = $request->input( 'from_name' );
		$userSmtpSetting->form_email    = $request->input( 'from_mail' );
		$userSmtpSetting->smtp_server   = $request->input( 'smtp_server' );
		$userSmtpSetting->smtp_port     = $request->input( 'smtp_port' );
		$userSmtpSetting->smtp_user     = $request->input( 'smtp_user' );
		$userSmtpSetting->smtp_password = $request->input( 'smtp_password' );
		$userSmtpSetting->smtp_domain   = $request->input( 'smtp_domain' );
		$userSmtpSetting->smtp_footer   = $request->input( 'smtp_footer' );
		$userSmtpSetting->status        = $request->input( 'smtp_status' );

		if ( $userSmtpSetting->save() ) {

			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'smtp.index' )
				)
			)
			);
		} else {

			die(
			json_encode(
				array(
					'status'  => 'error',
					'mesaage' => "Something is wrong! please try after sometime"
				)
			)
			);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {

		//$smtpSetting = UserSmtpSetting::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {

		$smtpSetting = UserSmtpSetting::find( $id );

		return View( 'settings.smtp.edit', compact( 'smtpSetting' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {

		$userSmtpSetting                = UserSmtpSetting::find( $id );
		$userSmtpSetting->user_id       = Auth::user()->id;
		$userSmtpSetting->form_name     = $request->input( 'form_name' );
		$userSmtpSetting->form_email    = $request->input( 'form_email' );
		$userSmtpSetting->smtp_server   = $request->input( 'smtp_server' );
		$userSmtpSetting->smtp_port     = $request->input( 'smtp_port' );
		$userSmtpSetting->smtp_user     = $request->input( 'smtp_user' );
		$userSmtpSetting->smtp_password = $request->input( 'smtp_password' );
		$userSmtpSetting->smtp_domain   = $request->input( 'smtp_domain' );
		$userSmtpSetting->smtp_footer   = $request->input( 'smtp_footer' );
		$userSmtpSetting->status        = $request->input( 'status' );

		if ( $userSmtpSetting->save() ) {

			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'smtp.index' )
				)
			)
			);
		} else {

			die(
			json_encode(
				array(
					'status'  => 'error',
					'mesaage' => "Something is wrong! please try after sometime"
				)
			)
			);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {

		$smtpSetting = UserSmtpSetting::find( $id );
		if ( $smtpSetting->delete() ) {
			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'smtp.index' )
				)
			)
			);
		} else {
			die(
			json_encode(
				array(
					'status'  => 'error',
					'mesaage' => "Something is wrong! please try after sometime"
				)
			)
			);
		}
	}
}
