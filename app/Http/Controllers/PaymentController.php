<?php

namespace App\Http\Controllers;

use App\Models\OrderProducts;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Cartalyst\Stripe\Stripe;

/** All PayPal Details class **/

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Models\Funnel;
use App\Models\Page;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\StepProduct;
use App\Models\FunnelStep;
use App\Models\UserIntegration;
use App\Models\OrderCustomer;

use View;
use Exception;
use Session;

//use Auth;


class PaymentController extends Controller {
	private $shop;
	private $api_key;
	private $api_password;
	private $secret;
	private $store;

	private $customer;
	private $card;
	private $charge;

	private $data;

	private $paypal_data;
	public $_api_context;


	public function __construct() {
		$this->middleware( 'web' );

		/*$userIntegration = UserIntegration::where('user_id', Auth::user()->id)->where('service_type', 'shopify')->first();
		$this->shop = json_decode($userIntegration->details);

		$this->api_key = $this->shop->api_key;
		$this->api_password = $this->shop->password;
		$this->secret = $this->shop->shared_secret;
		$this->store = $this->shop->name;*/


	}


	///////////////////////////// SHOPIFY PAYMENT /////////////////////////////////
	public function makeShopifyPayment( Request $request, $gateway, $orderPayment = null ) {
		$this->initializeAuth( $request );

		//$orderPayment = NULL;

		if ( Session::has( 'product_current_cart' ) ) {
			$userCart = Session::pull( 'product_current_cart' );
		} else {
			$userCart = array();
		}

		


		//check for past customer details
		if ( Session::has( 'shopify_order_details' ) ) {
			$orderDetails = Session::get( 'shopify_order_details' );
		} else {
			$orderDetails = array();
		}


		/*if ( Session::has('save_payment') ) {
			$orderPayment = Session::get('save_payment');
		}*/

		//echo '<pre>='; print_r($orderPayment);

		//check payment method and made secure payment
		if ( $orderPayment != null ) {
			//echo '<pre>'; print_r($orderPayment);die;
			if ( $orderPayment['payment_selection'] == 'credit_card' ) {

				if ( $gateway->type == 'stripe' ) {
					$payDetails = $this->makeStripePayment( $request, $gateway, $userCart, $orderPayment['payment_selection'], $orderPayment );
					//$nextPayment = $payDetails[0];
					$payDetails = $infoDetails['order']['stripe'] = $payDetails[1];
				} else {
					$payDetails                     = $this->makePaypalRedirectPayment( $request, $gateway, $userCart, $orderPayment['payment_selection'], $orderPayment );
					$infoDetails['order']['paypal'] = $payDetails[1];
				}

			} else {

				//paypal
				if ( $orderPayment['payment_selection'] == 'paypal_credit_card' ) {
					$this->makePaypalRedirectPayment( $request, $gateway );
				} else {
					$this->makePaypalRedirectPayment( $request, $gateway );
				}

			}
		} else {
			if ( $request->input( 'payment_selection' ) == 'credit_card' ) {

				//$infoDetails['order']['stripe'] = $orderPayment = $this->makeStripePayment($request, $gateway, $userCart, 'card');

				//echo $gateway->type; die;

				try {
					if ( $gateway->type == 'stripe' ) {
						$payDetails                     = $this->makeStripePayment( $request, $gateway, $userCart, $request->input( 'payment_selection' ) );
						$orderPayment                   = $payDetails[0]; //return to save in session for later use
						$infoDetails['order']['stripe'] = $payDetails[1];
					} else {
						$payDetails                     = $this->makePaypalRedirectPayment( $request, $gateway, $userCart, $request->input( 'payment_selection' ) );
						$orderPayment                   = $payDetails[0]; //return to save in session for later use
						$infoDetails['order']['paypal'] = $payDetails[1];
					}
				} catch ( Exception $ex ) {
					return array(
						'error' => $ex->getMessage()
					);
					die;
				}

			} else {

				//paypal
				//$this->makePaypalPayment($request, $gateway);

				//paypal
				try {
					if ( $request->input( 'payment_selection' ) == 'paypal_credit_card' ) {
						$this->makePaypalRedirectPayment( $request, $gateway );
					} else {
						return $this->makePaypalRedirectPayment( $request, $gateway );
					}
				} catch ( Exception $ex ) {
					return array(
						'error' => $ex->getMessage()
					);
					die;
				}
			}
		}

		//print_r($orderPayment); die;


		//after make successful payment, make order to shopify to keep the record in shopify dashboard
		$url = "https://" . $this->api_key . ":" . $this->api_password . "@" . $this->store . ".myshopify.com/admin/orders.json";

		//bump
		$line_items[] = array(
			"variant_id" => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['variant']['details']->id,
			"quantity"   => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['quantity']
		);

		if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump'] ) ) {
			$line_items[] = array(
				"variant_id" => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['variant']['details']->id,
				"quantity"   => 1
			);
		}


		//shipping
		$tax_lines = array();
		if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) {
			$tax_lines = array(
				array(
					'price' => floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping']['amount'] ),
					'rate'  => 0.00,
					'title' => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping']['title']
				)
			);
		}

		//total tax
		$total_tax_amount = 0.00;

		if ( ! empty( $tax_lines ) ) {
			foreach ( $tax_lines as $tax ) {
				$total_tax_amount += $tax['price'];
			}
		}


		//calculate the amount
		if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['product_id'] ) ) {
			if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) {
				$trans_amount = ( floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['total'][1] ) - floatval( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping']['amount'] ) ) + floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['total'][1] );
			} else {
				$trans_amount = floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['total'][1] ) + floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['total'][1] );
			}
		} else {
			if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) {
				$trans_amount = floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['total'][1] ) - floatval( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping']['amount'] );
			} else {
				$trans_amount = floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['total'][1] );
			}
		}


		if ( empty( $orderDetails ) ) {
			$shipping_address = array(
				"first_name" => $request->input( 'first_name' ),
				"last_name"  => $request->input( 'last_name' ),
				"address1"   => $request->input( 'full_address' ),
				"phone"      => $request->input( 'phone' ),
				"city"       => $request->input( 'city' ),
				"province"   => $request->input( 'state' ),
				"country"    => $request->input( 'country' ),
				"zip"        => $request->input( 'zip' ),
			);

			if ( $request->input( 'selection' ) == 'same' ) {
				$billing_address = $shipping_address;
			} else {
				$billing_address = array(
					"first_name" => $request->input( 'billing_first_name' ),
					"last_name"  => $request->input( 'billing_last_name' ),
					"address1"   => $request->input( 'billing_full_address' ),
					"phone"      => $request->input( 'billing_phone' ),
					"city"       => $request->input( 'billing_city' ),
					"province"   => $request->input( 'billing_state' ),
					"country"    => $request->input( 'billing_country' ),
					"zip"        => $request->input( 'billing_zip' ),
				);
			}

			//make order data
			$post_data['order'] = array(
				"line_items"         => $line_items,
				"tax_lines"          => $tax_lines,
				"total_tax"          => $total_tax_amount,
				"customer"           => array(
					"first_name" => "",
					"last_name"  => "",
					"email"      => $request->input( 'email' ),
				),
				"billing_address"    => $billing_address,
				"shipping_address"   => array(
					"first_name" => $request->input( 'first_name' ),
					"last_name"  => $request->input( 'last_name' ),
					"address1"   => $request->input( 'full_address' ),
					"phone"      => $request->input( 'phone' ),
					"city"       => $request->input( 'city' ),
					"province"   => $request->input( 'state' ),
					"country"    => $request->input( 'country' ),
					"zip"        => $request->input( 'zip' ),
				),
				"transactions"       => array(
					array(
						"kind"   => "authorization",
						"status" => "success",
						"amount" => $trans_amount
					)
				),
				"fulfillment_status" => "fulfilled",
			);
		} else {
			$post_data['order'] = array(
				"line_items"         => $line_items,
				"tax_lines"          => $tax_lines,
				"total_tax"          => $total_tax_amount,
				"customer"           => array(
					"id" => $orderDetails['customer']['id']
				),
				"billing_address"    => $orderDetails['billing'],
				"shipping_address"   => $orderDetails['shipping'],
				"transactions"       => array(
					array(
						"kind"   => "authorization",
						"status" => "success",
						"amount" => $trans_amount
					)
				),
				"fulfillment_status" => "fulfilled",
			);
		}

		//make order in shopify
		$shopifyOrder = json_decode( $this->makePostRequest( $url, $post_data ) );
		//print_r($shopifyOrder); die;


		//create transaction
		$url = "https://" . $this->api_key . ":" . $this->api_password . "@" . $this->store . ".myshopify.com/admin/orders/" . $shopifyOrder->order->id . "/transactions.json";

		$post_data['transaction'] = array(
			"amount" => $trans_amount,
			"kind"   => "capture"
		);


		$transaction = json_decode( $this->makePostRequest( $url, $post_data ) );
		//echo '<pre>'; print_r($transaction); die;

		//save the order
		$funnel = Funnel::find( $request->input( 'funnel_id' ) );


		/////
		foreach ( $shopifyOrder->order->line_items as $item ) {
			$lineItem = $item;
		}


		if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['product_id'] ) ) {

			$bump = array(
				'id'     => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['product_id'],
				'title'  => $item->title,
				'amount' => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['total'][1]
			);
		} else {
			$bump = array();
		}


		if ( empty( $orderDetails ) ) {
			$shopifyOrderDetails = array(
				'transaction_id'  => $transaction->transaction->id,
				'order_id'        => $transaction->transaction->order_id,
				'customer'        => array(
					'id'         => $shopifyOrder->order->customer->id,
					'email'      => $shopifyOrder->order->customer->email,
					'first_name' => $shopifyOrder->order->customer->first_name,
					'last_name'  => $shopifyOrder->order->customer->last_name
				),
				'line_items'      => $shopifyOrder->order->line_items,
				"total_price"     => $shopifyOrder->order->total_price,
				"subtotal_price"  => $shopifyOrder->order->subtotal_price,
				"total_tax"       => $shopifyOrder->order->total_tax,
				'bump'            => $bump,
				'amount'          => $transaction->transaction->amount,
				'currency'        => $transaction->transaction->currency,
				'source'          => $transaction->transaction->source_name,
				'billing'         => $billing_address,
				'shipping'        => $shipping_address,
				'shipping_method' => ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) ? $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] : [
					'title'  => 'Free',
					'amount' => 0.00
				],
				'discount'        => ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['discount'] ) ) ? $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['discount'] : '0.00',
				'status'          => $transaction->transaction->status,
			);

			Session::put( 'shopify_order_details', $shopifyOrderDetails );
			Session::save();
		} else {

			//print_r($transaction); die;
			$shopifyOrderDetails = array(
				'transaction_id'  => $transaction->transaction->id,
				'order_id'        => $transaction->transaction->order_id,
				'customer'        => array(
					'id'         => $orderDetails['customer']['id'],
					'email'      => $orderDetails['customer']['email'],
					'first_name' => $orderDetails['customer']['first_name'],
					'last_name'  => $orderDetails['customer']['last_name']
				),
				'line_items'      => $shopifyOrder->order->line_items,
				"total_price"     => $shopifyOrder->order->total_price,
				"subtotal_price"  => $shopifyOrder->order->subtotal_price,
				"total_tax"       => $shopifyOrder->order->total_tax,
				'bump'            => $bump,
				'amount'          => $transaction->transaction->amount,
				'currency'        => $transaction->transaction->currency,
				'source'          => $transaction->transaction->source_name,
				'billing'         => $orderDetails['billing'],
				'shipping'        => $orderDetails['shipping'],
				'shipping_method' => ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) ? $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] : [
					'title'  => 'Free',
					'amount' => 0.00
				],
				'discount'        => ( ! empty( $userCart['cart']['discount'] ) ) ? $userCart['cart']['discount'] : '0.00',
				'status'          => $transaction->transaction->status,
			);
		}

		$infoDetails['order']['shopify'] = $shopifyOrderDetails;

		$order                 = new Order;
		$order->user_id        = $funnel->user_id;
		$order->page_id        = $request->input( 'page_id' );
		$order->customer_email = $shopifyOrderDetails['customer']['email'];
		$order->amount         = $shopifyOrderDetails['amount'];
		$order->save();

		//save order details
		$newOrderDetails           = new OrderDetail();
		$newOrderDetails->order_id = $order->id;
		$newOrderDetails->type     = 'shopify';
		$newOrderDetails->details  = json_encode( $infoDetails );
		$newOrderDetails->save();

		//add customer
		try {

			$orderCustomer                  = new OrderCustomer();
			$orderCustomer['order_id']      = $order->id;
			$orderCustomer['customer_name'] = $orderDetails['customer']['first_name'] . ' ' . $orderDetails['customer']['last_name'];
			$orderCustomer['email']         = $orderDetails['customer']['email'];
			$orderCustomer['details']       = json_encode(
				array(
					'shipping' => $orderDetails['shipping'],
					'billing'  => $orderDetails['billing'],
				)
			);
			$orderCustomer->save();

		} catch ( Exception $exp ) {
		}

		//save order products
		if ( !empty($userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['variant']['id']) ) {
			$variant_details = array(
				'id'	=> $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['variant']['id'],
				'name'	=> $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['variant']['title']
			);
		} else {
			$variant_details = array();
		}

		$orderProduct                 = new OrderProducts();
		$orderProduct['order_id']     = $order->id;
		$orderProduct['product_id']   = $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['product_id'];
		$orderProduct['variant_details']   = json_encode($variant_details);
		$orderProduct['product_name'] = $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['title'];
		$orderProduct['product_type'] = 'shopify';
		$orderProduct['status']       = true;
		$orderProduct->save();

		if ( ! empty( $bump ) ) {

			$order                 = new Order;
			$order->user_id        = $funnel->user_id;
			$order->page_id        = $request->input( 'page_id' );
			$order->customer_email = $shopifyOrderDetails['customer']['email'];
			$order->amount         = $bump['amount'];
			$order->save();

			//save order details
			$newOrderDetails           = new OrderDetail();
			$newOrderDetails->order_id = $order->id;
			$newOrderDetails->type     = 'shopify';
			$newOrderDetails->details  = json_encode( $infoDetails );
			$newOrderDetails->save();

			$orderProduct                 = new OrderProducts();
			$orderProduct['order_id']     = $order->id;
			$orderProduct['product_id']   = $bump['id'];
			$orderProduct['variant_details']   = json_encode(array());
			$orderProduct['product_name'] = $bump['title'];
			$orderProduct['product_type'] = 'shopify';
			$orderProduct['status']       = true;
			$orderProduct->save();
		}

		return $orderPayment;
	}


	private function makePaypalEntry( $details, $userCart, $orderDetails ) {

		$this->api_key      = $details['api_key'];
		$this->api_password = $details['api_password'];
		$this->store        = $details['store'];


		if ( Session::has( 'shopify_order_details' ) ) {
			$shopifyDetails = Session::get( 'shopify_order_details' );
		} else {
			$shopifyDetails = array();
		}

		//after make successful payment, make order to shopify to keep the record in shopify dashboard
		$url = "https://" . $this->api_key . ":" . $this->api_password . "@" . $this->store . ".myshopify.com/admin/orders.json";


		//bump
		$line_items[] = array(
			"variant_id" => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['variant']['details']->id,
			"quantity"   => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['quantity']
		);

		if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump'] ) ) {
			$line_items[] = array(
				"variant_id" => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['variant']['details']->id,
				"quantity"   => 1
			);
		}


		//shipping
		$tax_lines = array();
		if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) {
			$tax_lines = array(
				array(
					'price' => floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping']['amount'] ),
					'rate'  => 0.00,
					'title' => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping']['title']
				)
			);
		}

		//total tax
		$total_tax_amount = 0.00;

		if ( ! empty( $tax_lines ) ) {
			foreach ( $tax_lines as $tax ) {
				$total_tax_amount += $tax['price'];
			}
		}


		//calculate the amount
		if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['product_id'] ) ) {
			if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) {
				$trans_amount = ( floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['total'][1] ) - floatval( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping']['amount'] ) ) + floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['total'][1] );
			} else {
				$trans_amount = floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['total'][1] ) + floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['total'][1] );
			}
		} else {
			if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) {
				$trans_amount = floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['total'][1] ) - floatval( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping']['amount'] );
			} else {
				$trans_amount = floatVal( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['total'][1] );
			}
		}


		if ( empty( $orderDetails ) ) {
			$shipping_address = array(
				"first_name" => $request->input( 'first_name' ),
				"last_name"  => $request->input( 'last_name' ),
				"address1"   => $request->input( 'full_address' ),
				"phone"      => $request->input( 'phone' ),
				"city"       => $request->input( 'city' ),
				"province"   => $request->input( 'state' ),
				"country"    => $request->input( 'country' ),
				"zip"        => $request->input( 'zip' ),
			);

			if ( $request->input( 'selection' ) == 'same' ) {
				$billing_address = $shipping_address;
			} else {
				$billing_address = array(
					"first_name" => $request->input( 'billing_first_name' ),
					"last_name"  => $request->input( 'billing_last_name' ),
					"address1"   => $request->input( 'billing_full_address' ),
					"phone"      => $request->input( 'billing_phone' ),
					"city"       => $request->input( 'billing_city' ),
					"province"   => $request->input( 'billing_state' ),
					"country"    => $request->input( 'billing_country' ),
					"zip"        => $request->input( 'billing_zip' ),
				);
			}

			//make order data
			$post_data['order'] = array(
				"line_items"         => $line_items,
				"tax_lines"          => $tax_lines,
				"total_tax"          => $total_tax_amount,
				"customer"           => array(
					"first_name" => "",
					"last_name"  => "",
					"email"      => $request->input( 'email' ),
				),
				"billing_address"    => $billing_address,
				"shipping_address"   => array(
					"first_name" => $request->input( 'first_name' ),
					"last_name"  => $request->input( 'last_name' ),
					"address1"   => $request->input( 'full_address' ),
					"phone"      => $request->input( 'phone' ),
					"city"       => $request->input( 'city' ),
					"province"   => $request->input( 'state' ),
					"country"    => $request->input( 'country' ),
					"zip"        => $request->input( 'zip' ),
				),
				"transactions"       => array(
					array(
						"kind"   => "authorization",
						"status" => "success",
						"amount" => $trans_amount
					)
				),
				"fulfillment_status" => "fulfilled",
			);
		} else {

			if ( empty( $shopifyDetails ) ) {
				$customer = array(
					"first_name" => "",
					"last_name"  => "",
					"email"      => $orderDetails['customer']['email'],
				);
			} else {
				$customer = array(
					'id' => $shopifyDetails['customer']['id']
				);
			}

			$post_data['order'] = array(
				"line_items"         => $line_items,
				"tax_lines"          => $tax_lines,
				"total_tax"          => $total_tax_amount,
				"customer"           => $customer,
				"billing_address"    => $orderDetails['billing'],
				"shipping_address"   => $orderDetails['shipping'],
				"transactions"       => array(
					array(
						"kind"   => "authorization",
						"status" => "success",
						"amount" => $trans_amount
					)
				),
				"fulfillment_status" => "fulfilled",
			);
		}

		//make order in shopify
		$shopifyOrder = json_decode( $this->makePostRequest( $url, $post_data ) );
		//echo "<pre>==";print_r($shopifyOrder); die;


		//create transaction
		$url = "https://" . $this->api_key . ":" . $this->api_password . "@" . $this->store . ".myshopify.com/admin/orders/" . $shopifyOrder->order->id . "/transactions.json";

		$post_data['transaction'] = array(
			"amount" => $trans_amount,
			"kind"   => "capture"
		);


		$transaction = json_decode( $this->makePostRequest( $url, $post_data ) );
		//echo '<pre>'; print_r($transaction); die;

		/////
		foreach ( $shopifyOrder->order->line_items as $item ) {
			$lineItem = $item;
		}


		if ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['product_id'] ) ) {

			$bump = array(
				'id'     => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['product_id'],
				'title'  => $item->title,
				'amount' => $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['bump']['total'][1]
			);
		} else {
			$bump = array();
		}


		//if ( Session::has('shopify_order_details') ) {
		$shopifyOrderDetails = array(
			'transaction_id'  => $transaction->transaction->id,
			'order_id'        => $transaction->transaction->order_id,
			'customer'        => array(
				'id'         => $shopifyOrder->order->customer->id,
				'email'      => $shopifyOrder->order->customer->email,
				'first_name' => $shopifyOrder->order->customer->first_name,
				'last_name'  => $shopifyOrder->order->customer->last_name
			),
			'line_items'      => $shopifyOrder->order->line_items,
			"total_price"     => $shopifyOrder->order->total_price,
			"subtotal_price"  => $shopifyOrder->order->subtotal_price,
			"total_tax"       => $shopifyOrder->order->total_tax,
			'bump'            => $bump,
			'amount'          => $transaction->transaction->amount,
			'currency'        => $transaction->transaction->currency,
			'source'          => $transaction->transaction->source_name,
			'billing'         => $orderDetails['billing'],
			'shipping'        => $orderDetails['shipping'],
			'shipping_method' => ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] ) ) ? $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['shipping'] : [
				'title'  => 'Free',
				'amount' => 0.00
			],
			'discount'        => ( ! empty( $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['discount'] ) ) ? $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['discount'] : '0.00',
			'status'          => $transaction->transaction->status,
		);

		if ( ! Session::has( 'shopify_order_details' ) ) {
			Session::put( 'shopify_order_details', $shopifyOrderDetails );
			Session::save();
		}
		//}

		//save the order
		$order                 = new Order;
		$order->user_id        = Session::get( 'httpRequest' )['frm_hid_user_id'];
		$order->page_id        = Session::get( 'httpRequest' )['frm_hid_page_id'];
		$order->customer_email = $shopifyOrderDetails['customer']['email'];
		$order->amount         = $shopifyOrderDetails['amount'];
		$order->save();

		$infoDetails['order']['shopify'] = $shopifyOrderDetails;
		$infoDetails['order']['paypal']  = $orderDetails;

		//save order details
		$newOrderDetails           = new OrderDetail();
		$newOrderDetails->order_id = $order->id;
		$newOrderDetails->type     = 'shopify';
		$newOrderDetails->details  = json_encode( $infoDetails );
		$newOrderDetails->save();






		//add customer
		try {

			$orderCustomer                  = new OrderCustomer();
			$orderCustomer['order_id']      = $order->id;
			$orderCustomer['customer_name'] = $shopifyOrderDetails['customer']['first_name'] . ' ' . $shopifyOrderDetails['customer']['last_name'];
			$orderCustomer['email']         = $shopifyOrderDetails['customer']['email'];
			$orderCustomer['details']       = json_encode(
				array(
					'shipping' => $shopifyOrderDetails['shipping'],
					'billing'  => $shopifyOrderDetails['billing'],
				)
			);
			$orderCustomer->save();

		} catch ( Exception $exp ) {
		}

		//save order products
		if ( !empty($userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['variant']['id']) ) {
			$variant_details = array(
				'id'	=> $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['variant']['id'],
				'name'	=> $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['variant']['title']
			);
		} else {
			$variant_details = array();
		}

		$orderProduct                 = new OrderProducts();
		$orderProduct['order_id']     = $order->id;
		$orderProduct['product_id']   = $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['product_id'];
		$orderProduct['variant_details']   = json_encode($variant_details);
		$orderProduct['product_name'] = $userCart['cart']['products'][ count( $userCart['cart']['products'] ) - 1 ]['title'];
		$orderProduct['product_type'] = 'shopify';
		$orderProduct['status']       = true;
		$orderProduct->save();

		if ( ! empty( $bump ) ) {

			$order                 = new Order;
			$order->user_id        = Session::get( 'httpRequest' )['frm_hid_user_id'];
			$order->page_id        = Session::get( 'httpRequest' )['frm_hid_page_id'];
			$order->customer_email = $shopifyOrderDetails['customer']['email'];
			$order->amount         = $bump['amount'];
			$order->save();

			//save order details
			$newOrderDetails           = new OrderDetail();
			$newOrderDetails->order_id = $order->id;
			$newOrderDetails->type     = 'shopify';
			$newOrderDetails->details  = json_encode( $infoDetails );
			$newOrderDetails->save();

			$orderProduct                 = new OrderProducts();
			$orderProduct['order_id']     = $order->id;
			$orderProduct['product_id']   = $bump['id'];
			$orderProduct['variant_details']   = json_encode(array());
			$orderProduct['product_name'] = $bump['title'];
			$orderProduct['product_type'] = 'shopify';
			$orderProduct['status']       = true;
			$orderProduct->save();
		}



		//return $orderPayment;
	}


	public function makeShopifyPaymentPaypal( Request $request, $gateway, $orderPayment = array(), $paypal_return = false ) {

		//echo "==" .  print_r($gateway); die;

		if ( ! $paypal_return ) {

			if ( Session::has( 'product_current_cart' ) ) {
				$userCart = Session::get( 'product_current_cart' );
			} else {
				$userCart = array();
			}

			

			//check for past customer details
			if ( Session::has( 'shopify_order_details' ) ) {
				$orderDetails = Session::get( 'shopify_order_details' );
			} else {
				$orderDetails = array();
			}

			return $this->makePaypalRedirectPayment( $request, $gateway, $userCart, 'shopify' );
			die;
		}
	}


	/////////////////////////////////////////////// STRIPE ////////////////////////////////////////
	public function makeStripePayment( Request $request, $gateway, $shopifyOrder = null, $paymentTypeChoosed = null, $savedPaymentDetails = null ) {

		//$this->initializeAuth($request);

		//echo '<pre>'; print_r($_POST); die;

		$token  = $request->input( 'stripeToken' );
		$funnel = Funnel::find( $request->input( 'funnel_id' ) );

		//order details
		if ( $shopifyOrder == null ) {
			if ( Session::has( 'product_current_cart' ) ) {
				$userOrder = Session::pull( 'product_current_cart' );
			} else {
				$userOrder = array();
			}
		} else {
			$userOrder = $shopifyOrder;
		}

		//print_r($userOrder); die;

		//get api keys
		$details = json_decode( $gateway->details );


		if ( $savedPaymentDetails == null ) {
			if ( Session::has( 'saved_payment' ) ) {
				$savedPaymentDetails = Session::get( 'saved_payment' );
			}
		}


		//echo '<pre>'; print_r($savedPaymentDetails); die;
		//echo '<pre>'; print_r($details); die;

		/////////////////////////////////
		//$stripe = Stripe::make($details->secret_key);
		\Stripe\Stripe::setApiKey( $details->secret_key );


		// ------------------ MAKE CUSTOMER -----------------------
		if ( empty( $savedPaymentDetails ) ) {
			$shipping_address = array(
				"first_name" => $request->input( 'first_name' ),
				"last_name"  => $request->input( 'last_name' ),
				"address1"   => $request->input( 'full_address' ),
				"phone"      => $request->input( 'phone' ),
				"city"       => $request->input( 'city' ),
				"province"   => $request->input( 'state' ),
				"country"    => $request->input( 'country' ),
				"zip"        => $request->input( 'zip' ),
			);

			if ( $request->input( 'selection' ) == 'same' ) {
				$billing_address = $shipping_address;
			} else {
				$billing_address = array(
					"first_name" => $request->input( 'billing_first_name' ),
					"last_name"  => $request->input( 'billing_last_name' ),
					"address1"   => $request->input( 'billing_full_address' ),
					"phone"      => $request->input( 'billing_phone' ),
					"city"       => $request->input( 'billing_city' ),
					"province"   => $request->input( 'billing_state' ),
					"country"    => $request->input( 'billing_country' ),
					"zip"        => $request->input( 'billing_zip' ),
				);
			}


			////////////////////
			/**
			 *
			 * SAVE THE TOKEN ON THE CUSTOMER SO IT CAN BE USED IN THE FUTURE
			 * THIS WILL ALSO CHARGE THE CUSTOMER ONCE
			 */
			/*$customer = $stripe->customers()->create([
				'email' => $request->input('email'),
			]);
			echo '<pre>'; print_r($customer);*/

			//Create a Customer
			$customer = \Stripe\Customer::create( array(
					"source"      => $token,
					"description" => $request->input( "email" )
				)
			);

			/*$token = $stripe->tokens()->create([
				'card' => [
					'number'    => $request->input('number'),
					'exp_month' => $request->input('exp-month'),
					'exp_year'  => $request->input('exp-year'),
					'cvc'       => $request->input('cvc'),
					"name"		=> $request->input('billing_first_name') . ' ' . $request->input('billing_last_name'),
					"address_zip" => $request->input('billing_zip')
				],
			]);

			$card = $stripe->cards()->create($customer['id'], $token['id']);
			echo '<pre>'; print_r($card);*/
			$customer_id = $customer->id;

		} else {

			$customer_id = $savedPaymentDetails['customer']['id'];
			//$auth = "Bearer $details->secret_key";

			$billing_address  = $savedPaymentDetails['billing'];
			$shipping_address = $savedPaymentDetails['shipping'];
		}


		// ------------------ MAKE PAYMENT -----------------------
		//Charge the Customer instead of the card
		//$amount = floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['total'][1] ) * 100;
		$amount = floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['total'][1] );

		///////////////////////////// NEWLY ADDED /////////////////////////////
		//calculate shipping
		if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['shipping'] ) ) {
			$amount = floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['total'][1] ) + floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['shipping'] );
		}

		//calculate discount
		if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] ) ) {
			//$amount = $amount - floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] );
			$percentage = (floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] ) / 100) * $amount;
			$amount = $amount - $percentage;
		}

		//convert it in cents
		$amount = round($amount * 100);

		//echo $amount; die;

		try {
			/*$charge = $stripe->charges()->create([
				'amount'   => $amount,
				'currency' => 'usd',
				'customer' => $customer_id
			]);*/

			// Charge the Customer instead of the card
			$charge = \Stripe\Charge::create( array(
					"amount"   => $amount, // amount in cents, again
					"currency" => "usd",
					"customer" => $customer_id
				)
			);


			//echo '<pre>'; print_r($charge); die;

			//charge if there was a bump
			if ( ! empty( $charge->id ) ) {
				if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump'] ) ) {

					$amount = floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['total'][1] ) * 100;
					/*$bump_charge = $stripe->charges()->create([
						'customer' => $customer_id,
						'currency' => 'usd',
						'amount'   => $amount,
					]);*/
					$bump_charge = \Stripe\Charge::create( array(
							"amount"   => $amount, // amount in cents, again
							"currency" => "usd",
							"customer" => $customer_id
						)
					);

					$bump = array(
						'product' => [
							'id'     => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['product_id'],
							'title'  => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['title'],
							'amount' => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['total'][1]
						],
					);
				} else {
					$bump = array();
				}
			}


			if ( empty( $savedPaymentDetails ) ) {
				$nextStepPayment = array(
					'charge_id'         => $charge->id,
					'customer'          => array(
						'id'         => $charge->customer,
						'email'      => $request->input( 'email' ),
						'first_name' => $billing_address['first_name'],
						'last_name'  => $billing_address['last_name']
					),
					'payment_selection' => $paymentTypeChoosed,
					'billing'           => $billing_address,
					'shipping'          => $shipping_address
				);

				// Save the customer ID and other info in a database for later.
				// When it's time to charge the customer again, retrieve the customer ID
				Session::put( 'saved_payment', $nextStepPayment );
				Session::save();
			} else {
				$nextStepPayment = $savedPaymentDetails;
			}


			// ------------------ SAVE DETAILS -----------------------
			$total_amount = floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['total'][1] );

			//add bump
			if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump'] ) ) {
				$total_amount = $total_amount + floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['total'][1] );
			}


			if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['shipping'] ) ) {
				$total_amount = floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['total'][1] ) + floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['shipping'] );
			}

			if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] ) ) {
				$total_amount = $total_amount - floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] );
			}


			//info
			$orderDetails = array(
				'charge_id' => $charge->id,
				'customer'  => array(
					'customer'   => $charge->customer,
					'email'      => ( ! empty( $request->input( 'email' ) ) ) ? $request->input( 'email' ) : $nextStepPayment['customer']['email'],
					'first_name' => $nextStepPayment['billing']['first_name'],
					'last_name'  => $nextStepPayment['billing']['last_name']
				),

				'product'             => [
					'id'    => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['product_id'],
					'title' => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['title'],
					'bump'  => $bump
				],
				'amount'              => $charge->amount,
				'total_amount'        => $total_amount,
				'balance_transaction' => $charge->balance_transaction,
				'billing'             => $billing_address,
				'shipping'            => $shipping_address,
				'shipping_method'     => ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['shipping'] ) ) ? $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['shipping'] : [
					'title'  => 'Free',
					'amount' => 0.00
				],
				'discount'            => ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] ) ) ? $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] : '0.00',
				'source'              => $charge->source->id,
				'currency'            => $charge->currency,
				'status'              => $charge->status
			);


			//save customer order info for confirmation page
			Session::put( 'product_order_info', $orderDetails );
			Session::save();


			if ( $shopifyOrder !== null ) {
				return [ $nextStepPayment, $orderDetails ];
			} else {

				$manualDetails['order']['info']   = $orderDetails;
				$manualDetails['order']['stripe'] = $orderDetails;

				//save the order
				$order                 = new Order;
				$order->user_id        = $funnel->user_id; //
				$order->page_id        = $request->input( 'page_id' );
				$order->customer_email = $orderDetails['customer']['email'];
				$order->amount         = $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['total'][1];
				$order->save();

				//save order details
				$newOrderDetails           = new OrderDetail();
				$newOrderDetails->order_id = $order->id;
				$newOrderDetails->type     = 'stripe';
				$newOrderDetails->details  = json_encode( $manualDetails );
				$newOrderDetails->save();
				//echo '<pre>'; print_r($charge); die;

				//add customer - try catch is added duto to eliminate duplicate email error reporting
				try {
					$orderCustomer                  = new OrderCustomer();
					$orderCustomer['order_id']      = $order->id;
					$orderCustomer['customer_name'] = $manualDetails['order']['info']['customer']['first_name'] . ' ' . $manualDetails['order']['info']['customer']['last_name'];
					$orderCustomer['email']         = $manualDetails['order']['info']['customer']['email'];
					$orderCustomer['details']       = json_encode(
						array(
							'shipping' => $manualDetails['order']['info']['shipping'],
							'billing'  => $manualDetails['order']['info']['billing'],
						)
					);
					$orderCustomer->save();

				} catch ( Exception $exp ) {
				}

				//save order products
				if ( !empty($userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['variant']['id']) ) {
					$variant_details = array(
						'id'	=> $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['variant']['id'],
						'name'	=> $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['variant']['title']
					);
				} else {
					$variant_details = array();
				}

				$orderProduct                 = new OrderProducts();
				$orderProduct['order_id']     = $order->id;
				$orderProduct['product_id']   = $orderDetails['product']['id'];
				$orderProduct['variant_details']   = json_encode($variant_details);
				$orderProduct['product_name'] = $orderDetails['product']['title'];
				$orderProduct['product_type'] = 'manual';
				$orderProduct['status']       = true;
				$orderProduct->save();

				if ( ! empty( $bump ) ) {

					$order                 = new Order;
					$order->user_id        = $funnel->user_id; //
					$order->page_id        = $request->input( 'page_id' );
					$order->customer_email = $orderDetails['customer']['email'];
					$order->amount         = $bump['product']['amount'];
					$order->save();

					//save order details
					$newOrderDetails           = new OrderDetail();
					$newOrderDetails->order_id = $order->id;
					$newOrderDetails->type     = 'stripe';
					$newOrderDetails->details  = json_encode( $manualDetails );
					$newOrderDetails->save();

					$orderProduct                 = new OrderProducts();
					$orderProduct['order_id']     = $order->id;
					$orderProduct['product_id']   = $bump['product']['id'];
					$orderProduct['variant_details']   = json_encode(array());
					$orderProduct['product_name'] = $bump['product']['title'];
					$orderProduct['product_type'] = 'manual';
					$orderProduct['status']       = true;
					$orderProduct->save();
				}
			}
		} catch ( Exception $e ) {
			//print_r($e->getMessage());

			//echo '<pre>'; print_r($e->getMessage()); die;

			return array(
				'error' => $e->getMessage()
			);
		}
	}


	public function makePaypalRedirectPayment( Request $request, $gateway, $recent_product = array(), $shopify = false ) {
		// dd($recent_product);

		$data          = array();
		$saved_details = array();
		$order_details = array();

		if ( ! empty( $recent_product ) ) {
			$userOrder = $recent_product;
		} else {
			$userOrder = Session::get( 'product_current_cart' );
		}
		// dd($userOrder);
		$this->paypal_data = array(
			/** set your paypal credential **/
			'client_id' => 'paypal client_id',
			'secret'    => 'paypal secret ID',
			/**
			 * SDK configuration
			 */
			'settings'  => array(
				/**
				 * Available option 'sandbox' or 'live'
				 */
				'mode'                   => env( 'PAYPAL_TRANSACT_MODE' ),
				/**
				 * Specify the max request time in seconds
				 */
				'http.ConnectionTimeOut' => 10000,
				/**
				 * Whether want to log to a file
				 */
				'log.LogEnabled'         => true,
				/**
				 * Specify the file that want to write on
				 */
				'log.FileName'           => storage_path() . '/logs/paypal.log',
				/**
				 * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
				 *
				 * Logging is most verbose in the 'FINE' level and decreases as you
				 * proceed towards ERROR
				 */
				'log.LogLevel'           => 'FINE'
			),
		);

		//////////////////////////////////////////////////////

		//if ( !Session::has('paypal_api_context') ) {
		$details                        = json_decode( $gateway->details );
		// dd($details);
		$this->paypal_data['client_id'] = $details->client_id;
		$this->paypal_data['secret']    = $details->secret;

		/** setup PayPal api context **/
		$paypal_conf        = $this->paypal_data;
		// dd($paypal_conf);
		$this->_api_context = new ApiContext( new OAuthTokenCredential( $paypal_conf['client_id'], $paypal_conf['secret'] ) );
		// dd($this->_api_context);
		// $this->_api_context->setConfig($paypal_conf['settings']);
		// dd($this->_api_context);

		$this->_api_context->setConfig(
			array(

				'mode'                   => env( 'PAYPAL_TRANSACT_MODE' ),
				'http.ConnectionTimeOut' => 1000,
				'log.LogEnabled'         => true,
				'log.FileName'           => storage_path() . '/logs/paypal.log',
				'log.LogLevel'           => 'FINE'
			)
		);

		//save shop credentials
		if ( $shopify ) {
			$this->initializeAuth( $request );
			Session::put( "shopify_credentials", array(
				'api_key'      => $this->api_key,
				'api_password' => $this->api_password,
				'store'        => $this->store,
			) );
		}

		/*print_r( $this->_api_context );
		die;*/

		Session::put( "paypal_api_context", $this->_api_context );
		Session::save();

		/*} else {
			//$this->_api_context = Session::get('paypal_api_context');
		}*/

		return $this->postPaymentWithpaypal( $request, $userOrder, $shopify );
		/////////////////////////////////////////////////////
	}






	///////////////////////////////////////////////

	/**
	 * Store a details of payment with paypal.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function postPaymentWithpaypal( Request $request, $userOrder, $shopify ) {
		$data          = array();
		$saved_details = array();

		//echo '<pre>'; print_r($userOrder); die;

		$funnel              = Funnel::find( $request->input( 'funnel_id' ) );
		$savedPaymentDetails = Session::get( 'saved_payment' );

		//bump
		if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump'] ) ) {
			$bump = array(
				'id'          => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['product_id'],
				'name'        => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['title'],
				'description' => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['title'],
				'quantity'    => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['quantity'],
				'price'       => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['total'][1],
				'tax'         => '0.00',
				'sku'         => '',
				//$userOrder['cart']['products'][count($userOrder['cart']['products']) - 1]['bump']['sku'],
				'currency'    => 'USD'
			);

			$amount_total = $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['total'][1];
		} else {
			$bump         = array();
			$amount_total = 0.00;
		}


		if ( empty( $savedPaymentDetails ) ) {
			$shipping_address = array(
				"recipient_name" => $request->input( 'first_name' ) . ' ' . $request->input( 'last_name' ),
				"line1"          => $request->input( 'full_address' ),
				"city"           => $request->input( 'city' ),
				"country_code"   => $request->input( 'country' ),
				"postal_code"    => $request->input( 'zip' ),
				"phone"          => $request->input( 'phone' ),
				"state"          => $request->input( 'state' )
			);

			if ( $request->input( 'selection' ) == 'same' ) {
				//$billing_address = $shipping_address;

				$billing_address = array(
					"line1"        => $request->input( 'full_address' ),
					"city"         => $request->input( 'city' ),
					"state"        => $request->input( 'state' ),
					"postal_code"  => $request->input( 'zip' ),
					"country_code" => 'US' //$request->input('country')
				);

			} else {
				$billing_address = array(
					"line1"        => $request->input( 'billing_full_address' ),
					"city"         => $request->input( 'billing_city' ),
					"state"        => $request->input( 'billing_state' ),
					"postal_code"  => $request->input( 'billing_zip' ),
					"country_code" => 'US' //$request->input('billing_country')
				);
			}

		} else {
			$shipping_address = $savedPaymentDetails['shipping'];
			$billing_address  = $savedPaymentDetails['billing'];

			//$funding_instruments = $savedPaymentDetails['funding_instruments'];
		}


		//Amount settings
		if ( ! empty( $userOrder['cart']['shipping'] ) ) {
			if ( $userOrder['cart']['shipping']['title'] == 'Free' ) {
				$shipping = number_format( floatVal( $userOrder['cart']['shipping']['amount'] ), 2 );
			} else {
				$shipping = number_format( floatVal( $userOrder['cart']['shipping']['amount'] ), 2 );
			}
		} else {
			$shipping = 0.00;
		}

		if ( ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] ) ) ) {

			$discount = $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'];
		} else {
			$discount = 0.00;
		}

		$product_total = ( floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['total'][1] ) + $shipping ) - $discount;
		$amount_total  += ( floatVal( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['total'][1] ) + $shipping ) - $discount;


		$payer = new Payer();
		$payer->setPaymentMethod( 'paypal' );

		if ( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['quantity'] < 1 ) {
			$quantity = 1;
		} else {
			$quantity = $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['quantity'];
		}

		$item_1 = new Item();
		$item_1->setName( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['title'] )/** item name **/
		       ->setCurrency( 'USD' )
		       ->setQuantity( $quantity )
		       ->setPrice( $product_total );
		/** unit price **/

		$items_array = array();

		//add primary product
		$item_list = new ItemList();
		//$item_list->setItems(array($item_1));
		$items_array[] = $item_1;


		if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump'] ) ) {
			$item_2 = new Item();
			$item_2->setName( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['title'] )/** item name **/
			       ->setCurrency( 'USD' )
			       ->setQuantity( 1 )
			       ->setPrice( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['total'][1] );
			/** unit price **/

			//$item_list->setItems(array($item_2));
			$items_array[] = $item_2;
		}

		$item_list->setItems( $items_array );

		//echo '<pre>'; print_r($item_list); die;
		//echo "Total: " . $amount_total . ", " .  " Qty:" . $quantity . "<br /> " . floatVal($userOrder['cart']['products'][count($userOrder['cart']['products']) - 1]['total'][1]) . "<br>" . $userOrder['cart']['products'][count($userOrder['cart']['products']) - 1]['total'][1]; die;

		$amount = new Amount();
		$amount->setCurrency( 'USD' )
		       ->setTotal( $amount_total );

		$transaction = new Transaction();
		$transaction->setAmount( $amount )
		            ->setItemList( $item_list )
		            ->setDescription( 'Your transaction description' );

		$redirect_urls = new RedirectUrls();
		$funnelPage    = $this->getNextFunnelPage( $request->input( 'page_id' ) );
		//echo $funnelPage; die;
		$redirect_urls->setReturnUrl( route( 'page.view', $funnelPage->slug ) )/** Specify return URL **/
		              ->setCancelUrl( route( 'page.view', Page::find( $request->input( 'page_id' ) )->slug ) );

		$payment = new Payment();
		$payment->setIntent( 'sale' )
		        ->setPayer( $payer )
		        ->setRedirectUrls( $redirect_urls )
		        ->setTransactions( array( $transaction ) );
		/** dd($payment->create($this->_api_context));exit; **/
		//try {

		$payment->create( $this->_api_context );

		//echo '<pre>'; print_r($payment); die;

		foreach ( $payment->getLinks() as $link ) {
			if ( $link->getRel() == 'approval_url' ) {
				$redirect_url = $link->getHref();
				break;
			}
		}

		/** add payment ID to session **/
		Session::put( 'paypal_payment_id', $payment->getId() );
		//if(isset($redirect_url)) {

		//save data to store in database after payment made
		$nextStepPayment = array(
			'id'                => $payment->getId(),
			'customer'          => array(
				'email'      => $request->input( 'email' ),
				'first_name' => $request->input( 'first_name' ),
				'last_name'  => $request->input( 'last_name' )
			),
			'payment_selection' => $request->input( 'payment_selection' ),
			'billing'           => $billing_address,
			'shipping'          => $shipping_address,
			'user_id'           => $funnel->user_id,
			'page_id'           => $request->input( 'page_id' ),
			'shopify'           => $shopify
		);

		Session::put( 'saved_payment', $nextStepPayment );
		Session::save();

		/*Session::put( 'session_user_order', $userOrder );
		Session::save();*/

		Session::put( 'httpRequest', array(
			'frm_hid_user_id' => $funnel->user_id,
			'frm_hid_page_id' => $request->input( 'page_id' )
		) );
		Session::save();

		//print_r($redirect_url); die;


		/** redirect to paypal **/
		return [
			'type' => 'paypal_redirect',
			'url'  => $redirect_url
		];

		//die;
		//}

		//\Session::put('error','Unknown error occurred');
		//return Redirect::route('addmoney.paywithpaypal');

		/*} catch (Exception $ex) {

			return array(
				'error' => $ex->getMessage()
			);
		}*/
	}

	//////////////////////////////////////////////


	public function afterPaypalPayment( Request $request ) {


		$apiContext = Session::get( 'paypal_api_context' );
		Session::forget( 'paypal_api_context' );
		Session::save();

		$savedPayment        = Session::get( 'saved_payment' );
		$userOrder           = Session::get( 'product_current_cart' );
		$shopifyOrderDetails = Session::get( 'shopify_order_details' );

		$payment = Payment::get( $request->input( 'paymentId' ), $apiContext );
		// dd($payment);
		// PaymentExecution object includes information necessary
		// to execute a PayPal account payment.
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId( $request->input( 'PayerID' ) );

		//echo "api=";    print_r($apiContext);

		//try {


		//Execute the payment
		//try {
		$result = $payment->execute( $execution, $apiContext );
		// dd($result);

		if ( $result->getState() == 'approved' ) { // payment made
			// Payment is successful do your business logic here
			//dd($result);

			$jsonResult = json_decode( $result->toJSON() );
			//print_r($jsonResult);

			//bump
			if ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump'] ) ) {
				$bump = array(
					'id'          => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['product_id'],
					'name'        => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['title'],
					'description' => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['title'],
					'quantity'    => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['quantity'],
					'price'       => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['total'][1],
					'tax'         => '0.00',
					'sku'         => '',
					//$userOrder['cart']['products'][count($userOrder['cart']['products']) - 1]['bump']['sku'],
					'currency'    => 'USD'
				);

				$amount_total = $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['bump']['total'][1];
			} else {
				$bump         = array();
				$amount_total = 0.00;
			}

			// dd($bump);
			$orderDetails = array(
				'id'              => $jsonResult->id,
				'customer'        => array(
					//'id'         => $savedPayment['customer']['id'],
					'email'      => $jsonResult->payer->payer_info->email,
					'first_name' => $jsonResult->payer->payer_info->first_name,
					'last_name'  => $jsonResult->payer->payer_info->last_name,
				),
				'product'         => [
					'id'    => $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['product_id'],
					'title' => $jsonResult->transactions[0]->item_list->items[0]->name,
					'bump'  => ( ! empty( $jsonResult->transactions[0]->item_list->items[1] ) ) ? $bump : array()
				],
				'amount'          => $jsonResult->transactions[0]->amount->total,
				'total_amount'    => $jsonResult->transactions[0]->amount->total,
				'billing'         => $savedPayment['billing'], //wrong here
				'shipping'        => $savedPayment['shipping'], //wrong here
				//'shipping'        => $jsonResult->payer->payer_info->shipping_address, //wrong here
				'shipping_method' => ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['shipping'] ) ) ? $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['shipping'] : [
					'title'  => 'Free',
					'amount' => 0.00
				],
				'discount'        => ( ! empty( $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] ) ) ? $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['discount'] : '0.00',
				'currency'        => $jsonResult->transactions[0]->amount->currency,
				'status'          => $jsonResult->state,
			);


			//if shopify make shopify entry
			if ( Session::has( 'shopify_credentials' ) ) {
				$details = Session::get( 'shopify_credentials' );

				$this->makePaypalEntry( $details, $userOrder, $orderDetails );
			} else {

				//save to database
				$manualDetails['order']['info']   = $orderDetails;
				$manualDetails['order']['paypal'] = $orderDetails;

				//save the order
				$order                 = new Order;
				$order->user_id        = $savedPayment['user_id']; //
				$order->page_id        = $savedPayment['page_id'];
				$order->customer_email = $jsonResult->payer->payer_info->email;
				$order->amount         = $orderDetails['amount'];
				$order->save();

				//save order details
				$newOrderDetails           = new OrderDetail();
				$newOrderDetails->order_id = $order->id;
				$newOrderDetails->type     = 'stripe';
				$newOrderDetails->details  = json_encode( $manualDetails );
				$newOrderDetails->save();

				//add customer
				try {

					$orderCustomer                  = new OrderCustomer();
					$orderCustomer['order_id']      = $order->id;
					$orderCustomer['customer_name'] = $orderDetails['customer']['first_name'] . ' ' . $orderDetails['customer']['last_name'];
					$orderCustomer['email']         = $orderDetails['customer']['email'];
					$orderCustomer['details']       = json_encode(
						array(
							'shipping' => $orderDetails['shipping'],
							'billing'  => $orderDetails['billing'],
						)
					);
					$orderCustomer->save();

				} catch ( Exception $exp ) {
				}

				//save order products
				if ( !empty($userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['variant']['id']) ) {
					$variant_details = array(
						'id'	=> $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['variant']['id'],
						'name'	=> $userOrder['cart']['products'][ count( $userOrder['cart']['products'] ) - 1 ]['variant']['title']
					);
				} else {
					$variant_details = array();
				}

				$orderProduct                 = new OrderProducts();
				$orderProduct['order_id']     = $order->id;
				$orderProduct['product_id']   = $orderDetails['product']['id'];
				$orderProduct['variant_details']   = json_encode($variant_details);
				$orderProduct['product_name'] = $orderDetails['product']['title'];
				$orderProduct['product_type'] = 'manual';
				$orderProduct['status']       = true;
				$orderProduct->save();

				if ( ! empty( $bump ) ) {

					$order                 = new Order;
					$order->user_id        = $savedPayment['user_id']; //
					$order->page_id        = $savedPayment['page_id'];
					$order->customer_email = $orderDetails['customer']['email'];
					$order->amount         = $bump['price'];
					$order->save();

					//save order details
					$newOrderDetails           = new OrderDetail();
					$newOrderDetails->order_id = $order->id;
					$newOrderDetails->type     = 'stripe';
					$newOrderDetails->details  = json_encode( $manualDetails );
					$newOrderDetails->save();

					$orderProduct                 = new OrderProducts();
					$orderProduct['order_id']     = $order->id;
					$orderProduct['product_id']   = $bump['id'];
					$orderProduct['variant_details']   = json_encode(array());
					$orderProduct['product_name'] = $bump['name'];
					$orderProduct['product_type'] = 'manual';
					$orderProduct['status']       = true;
					$orderProduct->save();
				}

				//save customer order info for confirmation page
				Session::put( 'product_order_info', $orderDetails );
				Session::save();
// dd($result);
				return $result;
			}

			/*Session::flash('alert', 'Funds Loaded Successfully!');
			Session::flash('alertClass', 'success');
			return redirect('/payment/add-funds/paypal');*/
		}

		//remove product details from current cart
		Session::forget( 'product_current_cart' );
		Session::save();

		/*Session::flash('alert', 'Unexpected error occurred & payment has been failed.');
		Session::flash('alertClass', 'danger no-auto-close');
		return redirect('/payment/add-funds/paypal');*/
		/*} catch (Exception $ex) {
			return array(
				'error' => $ex->getMessage()
			);
		}*/
		/*} catch (Exception $ex) {
			return array(
				'error' => $ex->getMessage()
			);
		}*/

	}


	private function getNextFunnelPage( $current_page_id ) {

		$page  = Page::find( $current_page_id );
		$steps = FunnelStep::where( 'funnel_id', $page->funnel_id )->orderBy( 'order_position', 'asc' )->get();
		//$pages = Page::where('funnel_id', $page->funnel_id)->orderBy('order_position', 'asc')->get();

		$flag = false;

		foreach ( $steps as $funnelStep ) {

			if ( $flag ) {
				break;
			}

			if ( $funnelStep->id == $page->funnel_step_id ) {
				$flag = true;
				continue;
			}
		}

		$funnelPage = Page::where( 'funnel_step_id', $funnelStep->id )->first();

		//get the next page
		/*foreach ( $pages as $funnelPage ) {

			if ( $flag )
				break;

			if ( $funnelPage->id == $page->id ) {
				$flag = true;
				continue;
			}
		}*/

		return $funnelPage;
	}


	////////////////////////////////////////////// REQUESTS /////////////////////////////////////////////


	private function makePostRequest( $url, $data = null, $auth = null ) {

		try {
			$ch          = curl_init( $url );
			$data_string = json_encode( $data );

			if ( false === $ch ) {
				throw new Exception( 'failed to initialize' );
			}

			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen( $data_string )
			) );
			curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );

			$output = curl_exec( $ch );

			if ( false === $output ) {
				throw new Exception( curl_error( $ch ), curl_errno( $ch ) );
			} else {
				return $output;
			}

			// ...process $output now
		} catch ( Exception $e ) {

			trigger_error( sprintf(
				'Curl failed with error #%d: %s',
				$e->getCode(), $e->getMessage() ),
				E_USER_ERROR );
		}

		return false;
	}


	private function makeStripePostRequest( $url, $data = null, $auth = null, $card = null ) {

		try {
			$ch = curl_init( $url );
			//$data_string = json_encode($data);

			$data_string = "";

			if ( ! empty( $card ) ) {
				foreach ( $data['card'] as $key => $val ) {
					$data_string .= "card[" . $key . "]=" . $val . "&";
				}
			} else {
				foreach ( $data as $key => $val ) {
					$data_string .= $key . "=" . $val . "&";
				}

				//print_r($data_string); die;
			}

			$data_string = trim( $data_string, '&' );


			if ( false === $ch ) {
				throw new Exception( 'failed to initialize' );
			}

			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			if ( $auth !== null ) {
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
					'Authorization: ' . $auth,
					'Content-Type: application/x-www-form-urlencoded',
					'Content-Length: ' . strlen( $data_string )
				) );
			} else {
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/x-www-form-urlencoded',
					'Content-Length: ' . strlen( $data_string )
				) );
			}
			curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );

			$output = curl_exec( $ch );

			if ( false === $output ) {
				throw new Exception( curl_error( $ch ), curl_errno( $ch ) );
			} else {
				return $output;
				//$this->data = $output;
			}

			// ...process $output now
		} catch ( Exception $e ) {

			trigger_error( sprintf(
				'Curl failed with error #%d: %s',
				$e->getCode(), $e->getMessage() ),
				E_USER_ERROR );
		}

		return false;
	}


	private function makePaypalPostRequest( $url, $data = null, $auth = null, $card = null ) {

		try {
			$ch = curl_init( $url );
			//$data_string = json_encode($data);

			$data_string = "";

			if ( ! empty( $card ) ) {
				foreach ( $data['card'] as $key => $val ) {
					$data_string .= "card[" . $key . "]=" . $val . "&";
				}
			} else {
				foreach ( $data as $key => $val ) {
					$data_string .= $key . "=" . $val . "&";
				}

				//print_r($data_string); die;
			}

			$data_string = trim( $data_string, '&' );


			if ( false === $ch ) {
				throw new Exception( 'failed to initialize' );
			}

			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			if ( $auth !== null ) {
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
					'Authorization: ' . $auth,
					'Content-Type: application/x-www-form-urlencoded',
					'Content-Length: ' . strlen( $data_string )
				) );
			} else {
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/x-www-form-urlencoded',
					'Content-Length: ' . strlen( $data_string )
				) );
			}
			curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );

			$output = curl_exec( $ch );

			if ( false === $output ) {
				throw new Exception( curl_error( $ch ), curl_errno( $ch ) );
			} else {
				return $output;
				//$this->data = $output;
			}

			// ...process $output now
		} catch ( Exception $e ) {

			trigger_error( sprintf(
				'Curl failed with error #%d: %s',
				$e->getCode(), $e->getMessage() ),
				E_USER_ERROR );
		}

		return false;
	}


	private function initializeAuth( $request ) {
		$funnel          = Funnel::find( $request->input( 'funnel_id' ) );
		$userIntegration = UserIntegration::where( 'user_id', $funnel->user_id )->where( 'service_type', 'shopify' )->first();
		$this->shop      = json_decode( $userIntegration->details );

		$this->api_key      = $this->shop->api_key;
		$this->api_password = $this->shop->password;
		$this->secret       = $this->shop->shared_secret;
		$this->store        = $this->shop->name;
	}


	private function initializePaypalAuth( $request ) {
		$funnel          = Funnel::find( $request->input( 'funnel_id' ) );
		$userIntegration = UserIntegration::where( 'user_id', $funnel->user_id )->where( 'service_type', 'shopify' )->first();
		$this->shop      = json_decode( $userIntegration->details );

		$this->api_key      = $this->shop->api_key;
		$this->api_password = $this->shop->password;
		$this->secret       = $this->shop->shared_secret;
		$this->store        = $this->shop->name;
	}
}