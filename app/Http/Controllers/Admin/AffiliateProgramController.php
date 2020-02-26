<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\UserAffiliatePayment;
use App\AffiliateProfile;

use DB;

class AffiliateProgramController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$affiliateProfiles = AffiliateProfile::orderBy( 'id', 'DESC' )
		                                     ->paginate( 25 );

		return view( 'admin.affiliate.list', compact( 'affiliateProfiles' ) );
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {

		$affiliateProfile = AffiliateProfile::find( $id );

		if ( ! empty( $affiliateProfile ) ) {
			$affiliateProfile->settings = ( ! empty( $affiliateProfile->settings ) ) ? json_decode( $affiliateProfile->settings ) : '';
			$affiliateProfile->address  = ( ! empty( $affiliateProfile->address ) ) ? json_decode( $affiliateProfile->address ) : '';
			$affiliateProfile->payments = ( ! empty( json_decode( $affiliateProfile->payments ) ) ) ? json_decode( $affiliateProfile->payments ) : '';

			if ( ! empty( $affiliateProfile->tax_forms ) ) {
				$affiliateProfile->tax_forms = json_decode($affiliateProfile->tax_forms, true);
			} else {
				$affiliateProfile->tax_forms = array();
			}
		}

		return view( 'admin.affiliate.view', compact( 'affiliateProfile' ) );
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


	public function approveRequest( Request $request, $id ) {

		$affiliateProfile         = AffiliateProfile::find( $id );
		$affiliateProfile->status = true;

		if ( $affiliateProfile->save() ) {

			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'admin.affiliate.index' )
				)
			)
			);
		}
	}


	public function cancelRequest( Request $request, $id ) {

		$affiliateProfile         = AffiliateProfile::find( $id );
		$affiliateProfile->status = 2; //2 means canceled the request and 0 means pending(no action has taken yet)

		if ( $affiliateProfile->save() ) {

			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'admin.affiliate.index' )
				)
			)
			);
		}
	}


	public function madePayment( Request $request, $id ) {

		$userAffiliatePayment         = UserAffiliatePayment::find( $id );
		$userAffiliatePayment->status = true;

		if ( $userAffiliatePayment->save() ) {

			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'admin.affiliate.pendings' )
				)
			)
			);
		}
	}


	public function pendings() {

		$uerAffiliatePayments = UserAffiliatePayment::where('status', false)
		                                     ->paginate( 25 );

		/*$uerAffiliatePayments = DB::table( 'user_affiliate_payments' )
		                          ->select( 'user_id', DB::raw( 'SUM(`amount`) as total' ) )
		                          ->where( 'status', false )
		                          ->groupBy( 'user_id' )
		                          ->paginate( 25 );*/

		return view( 'admin.affiliate.pending_list', compact( 'uerAffiliatePayments' ) );
	}
}
