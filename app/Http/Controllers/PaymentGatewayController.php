<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserPaymentGateway;

use App\Models\PaymentGateway;

use App\Models\Profile;
use App\Models\Order;
use App\Models\Funnel;
use App\Models\UserSubscription;

use Auth;

class PaymentGatewayController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function index() {
		$data['paymentGateways'] = UserPaymentGateway::where( 'user_id', Auth::user()->id )->orderBy( 'id', 'desc' )->paginate();
		$gateways                = new PaymentGateway();
		$data['profile']         = Profile::where( 'user_id', Auth::user()->id )->first();

		$data['availableGateways'] = $gateways->getPaymentGateway();

		if ( empty( Auth::user()->secret ) ) {

			$data['subscription'] = UserSubscription::where( 'user_id', Auth::user()->id )->first();

		} else {
			$data['subscription'] = array();
		}

		$sales       = Order::where( 'user_id', Auth::user()->id )->get();
		$total_sales = 0.0;

		foreach ( $sales as $sale ) {
			$total_sales += $sale->amount;
		}

		$data['total_sales'] = number_format( $total_sales, 2 );

		$data['total_funnels'] = Funnel::where( 'user_id', Auth::user()->id )->get()->count();

		return view( 'settings.payment-gateway.list' )->withData( $data );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$gateways                  = new PaymentGateway();
		$data['availableGateways'] = $gateways->getAvailablePaymentGateway();

		return view( 'settings.payment-gateway.add' )->withData( $data );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$userPaymentGateway          = new UserPaymentGateway();
		$userPaymentGateway->user_id = Auth::user()->id;
		$userPaymentGateway->type    = $request->input( 'gateway' );
		$userPaymentGateway->details = json_encode( $request->input( 'details' ) );
		$userPaymentGateway->save();

		die (
		json_encode(
			array(
				'status' => 'success',
				'url'    => route( 'payment-gateway.index' )
			)
		)
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		echo "Show";
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$data = array();

		$data['paymentGateways']   = UserPaymentGateway::where( 'user_id', Auth::user()->id )->orderBy( 'id', 'desc' )->paginate();
		$gateways                  = new PaymentGateway();
		$data['availableGateways'] = $gateways->getPaymentGateway();
		$data['gateway']           = UserPaymentGateway::find( $id );

		return view( 'settings.payment-gateway.edit' )->withData( $data );
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
		$userPaymentGateway          = UserPaymentGateway::find( $id );
		$userPaymentGateway->type    = $request->input( 'gateway' );
		$userPaymentGateway->details = json_encode( $request->input( 'details' ) );
		$userPaymentGateway->save();

		die (
		json_encode(
			array(
				'status' => 'success',
				'url'    => route( 'payment-gateway.index' )
			)
		)
		);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Request $request, $id ) {
		//echo "Destroy";

		$userPaymentGateway = UserPaymentGateway::find( $request->input( 'gateway_id' ) );

		if ( $userPaymentGateway->delete() ) {
			die (
			json_encode(
				array(
					'status' => 'success'
				)
			)
			);
		} else {
			die (
			json_encode(
				array(
					'status' => 'error'
				)
			)
			);
		}
	}


	public function removeGateway( Request $request ) {

		$userPaymentGateway = UserPaymentGateway::find( $request->input( 'gateway_id' ) );

		if ( $userPaymentGateway->delete() ) {
			die (
			json_encode(
				array(
					'status' => 'success'
				)
			)
			);
		} else {
			die (
			json_encode(
				array(
					'status' => 'error'
				)
			)
			);
		}
	}
}
