<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input as Input;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use App\Models\UserSubscription;
use App\Models\AdminPaymentGateway;
use App\Models\AffiliateProfile;
use App\Models\UserAffiliatePayment;
use Cartalyst\Stripe\Stripe;

use Auth;

class SubscriptionController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function index() {
		$admin   = AdminPaymentGateway::where( 'admin_id', 1 )->first();
		$payment = json_decode( $admin->details );

		//print_r($payment); die;

		return view( 'subscription.list', array( 'payment' => $payment ) );
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
		$user = User::find( Auth::user()->id );

		if ( $request->subscription_plan == 'monthly' ) {
			$subscription = "monthly";
			$amount       = floatVal( env( 'MONTHLY_PLAN' ) );
		} else {
			$subscription = "yearly";
			$amount       = floatVal( env( 'YEARLY_PLAN' ) );
		}

		/*$admin = AdminPaymentGateway::where('admin_id', 1)->first();
		$payment = json_decode($admin->details);

		//print_r($_POST); die;



		$amount *= 100;

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey($payment->secret_key);

		// Token is created using Checkout or Elements!
		// Get the payment token ID submitted by the form:
		$token = $request->stripeToken;

		//Create a Customer
		$customer = \Stripe\Customer::create(array(
			"source" => $token,
			"description" => Auth::user()->email,
			"plan"  => $subscription)
		);

		//echo '<pre>'; print_r($customer->id); die;

		// Charge the user's card:
		$charge = \Stripe\Charge::create(array(
			"amount" => $amount,
			"currency" => "usd",
			"customer" => $customer->id
		));

		Auth::user()->update(['stripe_id' => $customer->id]);
		//Auth::user()->assignRole('subscriber');*/

		//print_r($payment); die;
		/*$user->newSubscription('main', 'monthly')->create($request->stripeToken, [
			'email' => Auth::user()->email,
		]);*/

		//echo '<pre>'; print_r($charge); die;


		$user->newSubscription( 'main', $subscription )->trialDays( env( 'TRIAL_PERIOD' ) )->create( $request->stripeToken, [
			'email' => Auth::user()->email,
		] );

		/*$user = $user->update([
			// Populate other user properties...
			'trial_ends_at' => Carbon::now()->addDays(env('TRIAL_PERIOD')),
		]);*/

		//if payment made by affiliate id, add commission to the affiliate user
		if ( ! empty( $request->input( 'affiliate_id' ) ) ) {

			$aProfile = AffiliateProfile::where( 'affiliate_id', $request->input( 'affiliate_id' ) )->first();
			if ( ! empty( $aProfile ) ) {

				//calculate commission
				$commission = ( floatval( $amount ) * 40 ) / 100;

				$userAffiliatePayment          = new UserAffiliatePayment();
				$userAffiliatePayment->user_id = $aProfile->user_id;
				$userAffiliatePayment->amount  = $commission;
				$userAffiliatePayment->status  = false;
				$userAffiliatePayment->save();
			}
		}

		die(
		json_encode(
			array(
				'status' => 'success',
				'url'    => route( 'site.redirect.dashboard' )
				//'url'       => route('dashboard.index')
			)
		)
		);

		/*if ( $userSubscription->save() ) {

			die(
				json_encode(
					array(
						'status'    => 'success',
						'url'       => route('dashboard.index')
					)
				)
			);
		} else {
			die(
				json_encode(
					array(
						'status'    => 'error',
						'message'   => "Error! please try again later"
					)
				)
			);
		}*/
		//}
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


	public function cancelSubscription( Request $request ) {

		if ( Auth::user()->subscription( 'main' )->cancel() ) {
			die(
			json_encode(
				array(
					'status'  => 'success',
					'message' => 'Subscription has been canceled'
				)
			)
			);
		} else {
			die(
			json_encode(
				array(
					'status'  => 'error',
					'message' => 'Error! please try after sometime'
				)
			)
			);
		}
	}

	public function resumeSubscription( Request $request ) {

		if ( Auth::user()->subscription( 'main' )->resume() ) {
			die(
			json_encode(
				array(
					'status'  => 'success',
					'message' => 'Subscription has been resumed'
				)
			)
			);
		} else {
			die(
			json_encode(
				array(
					'status'  => 'error',
					'message' => 'Error! please try after sometime'
				)
			)
			);
		}
	}


	public function renewSubscription( Request $request ) {

		$user = User::find( Auth::user()->id );

		if ( $user->subscribedToPlan( 'monthly', 'main' ) ) {

			if ( $user->subscription( 'main' )->swap( 'yearly' ) ) {
				die(
				json_encode(
					array(
						'status'  => 'success',
						'message' => 'Plan has been swapped successfully'
					)
				)
				);
			} else {
				die(
				json_encode(
					array(
						'status'  => 'error',
						'message' => 'Error! please try after sometime'
					)
				)
				);
			}

		} else {

			if ( $user->subscription( 'main' )->swap( 'monthly' ) ) {

				die(
				json_encode(
					array(
						'status'  => 'success',
						'message' => 'Plan has been swapped successfully'
					)
				)
				);

			} else {

				die(
				json_encode(
					array(
						'status'  => 'error',
						'message' => 'Error! please try after sometime'
					)
				)
				);
			}
		}
	}


	//redirect to dashboard
	public function redirectDashboard( Request $request ) {

		return view( 'subscription.thankyou' );
	}
}
