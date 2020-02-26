<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Order;
use App\Models\Funnel;
use App\Models\AffiliateProfile;
use App\Models\UserAffiliatePayment;

use Auth;

class AffiliateProgramController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */


	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function index() {

		$affiliateProfile = AffiliateProfile::where( 'user_id', Auth::user()->id )->first();
		if ( ! empty( $affiliateProfile ) ) {
			$affiliateProfile->settings = json_decode( $affiliateProfile->settings );
			$affiliateProfile->address  = json_decode( $affiliateProfile->address );
			$affiliateProfile->payments = json_decode( $affiliateProfile->payments );

			$affiliateProfile->sales               = $affiliateProfile->getPaidPendingAmount( Auth::user()->id );
			$affiliateProfile->today_total_earning = $affiliateProfile->getTotalEarnings( Auth::user()->id );
			$affiliateProfile->week_total_earning  = $affiliateProfile->getTotalEarnings( Auth::user()->id, 7 );
			$affiliateProfile->month_total_earning = $affiliateProfile->getTotalEarnings( Auth::user()->id, 30 );
			$affiliateProfile->week_earnings       = $affiliateProfile->getLastWeekEarnings( Auth::user()->id );
		}

		//echo '<pre>'; print_r($affiliateProfile); die;

		// return view( 'affiliate.dashboard', compact( 'profile', 'data', 'affiliateProfile' ) );

        return view( 'affiliate.dashboard', compact( 'affiliateProfile' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {

		$affiliateProfileSearch = AffiliateProfile::where( 'user_id', Auth::user()->id )->first();
		if ( empty( $affiliateProfileSearch ) ) {
			$affiliateProfile = new AffiliateProfile();
		} else {
			$affiliateProfile = AffiliateProfile::find( $affiliateProfileSearch->id );
		}

		$affiliateProfile->user_id = Auth::user()->id;

		if ( empty( $affiliateProfile->affiliate_id ) ) {
			$affiliateProfile->affiliate_id = time();
		}

		$affiliateProfile->settings = json_encode( $request->input( 'settings' ) );
		$affiliateProfile->address  = json_encode( $request->input( 'address' ) );
		$affiliateProfile->payments = json_encode( $request->input( 'payments' ) );
		$affiliateProfile->save();
		//$affiliateProfile->user_settings = $request->input( 'payment_gateway' );
		//$affiliateProfile->created_at = date( 'Y-m-d h:i:s' );
		//$affiliateProfile->updated_at = date( 'Y-m-d h:i:s' );

		/*if ( $affiliateProfile->save() ) {
			die( json_encode(
				array(
					'status' => "success",
					'url'    => route( 'affiliate.index' )
				)
			) );
		} else {
			die( json_encode(
				array(
					'status'  => 500,
					'message' => 'Something wrong! please try again later'
				)
			) );
		}*/

		return redirect()->route( "affiliate.index" );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}


	public function submitTaxForm( Request $request ) {

		//print_r($_FILES);
		$extension = $request->file( 'file' );
		$extension = $request->file( 'file' )->getClientOriginalExtension(); // getting excel extension
		$dir       = public_path( 'frontend/upload/tax_forms/' );
		$filename  = uniqid() . '_' . time() . '_' . date( 'Ymd' ) . '.' . $extension;
		$request->file( 'file' )->move( $dir, $filename );

		//keep record of who submitted the tax form
		$affiliateProfile = AffiliateProfile::where( 'user_id', Auth::user()->id )->first();
		if ( ! empty( $affiliateProfile->tax_forms ) ) {
			$tax_forms = json_decode( $affiliateProfile->tax_forms, true );
		} else {
			$tax_forms = array();
		}

		//add file name to the collection
		array_push( $tax_forms, array( $request->input( 'form_type' ) => $filename ) );

		$affiliateProfile->tax_forms = json_encode( $tax_forms );

		if ( $affiliateProfile->save() ) {
			die( json_encode(
				array(
					'status'  => "success",
					'message' => "File has been submitted"
				)
			) );
		}
	}
}
