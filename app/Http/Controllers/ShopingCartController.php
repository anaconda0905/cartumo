<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Order;
use App\Models\Funnel;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\FunnelType;
use App\Models\FunnelStep;
use App\Models\PageVisitor;
use App\Models\StepProduct;
use App\Models\FunnelUpload;
use App\Models\ProductOption;
use App\Models\UserIntegration;
use App\Models\PageScreenshoot;
use App\Models\UserPaymentGateway;
use App\Models\UserSmtpSetting;

use App\Library\CAweber as CAweber;
use App\Library\urltopng as UrlToPng;

use View;
use Session;
use Mail;
use Storage;
use PHPMailer\PHPMailer\PHPMailer;

use App\Mail\FunnelStepEmailIntegration;

class ShopingCartController extends Controller {
	public function __construct() {
		/*print_r($_POST[]);
        print_r($_GET[]);
        die;*/
	}

	/*public function sendEmail($data = array()) {

        $to = $data['to'];
        $msg = $data['message'];
        $subject = $data['subject'];

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $header .= "FROM: Cartumo <info@inubaan.com>\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <info@inubaan.com>' . "\r\n";

        // send email
        mail($to, $subject, $msg, $headers);

        //print_r($data);
   }*/


	/*
	 * URl will be skip for Upsell or Downsell
	 */
	public function skipStepsUrl( Request $request, $url_type ) {

		//echo $url_type; die;
		//print_r($request->all());

		$page       = Page::find( $request->input( 'page_id' ) );
		$funnelStep = FunnelStep::find( $page->funnel_step_id );
		$nextStep   = FunnelStep::where( 'funnel_id', $funnelStep->funnel_id )
		                        ->where( 'order_position', '>', $funnelStep->order_position )
		                        ->where( 'type', '<>', $funnelStep->type )
		                        ->first();
		$nextPage   = Page::where( 'funnel_step_id', $nextStep->id )
		                  ->first();

		echo json_encode(
			array(
				'url' => route( 'page.view', $nextPage->slug )
			)
		);
	}

	public function sendEmail( $data = array(), $user_id ) {

		/*$to      = $data['to'];
		$msg     = $data['message'];
		$subject = $data['subject'];
		$content = [
			'title'  => $subject,
			'body'   => $data['message'],
			'button' => 'Click Here'
		];

		$receiverAddress = $to;
		Mail::to( $receiverAddress )->send( new FunnelStepEmailIntegration( $content ) );*/

		//get funnel user's mail server details
		$userSmtpSetting = UserSmtpSetting::where( 'user_id', $user_id )->first();

		if ( ! empty( $userSmtpSetting ) ) {
			$phpMailer = new PHPMailer();

			try {
				$phpMailer->isSMTP(); // tell to use smtp
				$phpMailer->CharSet    = "utf-8"; // set charset to utf8
				$phpMailer->SMTPAuth   = true;  // use smpt auth
				$phpMailer->SMTPSecure = "tls"; // or ssl
				$phpMailer->Host       = $userSmtpSetting->smtp_server;
				$phpMailer->Port       = $userSmtpSetting->smtp_port; // most likely something different for you. This is the mailtrap.io port i use for testing.
				$phpMailer->Username   = $userSmtpSetting->smtp_user;
				$phpMailer->Password   = $userSmtpSetting->smtp_password;
				$phpMailer->setFrom( $userSmtpSetting->form_email, $userSmtpSetting->form_name );
				$phpMailer->Subject = $data['subject'];
				$phpMailer->MsgHTML( $data['message'] );
				$phpMailer->addAddress( $data['to'] );
				$phpMailer->send();
			} catch ( phpmailerException $e ) {
				dd( $e );
			} catch ( Exception $e ) {
				dd( $e );
			}
		}
	}

	public function index( $slug = null ) {

		$funnel = Funnel::where( 'slug', $slug )->first();

		if ( ! empty( $funnel ) ) {

			$step = FunnelStep::where( 'funnel_id', $funnel->id )->orderBy( 'order_position' )->first();
				// dd($step);
			if ( ! empty( $step ) ) {
				$page = Page::where( 'funnel_step_id', $step->id )->first();
				// dd($page);
				return redirect()->route( "page.view", ( ! empty( $page->slug ) ) ? $page->slug : $page->id );
			}
		}
	}


	public function optinSave( Request $request ) {

		//echo '<pre>'; print_r($_POST); die;

		//check integration
		if ( ! empty( $request->input( 'step_id' ) ) ) {

			//get the step's integration
			$stepProduct = FunnelStep::find( $request->input( 'step_id' ) );
			$details     = ( ! empty( $stepProduct->details ) ) ? json_decode( $stepProduct->details ) : array();

			if ( ! empty( $details ) ) {

				if ( ( ! empty( $details->integration ) ) ) {

					$userIntegration    = UserIntegration::find( $details->integration->integration_id );
					$integrationDetails = json_decode( $userIntegration->details );

					if ( ! empty( $request->input( 'integration' ) ) ) {
						foreach ( $request->input( 'integration' ) as $key => $value ) {
							$data[ $key ] = $value[ $key ];
						}
					} else {
						$data = array(
							'email'      => $request->input( 'email' ),
							'first_name' => $request->input( 'billing' )['first_name'],
							'last_name'  => $request->input( 'billing' )['last_name']
						);
					}

					//echo '---' . print_r($data); die;

					//send
					if ( $details->integration->type == 'mailchimp' ) {
						$this->makeMailchimpList( $data, $integrationDetails->apikey, $details->integration->list_id );
					} elseif ( $details->integration->type == 'zoho' ) {
						$this->makeZohoList( $data, [
							'email'    => $integrationDetails->email,
							'password' => $integrationDetails->password
						] );
					}
				}
			}
		}
	}


	public function processIntegrationData( Request $request ) {

		//echo '<pre>'; print_r($_POST); die;
		$integration_data = array();

		//check integration
		if ( ! empty( $request->input( 'step_id' ) ) ) {

			//get the step's integration
			$stepProduct = FunnelStep::find( $request->input( 'step_id' ) );
			$details     = ( ! empty( $stepProduct->details ) ) ? json_decode( $stepProduct->details ) : array();

			if ( ! empty( $details ) ) {

				if ( ( ! empty( $details->integration ) ) ) {

					$userIntegration    = UserIntegration::find( $details->integration->integration_id );
					$integrationDetails = json_decode( $userIntegration->details );

					if ( ! empty( $request->input( 'integration' ) ) ) {
						foreach ( $request->input( 'integration' ) as $key => $value ) {
							$integration_data[ $key ] = $value;
						}
					} else {
						$integration_data = array(
							'email'      => $request->input( 'email' ),
							'first_name' => $request->input( 'billing' )['first_name'],
							'last_name'  => $request->input( 'billing' )['last_name']
						);
					}

					//echo '<pre>'; print_r($integration_data); die;

					//send
					if ( $details->integration->type == 'mailchimp' ) {
						$result = $this->makeMailchimpList( $integration_data, $integrationDetails->apikey, $details->integration->list_id );
					} elseif ( $details->integration->type == 'zoho' ) {
						$result = $this->makeZohoList( $integration_data, [
							'email'    => $integrationDetails->email,
							'password' => $integrationDetails->password
						] );
					} elseif ( $details->integration->type == 'aweber' ) {
						//$this->makeZohoList($integration_data, ['email'=>$integrationDetails->email, 'password'=>$integrationDetails->password]);
						$CAweber = new CAweber();
						$result  = $CAweber->addNewSubscriber( $integrationDetails, $integration_data, $details );
					}

					die(
					json_encode(
						array(
							'status' => 'success',
							'result' => $result
						)
					)
					);
				}
			} else {
				echo "No Integration";
			}
		} else {
			die(
			json_encode(
				array(
					'status'  => 'error',
					'message' => 'Something is wrong! Please try after sometime.'
				)
			)
			);
		}
	}


	public function productCheckout( Request $request ) {

		//echo '<pre>'; print_r($_POST); die;

		$data['cart'] = array();

		$funnelStep  = FunnelStep::find( $request->input( 'step_id' ) );
		$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();


		if ( $stepProduct->product_type == 'manual' ) {
			$product = Product::find( json_decode( $stepProduct->details )->product_id );

			if ( ! empty( $request->input( 'hid_product_variant_id' ) ) ) {
				$product_variant = ProductOption::find( $request->input( 'hid_product_variant_id' ) );
			} else {
				$product_variant = ProductOption::where( 'product_id', $product->id )->first();
			}

			$variant_title = "";
			//$variant_match = app( 'App\Http\Controllers\ProductController' )->findMatch( $request, $paymentGateway );

			if ( ( ! empty( $product_variant->options ) ) ) {
				foreach ( json_decode( $product_variant->options ) as $key => $option ) {

					if ( $key == 'price' ) {
						break;
					}

					$variant_title = $option . ',';
				}

				$variant_title = trim( $variant_title, ',' );

				$image = json_decode( $product->images );

				//Prepare the cart info
				$data['cart'] = array(
					'products'  => array(
						array(
							'product_id' => $product->id,
							'title'      => $product->name,
							'image'      => ( ! empty( $image ) ) ? $image->main : '',
							'variant'    => [
								'id'      => $product_variant->id,
								'title'   => $variant_title,
								'details' => json_decode( $product_variant->options ),
								'image'   => $product_variant->image
							],
							'quantity'   => $request->input( 'product_quantity' ),
							'price'      => [
								'$' . number_format( json_decode( $product_variant->options )->price, 2 ),
								number_format( json_decode( $product_variant->options )->price, 2 )
							],
							'total'      => [
								'$' . number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 ),
								number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 )
							]
						)
					),
					'sub_total' => [
						'$' . number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 ),
						number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 )
					],
					'shipping'  => [ 'title' => 'Free', 'amount' => 0.00 ],
					'total'     => [
						'$' . number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 ),
						number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 )
					]
				);
			} else {

				$image = json_decode( $product->images );

				//Prepare the cart info
				$data['cart'] = array(
					'products'  => array(
						array(
							'product_id' => $product->id,
							'title'      => $product->name,
							'image'      => ( ! empty( $image ) ) ? $image->main : '',
							'variant'    => array(),
							'quantity'   => $request->input( 'product_quantity' ),
							'price'      => [
								'$' . number_format( $product->price, 2 ),
								number_format( $product->price, 2 )
							],
							'total'      => [
								'$' . number_format( $product->price * $request->input( 'product_quantity' ), 2 ),
								number_format( $product->price * $request->input( 'product_quantity' ), 2 )
							]
						)
					),
					'sub_total' => [
						'$' . number_format( $product->price * $request->input( 'product_quantity' ), 2 ),
						number_format( $product->price * $request->input( 'product_quantity' ), 2 )
					],
					'shipping'  => [ 'title' => 'Free', 'amount' => 0.00 ],
					'total'     => [
						'$' . number_format( $product->price * $request->input( 'product_quantity' ), 2 ),
						number_format( $product->price * $request->input( 'product_quantity' ), 2 )
					]
				);
			}

		} else {
			//Get the product
			$product = $this->getShopifyProduct( json_decode( $stepProduct->details )->product_id, $request );

			//Get the variant
			$product_variant = null;
			$product_image   = null;

			foreach ( $product->product->variants as $variant ) {
				if ( $variant->id == $request->input( 'hid_product_variant_id' ) ) {
					$product_variant = $variant;

					foreach ( $product->product->images as $image ) {
						if ( $variant->image_id == $image->id ) {
							$product_image = $image->src;
							break;
						}
					}

					break;
				}
			}

			if ( empty( $product_variant ) ) {
				$product_variant = $product->product->variants[0];
			}

			//print_r($product_variant); die;

			//Prepare the cart info
			$data['cart'] = array(
				'products' => array(
					array(
						'product_id' => $product->product->id,
						'title'      => $product->product->title,
						'image'      => $product->product->image->src,
						'variant'    => [
							'id'      => $product_variant->id,
							'title'   => $product_variant->title,
							'details' => $product_variant,
							'image'   => $product_image
						],
						'quantity'   => $request->input( 'product_quantity' ),
						'price'      => [
							'$' . number_format( $product_variant->price, 2 ),
							number_format( $product_variant->price, 2 )
						],
						'total'      => [
							'$' . number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 ),
							number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 )
						]
					)
				),

				'sub_total' => [
					'$' . number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 ),
					number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 )
				],
				'shipping'  => [ 'title' => 'Free', 'amount' => 0.00 ],
				'total'     => [
					'$' . number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 ),
					number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 )
				]
			);
		}

		$next_url = $this->getNextStep( $request->input( 'page_id' ) );

		//print_r($data['cart']); die;

		Session::put( 'product_checkout_product', $data );

		if ( ! empty( $next_url ) ) {
			Session::put( 'product_cart', $data );
			Session::save();

			//create session for per order
			Session::put( 'product_current_cart', $data );
			Session::save();

			echo json_encode(
				array(
					'status' => 'success',
					'url'    => $next_url
				)
			);
		} else {
			echo json_encode(
				array(
					'status'  => 'error',
					'message' => 'Something is going wrong!'
				)
			);
		}

		die;
	}


	public function store( Request $request ) {

		//echo '<pre>'; print_r($_POST); die;
		//echo '<pre>'; print_r(Session::all()); die;

		$page = Page::find( $request->input( 'page_id' ) );
		//echo '<pre>'; print_r($request->input( 'step_id' )); die;
		$funnelStep = FunnelStep::find( $page->funnel_step_id );
		$funnel     = Funnel::find( $funnelStep->funnel_id );
		$funnelType = FunnelType::find( $funnelStep->type );

		// echo strtolower($funnelType->name);
		//echo '<pre>'; print_r(Session::get('save_payment')); die;

		switch ( strtolower( $funnelType->name ) ) {

			case 'sales':
				$step       = $this->getStep( $page, 'upsell', 'downsell' );
				$funnelStep = FunnelStep::find( $page->funnel_step_id );
				//$this->updateProductCart($request, $funnelStep);
				break;

			case 'upsell':
				$step       = $this->getStep( $page, 'downsell', 'confirmation' );
				$funnelStep = FunnelStep::find( $page->funnel_step_id );
				$this->updateProductCart( $request, $funnelStep );
				break;

			case 'downsell':
				$step       = $this->getStep( $page, 'confirmation' );
				$funnelStep = FunnelStep::find( $page->funnel_step_id );
				$this->updateProductCart( $request, $funnelStep );
				break;

			case 'order':
				$this->saveOrderInfo( $request );

			default:
				$step = $this->getStep( $page );
				break;
		}

		//echo '<pre>'; print_r(Session::get('save_payment')); die;

		//echo '<pre>'; print_r(Session::get('product_cart')); die;
		//Payment
		//$paymentGateway = UserPaymentGateway::find( $funnel->payment_gateway );
		//echo "==" . Session::has( 'save_payment' ); die;
		if ( ! empty( $request->input( 'payment_selection' ) ) ) {
			if ( strtolower( $request->input( 'payment_selection' ) ) == 'credit_card' ) {
				$paymentGateway = UserPaymentGateway::where( 'user_id', $funnel->user_id )
				                                    ->where( 'type', 'stripe' )->first();
			} else {
				$paymentGateway = UserPaymentGateway::where( 'user_id', $funnel->user_id )
				                                    ->where( 'type', 'paypal' )->first();
			}
		} else {
			//echo '<pre>'; print_r(Session::get( 'saved_payment' )); die;
			$savedPaymentMethod = Session::get( 'saved_payment' );
			if ( strtolower( $savedPaymentMethod['payment_selection'] ) == 'credit_card' ) {
				$paymentGateway = UserPaymentGateway::where( 'user_id', $funnel->user_id )
				                                    ->where( 'type', 'stripe' )->first();
			} else {
				$paymentGateway = UserPaymentGateway::where( 'user_id', $funnel->user_id )
				                                    ->where( 'type', 'paypal' )->first();
			}
		}

		//echo '<pre>'; print_r($paymentGateway); die;


		if ( $funnel->type == 'shopify' ) {

			if ( Session::has( 'product_current_cart' ) ) {

				//new PaymentController()->makeShopifyPayment();

				//echo "==="; print_r(Session::get( 'save_payment' )); die;

				if ( ! empty( $request->input( 'payment_selection' ) ) ) {

					if ( $request->input( 'payment_selection' ) == 'credit_card' ) {
						//echo '<pre>'; print_r($_POST); die;
						$orderPayment = app( 'App\Http\Controllers\PaymentController' )->makeShopifyPayment( $request, $paymentGateway );
					} else {
						$paypal_data = app( 'App\Http\Controllers\PaymentController' )->makeShopifyPaymentPaypal( $request, $paymentGateway );
					}

				} else {
					$savePayment = Session::get( 'saved_payment' );

					//echo "==="; print_r($savePayment['payment_selection']); die;

					if ( $savePayment['payment_selection'] == 'credit_card' ) {
						$orderPayment = app( 'App\Http\Controllers\PaymentController' )->makeShopifyPayment( $request, $paymentGateway, $savePayment );
					} else {
						$paypal_data = app( 'App\Http\Controllers\PaymentController' )->makeShopifyPaymentPaypal( $request, $paymentGateway, $savePayment );
					}
				}

				//$orderPayment = app('App\Http\Controllers\PaymentController')->makeShopifyPayment($request, $paymentGateway);

				if ( ! empty( $orderPayment ) ) {
					if ( ( ! empty( $orderPayment['type'] ) ) ) {
						$paypal_data = $orderPayment;
					} else {
						if ( ! Session::has( 'saved_payment' ) ) {
							Session::put( 'saved_payment', $orderPayment );
							Session::save();
						}
					}
				}
			}

		} else {
			// dd(Session::get('payment_type_selection'));

			if ( Session::has( 'payment_type_selection' ) ) {
				$payment_type_selection = Session::get( 'payment_type_selection' );
			} else {
				$payment_type_selection = $request->input( 'payment_selection' );
				Session::put( 'payment_type_selection', $payment_type_selection );
				Session::save();
			}

			//if ( $funnel->payment_gateway == 'both' ) {

			if ( $payment_type_selection == 'credit_card' ) {
				$paymentGateway = UserPaymentGateway::where( 'user_id', $funnel->user_id )
				                                    ->where( 'type', 'stripe' )
				                                    ->first();
				$payment_status = app( 'App\Http\Controllers\PaymentController' )->makeStripePayment( $request, $paymentGateway );
			} else {
				$paymentGateway = UserPaymentGateway::where( 'user_id', $funnel->user_id )
				                                    ->where( 'type', 'paypal' )
				                                    ->first();
				//echo $paymentGateway;
                // dd($paymentGateway);
				$paypal_data = app( 'App\Http\Controllers\PaymentController' )->makePaypalRedirectPayment( $request, $paymentGateway );
			}
			//}


			/*if ( $paymentGateway->type == 'stripe' ) {
                $payment_status = app('App\Http\Controllers\PaymentController')->makeStripePayment($request, $paymentGateway);
            } else {
                if ( $request->input('payment_selection') == 'paypal' ) {
                    $paypal_data = app('App\Http\Controllers\PaymentController')->makePaypalRedirectPayment($request, $paymentGateway);
                    //print_r($paypal_data); die;
                } else {
                    $paymentGateway = UserPaymentGateway::where('user_id', $request->input('frm_hid_user_id'))
                                                        ->where('type', 'stripe')
                                                        ->first();
                    $payment_status = app('App\Http\Controllers\PaymentController')->makeStripePayment($request, $paymentGateway);
                }
            }*/ /* elseif ( $paymentGateway->type == 'paypal' ) {
                if ( $request->input('payment_selection') == 'paypal' ) {
                    $paypal_data = app('App\Http\Controllers\PaymentController')->makePaypalRedirectPayment($request, $paymentGateway);
                    //print_r($paypal_data); die;
                } else {
                    $paymentGateway = UserPaymentGateway::where('user_id', $request->input('frm_hid_user_id'))
                                                        ->where('type', 'stripe')
                                                        ->first();
                    $payment_status = app('App\Http\Controllers\PaymentController')->makeStripePayment($request, $paymentGateway);
                }
            }*/
		}

		//save post data if email has used in confirmation
		if ( ! Session::has( 'request_session' ) ) {
			Session::put( 'request_session', $_POST );
			Session::save();
		}


		//check integration / email
		if ( ! empty( $request->input( 'step_id' ) ) ) {

			//get the step's integration
			$stepProduct = FunnelStep::find( $request->input( 'step_id' ) );
			$details     = ( ! empty( $stepProduct->details ) ) ? json_decode( $stepProduct->details ) : array();

			if ( ! empty( $details ) ) {

				if ( ( ! empty( $details->integration ) ) ) {

					$userIntegration    = UserIntegration::find( $details->integration->integration_id );
					$integrationDetails = json_decode( $userIntegration->details );

					if ( ! empty( $request->input( 'integration' ) ) ) {
						foreach ( $request->input( 'integration' ) as $key => $value ) {
							$data[ $key ] = $value[ $key ];
						}
					} else {
						$data = array(
							'email'      => $request->input( 'email' ),
							'first_name' => $request->input( 'billing' )['first_name'],
							'last_name'  => $request->input( 'billing' )['last_name']
						);
					}

					//send
					/*if ( $details->integration - type == 'mailchimp' ) {
						$this->makeMailchimpList( $data, $integrationDetails->apikey, $details->integration->list_id );
					} elseif ( $details->integration - type == 'zoho' ) {
						$this->makeZohoList( $data, [
							'email'    => $integrationDetails->email,
							'password' => $integrationDetails->password
						] );
					}*/
					if ( $details->integration->type == 'mailchimp' ) {
						$result = $this->makeMailchimpList( $data, $integrationDetails->apikey, $details->integration->list_id );
					} elseif ( $details->integration->type == 'zoho' ) {
						$result = $this->makeZohoList( $data, [
							'email'    => $integrationDetails->email,
							'password' => $integrationDetails->password
						] );
					}
				} elseif ( ( ! empty( $details->email ) ) ) {

					/*$contents        = json_decode( $details->email->content )->htmlbody;
					$data            = array();
					$data['to']      = $request->input( 'email' );
					$data['subject'] = ( ! empty( $details->email->subject ) ) ? $details->email->subject : $funnel->name;
					$data['message'] = $contents;*/

					$data            = array();
					$data['to']      = $request->input( 'email' );
					$data['subject'] = $details->email->subject;
					$data['message'] = $details->email->message;

					$this->sendEmail( $data, $funnel->user_id );
				}
			}
		}

		//print_r($paypal_data); die;
		if ( ! empty( $paypal_data ) ) {

			die( json_encode(
				array(
					'status' => 'success',
					'url'    => $paypal_data['url']
				)
			) );
		} elseif ( ! empty( $payment_status ) ) {

			if ( ! empty( $payment_status['error'] ) ) {
				die( json_encode(
					array(
						'status'  => 'error',
						'message' => $payment_status['error']
					)
				) );
			} else {
				if ( $step != null ) {

					$stepPage = Page::where( 'funnel_step_id', $step->id )->first();
					//$stepPage = Page::find($stepPage->id);

					die( json_encode(
						array(
							'status' => 'success',
							'url'    => route( 'page.view', ( ! empty( $stepPage->slug ) ) ? $stepPage->slug : $stepPage->id )
						)
					) );
				} else {

					die( json_encode(
						array(
							'status' => 'success',
							'url'    => '#'
						)
					) );
				}
			}

		} else {
			if ( $step != null ) {

				$stepPage = Page::where( 'funnel_step_id', $step->id )->first();
				//$stepPage = Page::find($stepPage->id);

				die( json_encode(
					array(
						'status' => 'success',
						'url'    => route( 'page.view', ( ! empty( $stepPage->slug ) ) ? $stepPage->slug : $stepPage->id )
					)
				) );
			} else {

				die( json_encode(
					array(
						'status' => 'success',
						'url'    => '#'
					)
				) );
			}
		}
	}


	/////////////////////////////// MAILCHIMP INTEGRATION ///////////////////////
	private function makeMailchimpList( $data, $apiKey, $listID ) {

		//print_r($data); die;

		if ( ! empty( $data['email'] ) ) {
			$email = $data['email'];
		} elseif ( ! empty( $data['email_address'] ) ) {
			$email = $data['email_address'];
		}
		//$email = (!empty($data['email'])) ? $data['email'] : (!empty($data['email_address'])) ? $data['email_address'] : '';

		// MailChimp API URL
		$memberID   = md5( strtolower( $email ) );
		$dataCenter = substr( $apiKey, strpos( $apiKey, '-' ) + 1 );
		$url        = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
		$result     = array();

		if ( ! empty( $email ) ) {
			// member information
			$json = json_encode( [
				'email_address' => $email,
				'status'        => 'subscribed',
				'merge_fields'  => [
					'FNAME' => ( ! empty( $data['first_name'] ) ) ? $data['first_name'] : "",
					'LNAME' => ( ! empty( $data['last_name'] ) ) ? $data['last_name'] : "",
				]
			] );

			// send a HTTP POST request with curl
			$ch = curl_init( $url );
			curl_setopt( $ch, CURLOPT_USERPWD, 'user:' . $apiKey );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ] );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );
			$result   = curl_exec( $ch );
			$httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
			curl_close( $ch );
		}

		return json_decode( $result );
	}

	private function makeZohoList( $data, $params ) {

		//print_r($_POST);
		//print_r($params);

		$zoho = new ZohoIntegration( $params['email'], $params['password'] );


		if ( Session::has( 'zoho_auth_token' ) && ( ! empty( Session::get( 'zoho_auth_token' ) ) ) ) {
			print_r( Session::get( 'zoho_auth_token' ) );
			$auth = Session::get( 'zoho_auth_token' );
		} else {
			$auth = $zoho->getAuth();
			Session::put( 'zoho_auth_token', $auth );
			Session::save();
		}

		//$auth = $zoho->getAuth();
		//echo $auth;
		//$result = $zoho->postData($auth, $data['name'],'XXTEST', 'lol@lol.dk','adresse','by','postr','Danmark','Some comment');
		$alldata = array();
		/*foreach ( $data as $d ) {
            $alldata[] = $d;
        }*/
		// print_r($alldata);
		$result = $zoho->postData( $auth, $data );
		$xml    = simplexml_load_string( $result );
		//print_r( $xml );

		if ( $xml->error->message == 'Invalid Ticket Id' ) {
			$auth   = $zoho->getAuth();
			$result = $zoho->postData( $auth, $data );
			//print_r( $result );
		}
	}


	//////////////////////////////////////////////////////////////////////////////


	/*private function getNextStep( $page_id ) {

		$page       = Page::find( $page_id );
		$funnelType = FunnelType::find( $page->funnel_step_id );

		$funnelSteps = FunnelStep::where( 'funnel_id', $page->funnel_id )->orderBy( 'order_position', 'asc' )->get();
		//echo $funnelSteps; die;
		$stepFlag = false;

		//get the next step
		foreach ( $funnelSteps as $key => $step ) {

			if ( $stepFlag ) {
				break;
			}

			if ( $step->id == $page->funnel_step_id ) {
				$stepFlag = true;
			}
		}

		//echo $step;

		//get the next step's page template
		$page = Page::where( 'funnel_step_id', $step->id )->where( 'funnel_id', $step->funnel_id )->first();

		//echo $page; die;

		if ( ! empty( $page ) ) {
			return route( 'page.view', ( ! empty( $page->slug ) ) ? $page->slug : $page->id );
		}
	}*/


	private function getNextStep( $page_id ) {

		$page           = Page::find( $page_id );
		$currentStep    = FunnelStep::where( 'id', $page->funnel_step_id )->first();
		$nextFunnelStep = FunnelStep::where( 'funnel_id', $page->funnel_id )
		                            ->where( 'order_position', '>', $currentStep->order_position )
		                            ->orderBy( 'order_position', 'asc' )
		                            ->first();

		//get the next step's page template
		$page = Page::where( 'funnel_step_id', $nextFunnelStep->id )
		            ->where( 'funnel_id', $nextFunnelStep->funnel_id )
		            ->first();

		if ( ! empty( $page ) ) {
			return route( 'page.view', ( ! empty( $page->slug ) ) ? $page->slug : $page->id );
		}
	}


	public function getImageVarient( Request $request ) {
		$stepProduct = StepProduct::where( 'step_id', $request->input( 'step_id' ) )->first();

		if ( $stepProduct->product_type == 'manual' ) {
			$product = Product::find( json_decode( $stepProduct->details )->product_id );
			//$variants = $product->options;
			$variants = $product->options;

			$data = $this->findMatch( $request, $variants, 'manual', $product->id );

			if ( $data !== false ) {
				die(
				json_encode(
					array(
						'status'     => 'success',
						'image'      => $data[0],
						'available'  => ( $data[1] >= $request->input( 'quantity' ) ),
						'price'      => [ number_format( $data[2], 2 ), '$' . number_format( $data[2], 2 ) ],
						'variant_id' => $data[3]

					)
				)
				);
			} else {
				die(
				json_encode(
					array(
						'status'     => 'success',
						'available'  => ( $data[0] >= $request->input( 'quantity' ) ),
						'price'      => [ number_format( $data[1], 2 ), '$' . number_format( $data[1], 2 ) ],
						'variant_id' => $data[2]
					)
				)
				);
			}

		} else {
			$step            = FunnelStep::find( $request->input( 'step_id' ) );
			$funnel          = Funnel::find( $step->funnel_id );
			$userIntegration = UserIntegration::where( 'user_id', $funnel->user_id )->where( 'service_type', 'shopify' )->first();
			$data            = array();

			if ( ! empty( $userIntegration ) ) {

				$json = json_decode( $userIntegration->details );
				//$url = "https://" . $json->name . ".shopify.com/admin/products.json";

				$API_KEY      = $json->api_key;
				$API_PASSWORD = $json->password;
				$SECRET       = $json->shared_secret;
				$store_name   = $json->name;
				$product_id   = json_decode( $stepProduct->details )->product_id;

				$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/variants.json";

				$varients = json_decode( file_get_contents( $url ) );

				$data = $this->findMatch( $request, $varients, 'shopify', $product_id );
			}

			if ( $data !== false ) {

				//print_r($data); die;

				die(
				json_encode(
					array(
						'status'     => 'success',
						'image'      => $data[0],
						'available'  => $data[1],
						'price'      => [ number_format( $data[3], 2 ), '$' . number_format( $data[3], 2 ) ],
						'variant_id' => $data[2]
					)
				)
				);
			} else {
				die(
				json_encode(
					array(
						'status'     => 'success',
						'available'  => $data[1],
						'variant_id' => $data[2]
					)
				)
				);
			}
		}
	}


	public function show( $id = null ) {
		$data = array();

		// echo $id; die;

		if ( $id ) {
			$page                = Page::find( $id );
			$data['funnelStep']  = $funnelStep = FunnelStep::find( $page->funnel_step_id );
			$data['$funnelType'] = $funneltype = FunnelType::find( $funnelStep->type );

			//echo $funneltype->name; die;

			//echo '<pre>'; print_r(Session::all()); die;

			//echo "===" . print_r(Session::has('credit_card_details'));
			//print_r(Session::get('purchaded_products'));
			if ( strtolower( $funneltype->name ) == 'confirmation' ) {
				//print_r(Session::get('credit_card_details'));

				Session::forget( 'token_details' );
				Session::forget( 'shipping_details' );
				Session::forget( 'credit_card_details' );

				//echo '<pre>'; print_r(Session::all()); die;

				//echo '<pre>';print_r(Session::get('purchaded_products'));echo '</pre>';
			} elseif ( strtolower( $funneltype->name ) == 'order' ) {

				//print_r(Session::all());

				if ( Session::has( 'product_cart' ) ) {

					$pdata = Session::get( 'product_cart' );

					//echo '<pre>'; print_r($pdata); die;

					$data['product'] = Product::find( $pdata['cart']['products'][0]['product_id'] );
				}

				//fetch product details from previous page
				$step = $this->getPreviousStep( $page->funnel_id, $page->funnel_step_id );
				//echo $step;
				$stepProduct = StepProduct::where( 'funnel_id', $page->funnel_id )
				                          ->where( 'step_id', $step->id )
				                          ->first();

				//echo $stepProduct; die;
				$data['stepProduct'] = $stepProduct;
			}

			//$widgets = Widgets::getWidgetNames();

			//if( $page )
			//{
			$contents = json_decode( $page->content );
			$sty      = json_decode( $page->content );

			//print_r($contents); die;
			return view( "builder.page_template_view", [ "contents" => $contents, 'data' => $data, 'page' => $page ] );
			//}
		}
	}


	public function savePaypalDetails() {

		//
		//echo '<pre>'; print_r($_GET); print_r($_POST); echo '<pre>';

		//$this->showPage();
	}


	public function showPage( Request $request, $slug = null ) {
		// dd(Session::get('product_cart'));
		if ( ! empty( $request->input( 'paymentId' ) ) ) {

			$paymentStatus = app( 'App\Http\Controllers\PaymentController' )->afterPaypalPayment( $request );
			//echo '<pre>'; print_r($paymentStatus); echo "</pre>";
		}


		//echo $slug; die;
		$data = array();

		$page = Page::where( 'slug', $slug )->first();
		// dd($page);
		// echo $page; die;

		//$this->show($page->id);
		$funnel = Funnel::find( $page->funnel_id );
		// echo $funnel; die;
		$data['userPaymentGateway'] = UserPaymentGateway::where( 'user_id', $funnel->user_id )
		                                                ->where( 'type', 'stripe' )
		                                                ->first();


		$data['funnelStep']  = $funnelStep = FunnelStep::find( $page->funnel_step_id );
		$data['$funnelType'] = $funneltype = FunnelType::find( $funnelStep->type );

		//echo $funneltype->name; die;
		// dd($data);

		//echo '<pre>'; print_r(Session::all()); die;

		//echo "===" . print_r(Session::has('credit_card_details'));
		//print_r(Session::get('purchaded_products'));
		if ( strtolower( $funneltype->name ) == 'confirmation' ) {
			//print_r(Session::get('credit_card_details'));

			Session::forget( 'token_details' );
			Session::forget( 'shipping_details' );
			Session::forget( 'credit_card_details' );
			Session::forget( 'saved_payment' );
			Session::forget( 'payment_type_selection' );

			//clear sessions
			if ( Session::has( 'paypal_api_context' ) ) {
				Session::forget( 'paypal_api_context' );
			} //shopify_credentials

			if ( Session::has( 'shopify_credentials' ) ) {
				Session::forget( 'shopify_credentials' );
			}


			//Email for confirmation..
			if ( Session::has( 'request_session' ) ) {

				$post = Session::get( 'request_session' );

				//check integration / email
				if ( ! empty( $post['email'] ) ) {

					//get the step's integration
					//$funnelStep= FunnelStep::find($data['funnelStep']->id);
					$details = ( ! empty( $funnelStep->details ) ) ? json_decode( $funnelStep->details ) : array();

					if ( ! empty( $details ) ) {

						if ( ( ! empty( $details->email ) ) ) {

							$data1            = array();
							$data1['to']      = $post['email'];
							$data1['subject'] = $details->email->subject;
							$data1['message'] = $details->email->message;

							/*$contents        = json_decode( $details->email->content )->htmlbody;
							$data            = array();
							$data['to']      = $post['email'];
							$data['subject'] = ( ! empty( $details->email->subject ) ) ? $details->email->subject : $funnel->name;
							$data['message'] = $contents;*/

							//print_r($data);

							$this->sendEmail( $data1, $funnel->user_id );
						}
					}
				}

				//clear previous page's post data
				Session::forget( 'request_session' );
				Session::save();
			}


			//echo '<pre>'; print_r(Session::all()); die;

			//echo '<pre>';print_r(Session::get('purchaded_products'));echo '</pre>';
		} elseif ( strtolower( $funneltype->name ) == 'order' ) {

			//print_r(Session::all());

			if ( Session::has( 'product_cart' ) ) {

				$pdata = Session::get( 'product_cart' );

				//echo '<pre>'; print_r($pdata); die;

				$data['product'] = Product::find( $pdata['cart']['products'][0]['product_id'] );
			}

			//fetch product details from previous page
			$step = $this->getPreviousStep( $page->funnel_id, $page->funnel_step_id );
			//echo $step;
			$stepProduct = StepProduct::where( 'funnel_id', $page->funnel_id )
			                          ->where( 'step_id', $step->id )
			                          ->first();

			//echo $stepProduct; die;
			$data['stepProduct'] = $stepProduct;
		}

		//$widgets = Widgets::getWidgetNames();

		//if( $page )
		//{
		$contents = json_decode( $page->content );
		$sty      = json_decode( $page->content );
		// print_r($contents); die;

		//decide action
		if ( strtolower( $funneltype->name ) == 'product' ) {
			// dd('here');
			//echo "<pre>=="; print_r(Session::get('saved_payment')); die;

			//clear all the session on entry page
			Session::forget( 'token_details' );
			Session::forget( 'shipping_details' );
			Session::forget( 'credit_card_details' );
			Session::forget( 'saved_payment' );
			Session::forget( 'payment_type_selection' );

			//clear sessions
			if ( Session::has( 'paypal_api_context' ) ) {
				Session::forget( 'paypal_api_context' );
			} //shopify_credentials

			if ( Session::has( 'shopify_credentials' ) ) {
				Session::forget( 'shopify_credentials' );
			}

			//$request->session()->flush();

			$data['action'] = route( 'products.checkout' );
		} elseif ( ( strtolower( $funneltype->name ) == 'optin' ) || ( strtolower( $funneltype->name ) == 'order' ) || ( strtolower( $funneltype->name ) == 'upsell' ) || ( strtolower( $funneltype->name ) == 'downsell' ) || ( strtolower( $funneltype->name ) == 'sales' ) ) {
			$data['action'] = route( 'order.store' );
		} elseif ( strtolower( $funneltype->name ) == 'confirmation' ) {
			$data['action'] = route( 'order.store' );
		}
		// echo "<pre>";
		// print_r($page);
		// die;
		return view( "builder.page_template_view", [ "contents" => $contents, 'data' => $data, 'page' => $page ] );
		//}
	}


	public function addPageVisitor( Request $request ) {

		//Keep a record in database who visits
		$ip          = $this->getUserIP();
		$pageVisitor = PageVisitor::where( 'page_id', $request->input( 'page_id' ) )->where( 'ip_address', $ip )->first();
		if ( ( ! empty( $pageVisitor ) ) && $pageVisitor->count() > 0 ) {
			$pageVisitor = PageVisitor::find( $pageVisitor->id );
		} else {
			$pageVisitor = new PageVisitor();
		}

		$pageVisitor->page_id    = $request->input( 'page_id' );
		$pageVisitor->ip_address = $ip;
		$pageVisitor->visits     = $pageVisitor->visits + 1;
		$pageVisitor->save();
	}


	/////////////////////////////////////////////////////////////////////////////////
	private function findMatch( Request $request, $variants, $type = 'manual', $product_id = null ) {

		$found = false;

		$step   = FunnelStep::find( $request->input( 'step_id' ) );
		$funnel = Funnel::find( $step->funnel_id );

		//print_r($_POST);

		//$variantProduct = Product::find($product_id);
		//echo "==" . $product_id; die;

		if ( $type === 'manual' ) {
			$variantProduct  = Product::find( $product_id );
			$variant_options = json_decode( $variants->first() );
			//print_r(json_decode($variant_options->options)->options); die;

			if ( ! empty( $variant_options->options ) ) {

				$variant_options = json_decode( $variant_options->options, true )['options'];

				foreach ( $variants as $variant ) {

					$options = json_decode( $variant->options, true );

					if ( count( $request->input( 'product_options' ) ) == 3 ) {

						$option_1 = $this->str_custom_decode( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][0] ) ] );
						$option_2 = $this->str_custom_decode( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][1] ) ] );
						$option_3 = $this->str_custom_decode( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][2] ) ] );

						if ( ( strtolower( $option_1 ) == strtolower( $options[ strtolower( $variant_options['option_name'][0] ) ] ) ) && ( strtolower( $option_2 ) == strtolower( $options[ strtolower( $variant_options['option_name'][1] ) ] ) ) && ( strtolower( $option_3 ) == strtolower( $options[ strtolower( $variant_options['option_name'][2] ) ] ) ) ) {
							return [
								$variant->image,
								( $options['inventory'] > 0 ) ? $options['inventory'] : $variantProduct->quantity,
								( $options['price'] > 0 ) ? $options['price'] : $variantProduct->price,
								$variant->id
							];
						}
					} elseif ( count( $request->input( 'product_options' ) ) == 2 ) {
						//echo $options[ strtolower( $variant_options['option_name'][1] ) ]; die;

						//echo '<pre>'; print_r($request->input( 'product_options' )[ strtolower( $variant_options['option_name'][1] ) ]); die;

						$option_1 = $this->str_custom_decode( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][0] ) ] );
						$option_2 = $this->str_custom_decode( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][1] ) ] );

						//echo $option_1 . ', ' . $option_2; die;

						if ( ( strtolower( $option_1 ) == strtolower( $options[ strtolower( $variant_options['option_name'][0] ) ] ) ) && ( strtolower( $option_2 ) == strtolower( $options[ strtolower( $variant_options['option_name'][1] ) ] ) ) ) {
							return [
								$variant->image,
								( $options['inventory'] > 0 ) ? $options['inventory'] : $variantProduct->quantity,
								( $options['price'] > 0 ) ? $options['price'] : $variantProduct->price,
								$variant->id
							];
						}
					} else {
						$option_1 = $this->str_custom_decode( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][0] ) ] );
						if ( ( strtolower( $option_1 ) == strtolower( $options[ strtolower( $variant_options['option_name'][0] ) ] ) ) ) {
							return [
								$variant->image,
								( $options['inventory'] > 0 ) ? $options['inventory'] : $variantProduct->quantity,
								( $options['price'] > 0 ) ? $options['price'] : $variantProduct->price,
								$variant->id
							];
						}
					}
				}


			} else {
				$stepProduct = StepProduct::where( 'step_id', $step->id )->first();
				$product     = Product::find( json_decode( $stepProduct->details )->product_id );

				return [ json_decode( $product->images )->main, $product->quantity, $product->price ];
			}

		} else {

			$userIntegration = UserIntegration::where( 'user_id', $funnel->user_id )->where( 'service_type', 'shopify' )->first();


			if ( ! empty( $userIntegration ) ) {

				$json = json_decode( $userIntegration->details );
				//$url = "https://" . $json->name . ".shopify.com/admin/products.json";

				$API_KEY      = $json->api_key;
				$API_PASSWORD = $json->password;
				$SECRET       = $json->shared_secret;
				$store_name   = $json->name;

				//print_r($variants->variants); die;

				foreach ( $variants->variants as $variant ) {

					if ( $variant->title == $request->input( 'title' ) ) {
						$url           = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/images/" . $variant->image_id . ".json";
						$data['image'] = json_decode( file_get_contents( $url ) );

						//return [$data['image']->image->src, $variant->inventory_quantity, $variant->price];
						return [
							$data['image']->image->src,
							$variant->inventory_quantity,
							$variant->id,
							$variant->price
						];
					}
				}
			}
		}

		return false;
	}


	private function str_custom_decode( $str ) {
		$ustr = ucwords( str_replace( "_", " ", $str ) );

		return $ustr;
	}

	private function getPreviousStep( $funnel_id, $current_step_id ) {

		$steps   = FunnelStep::where( 'funnel_id', $funnel_id )->orderBy( 'order_position' )->get();
		$prestep = array();

		foreach ( $steps as $step ) {

			if ( $step->id == $current_step_id ) {
				break;
			}

			$prestep = $step;
		}

		return $prestep;
	}


	private function getShopifyProduct( $product_id, $request ) {

		//check whether the product id associate with the step

		//print_r($request->all()); die;

		$funnel = Funnel::find( $request->input( 'funnel_id' ) );

		$userIntegration = UserIntegration::where( 'user_id', $funnel->user_id )->where( 'service_type', 'shopify' )->first();
		$json            = json_decode( $userIntegration->details );

		$API_KEY      = $json->api_key;
		$API_PASSWORD = $json->password;
		$SECRET       = $json->shared_secret;
		$store_name   = $json->name;

		//https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

		//die($url);
		$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . ".json";

		return json_decode( file_get_contents( $url ) );
	}


	private function getFunnelNextStep( $page_id ) {

		$page           = Page::find( $page_id );
		$funnelStep     = FunnelStep::find( $page->funnel_step_id ); //order_position
		$nextFunnelStep = FunnelStep::where( 'funnel_id', $page->funnel_id )
		                            ->where( 'id', '!=', $page->funnel_step_id )
		                            ->where( 'order_position', '>', $funnelStep->order_position )
		                            ->orderBy( 'order_position' )
		                            ->first();

		//die($page->funnel_step_id);								

		//print_r($nextFunnelStep); die;

		return $nextFunnelStep;
	}

	private function getStep( $page, $type_name = null, $alternate_type_name = null ) {

		$funnelSteps = FunnelStep::where( 'funnel_id', $page->funnel_id )->orderBy( 'order_position', 'asc' )->get();
		$found       = false;

		if ( $type_name != null ) {
			foreach ( $funnelSteps as $step ) {

				//return next
				if ( $found ) {
					return $step;
				}

				$funnelType = FunnelType::find( $step->type );

				if ( ( strtolower( $funnelType->name ) == strtolower( $type_name ) ) ) {
					$found = true;

					return $step;
				}
			}

			if ( ! $found && $alternate_type_name != null ) {
				foreach ( $funnelSteps as $step ) {

					$funnelType = FunnelType::find( $step->type );

					if ( strtolower( $funnelType->name ) == strtolower( $alternate_type_name ) ) {
						$found = true;

						return $step;
					}
				}
			}

			if ( ! $found ) {
				foreach ( $funnelSteps as $step ) {

					$funnelType = FunnelType::find( $step->type );

					if ( strtolower( $funnelType->name ) == 'confirmation' ) {
						$found = true;

						return $step;
					}
				}
			}
		} else {
			$flag = false;
			foreach ( $funnelSteps as $step ) {

				if ( $flag ) {
					return $step;
				}

				//$funnelType = FunnelType::find($step->type);

				if ( $step->id == $page->funnel_step_id ) {
					$flag = true;
				}
			}
		}

		return null;
	}


	//Update Cart
	private function updateProductCart( Request $request, $funnelStep ) {
		if ( Session::has( 'product_cart' ) ) {
			$data['cart'] = Session::get( 'product_cart' )['cart'];
		} else {
			$data['cart'] = array();
		}

		if ( Session::has( 'product_current_cart' ) ) {
			//$product_current_cart['cart'] = Session::get('product_current_cart')['cart'];
			Session::forget( 'product_current_cart' );
			Session::save();
		} /*else {
            $product_current_cart['cart'] = array();
        }*/

		$product_current_cart['cart'] = array();

		//echo '<pre>'; print_r($data['cart']); die;


		$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();

		//print_r($funnelStep); die;

		if ( $stepProduct->product_type == 'manual' ) {
			$product         = Product::find( json_decode( $stepProduct->details )->product_id );
			$product_variant = ProductOption::find( $request->input( 'hid_product_variant_id' ) );

			$variant_title = "";

			if ( ! empty( $product_variant->options ) ) {
				foreach ( json_decode( $product_variant->options ) as $key => $option ) {

					if ( $key == 'price' ) {
						break;
					}

					$variant_title = $option . ',';
				}

				$variant_title = trim( $variant_title, ',' );
			}

			$product_quantity = ( ! empty( $request->input( 'product_quantity' ) ) ) ? $request->input( 'product_quantity' ) : 1;

			$data['cart']['products'][] = array(
				'product_id' => $product->id,
				'title'      => $product->name,
				'image'      => json_decode( $product->images )->main,
				'variant'    => ( ! empty( $product_variant->options ) ) ? [
					'title'   => $variant_title,
					'details' => json_decode( $product_variant->options ),
					'image'   => $product_variant->image
				] : array(),
				'quantity'   => $product_quantity,
				'price'      => ( ! empty( $product_variant->options ) ) ? [
					'$' . number_format( json_decode( $product_variant->options )->price, 2 ),
					number_format( json_decode( $product_variant->options )->price, 2 )
				] : [ '$' . number_format( $product->price, 2 ), number_format( $product->price, 2 ) ],
				'total'      => ( ! empty( $product_variant->options ) ) ? [
					'$' . number_format( ( json_decode( $product_variant->options )->price * $product_quantity ), 2 ),
					number_format( ( json_decode( $product_variant->options )->price * $product_quantity ), 2 )
				] : [
					'$' . number_format( $product->price * $product_quantity, 2 ),
					number_format( $product->price * $product_quantity, 2 )
				]
			);

			//recent
			$product_current_cart['cart']['products'][] = array(
				'product_id' => $product->id,
				'title'      => $product->name,
				'image'      => json_decode( $product->images )->main,
				'variant'    => ( ! empty( $product_variant->options ) ) ? [
					'title'   => $variant_title,
					'details' => json_decode( $product_variant->options ),
					'image'   => $product_variant->image
				] : array(),
				'quantity'   => $product_quantity,
				'price'      => ( ! empty( $product_variant->options ) ) ? [
					'$' . number_format( json_decode( $product_variant->options )->price, 2 ),
					number_format( json_decode( $product_variant->options )->price, 2 )
				] : [ '$' . number_format( $product->price, 2 ), number_format( $product->price, 2 ) ],
				'total'      => ( ! empty( $product_variant->options ) ) ? [
					'$' . number_format( ( json_decode( $product_variant->options )->price * $product_quantity ), 2 ),
					number_format( ( json_decode( $product_variant->options )->price * $product_quantity ), 2 )
				] : [
					'$' . number_format( $product->price * $product_quantity, 2 ),
					number_format( $product->price * $product_quantity, 2 )
				]
			);

			$sub_total = 0.0;
			$total     = 0.0;

			foreach ( $data['cart']['products'] as $pproduct ) {
				//echo '<pre>'; print_r($pproduct); die;
				$sub_total += doubleval( $pproduct['total'][1] );
				$total     += doubleval( $pproduct['total'][1] );
			}

			$data['cart']['sub_total'] = [ '$' . number_format( $sub_total, 2 ), number_format( $sub_total, 2 ) ];
			//$data['cart']['shipping'] = $data['cart']['shipping'];
			//$data['cart']['discount'] = $data['cart']['discount'];
			$data['cart']['total'] = [ '$' . number_format( $total, 2 ), number_format( $total, 2 ) ];

			//recent
			$product_current_cart['cart']['sub_total'] = [
				'$' . number_format( $sub_total, 2 ),
				number_format( $sub_total, 2 )
			];
			//$product_current_cart['cart']['shipping'] = $data['cart']['shipping'];
			//$product_current_cart['cart']['discount'] = $product_current_cart['cart']['discount'];
			$product_current_cart['cart']['total'] = [ '$' . number_format( $total, 2 ), number_format( $total, 2 ) ];

		} else {
			//Get the product
			$product = $this->getShopifyProduct( json_decode( $stepProduct->details )->product_id, $request );

			//Get the variant
			$product_variant = null;
			$product_image   = null;

			foreach ( $product->product->variants as $variant ) {
				if ( $variant->id == $request->input( 'hid_product_variant_id' ) ) {
					$product_variant = $variant;

					foreach ( $product->product->images as $image ) {
						if ( $variant->image_id == $image->id ) {
							$product_image = $image->src;
							break;
						}
					}

					break;
				} else {
					$product_variant = $variant;
					break;
				}
			}

			$product_quantity = ( ! empty( $request->input( 'product_quantity' ) ) ) ? $request->input( 'product_quantity' ) : 1;


			$data['cart']['products'][] = array(
				'product_id' => $product->product->id,
				'title'      => $product->product->title,
				'image'      => $product->product->image->src,
				'variant'    => [
					'title'   => $product_variant->title,
					'details' => $product_variant,
					'image'   => $product_image
				],
				'quantity'   => $product_quantity,
				'price'      => [
					'$' . number_format( $product_variant->price, 2 ),
					number_format( $product_variant->price, 2 )
				],
				'total'      => [
					'$' . number_format( ( $product_variant->price * $product_quantity ), 2 ),
					number_format( ( $product_variant->price * $product_quantity ), 2 )
				]
			);

			//recent
			$product_current_cart['cart']['products'][] = array(
				'product_id' => $product->product->id,
				'title'      => $product->product->title,
				'image'      => $product->product->image->src,
				'variant'    => [
					'title'   => $product_variant->title,
					'details' => $product_variant,
					'image'   => $product_image
				],
				'quantity'   => $product_quantity,
				'price'      => [
					'$' . number_format( $product_variant->price, 2 ),
					number_format( $product_variant->price, 2 )
				],
				'total'      => [
					'$' . number_format( ( $product_variant->price * $product_quantity ), 2 ),
					number_format( ( $product_variant->price * $product_quantity ), 2 )
				]
			);

			$sub_total = 0.0;
			$total     = 0.0;

			foreach ( $data['cart']['products'] as $pproduct ) {
				$sub_total += doubleval( $pproduct['total'][1] );
				$total     += doubleval( $pproduct['total'][1] );
			}

			$data['cart']['sub_total'] = [ '$' . number_format( $sub_total, 2 ), number_format( $sub_total, 2 ) ];
			//$data['cart']['shipping'] =$data['cart']['shipping'];
			$data['cart']['total'] = [ '$' . number_format( $total, 2 ), number_format( $total, 2 ) ];


			//recent
			$product_current_cart['cart']['sub_total'] = [
				'$' . number_format( $sub_total, 2 ),
				number_format( $sub_total, 2 )
			];
			//$product_current_cart['cart']['shipping'] = $data['cart']['shipping'];
			$product_current_cart['cart']['total'] = [ '$' . number_format( $total, 2 ), number_format( $total, 2 ) ];
		}

		Session::forget( 'product_cart' );
		Session::save();

		Session::put( 'product_cart', $data );
		Session::save();

		//create session for per order
		Session::put( 'product_current_cart', $product_current_cart );
		Session::save();

		//echo '<pre>'; print_r($data); die;

		return true;
	}


	//save payment info
	private function saveOrderInfo( Request $request ) {

		//print_r($_POST); die;
		// dd($request);


		$data['order'] = array();

		//save customer info to session
		$data['order']['customer'] = array(
			'email' => $request->input( 'email' )
		);

		//save shipping to session
		$data['order']['shipping'] = array(
			'first_name'   => $request->input( 'first_name' ),
			'last_name'    => $request->input( 'last_name' ),
			'full_address' => $request->input( 'full_address' ),
			'apt'          => $request->input( 'apt' ),
			'city'         => $request->input( 'city' ),
			'country'      => $request->input( 'country' ),
			'state'        => $request->input( 'state' ),
			'zip'          => $request->input( 'zip' ),
			'phone'        => $request->input( 'phone' )
		);

		//save billing to session
		if ( ( ! empty( $request->input( 'selection' ) ) ) && ( $request->input( 'selection' ) == 'same' ) ) {
			$data['order']['billing'] = array(
				'first_name'   => $request->input( 'first_name' ),
				'last_name'    => $request->input( 'last_name' ),
				'full_address' => $request->input( 'full_address' ),
				'apt'          => $request->input( 'apt' ),
				'city'         => $request->input( 'city' ),
				'country'      => $request->input( 'country' ),
				'state'        => $request->input( 'state' ),
				'zip'          => $request->input( 'zip' ),
				'phone'        => $request->input( 'phone' )
			);
		} else {
			$data['order']['billing'] = array(
				'first_name'   => $request->input( 'billing_first_name' ),
				'last_name'    => $request->input( 'billing_last_name' ),
				'full_address' => $request->input( 'billing_full_address' ),
				'apt'          => $request->input( 'billing_apt' ),
				'city'         => $request->input( 'billing_city' ),
				'country'      => $request->input( 'billing_country' ),
				'state'        => $request->input( 'billing_state' ),
				'zip'          => $request->input( 'billing_zip' ),
				'phone'        => $request->input( 'billing_phone' )
			);
		}

		//save payment to session
		$data['order']['payment'] = array(
			'number'    => $request->input( 'number' ),
			'ccv'       => $request->input( 'ccv' ),
			'exp-month' => $request->input( 'exp-month' ),
			'exp-year'  => $request->input( 'exp-year' )
		);

		Session::put( 'product_order_info', $data );
		Session::save();
	}


	public function getProductCartInfo( Request $request, $product_id ) {

		$page = Page::find( $request->input( 'page_id' ) );

		if ( ! empty( $page ) ) {
			$funnelStep = FunnelStep::find( $page->funnel_step_id );
			$funnelType = FunnelType::find( $funnelStep->type );

			if ( $funnelType->name == 'Sales' ) {

				$stepProduct = $this->getStepProduct( $page->funnel_step_id );

				if ( ( ! empty( $stepProduct ) ) ) {
					$product = Product::find( json_decode( $stepProduct->details )->product_id );

					//echo $product;

					//Prepare the cart info
					$data['cart'] = array(
						'products'  => array(
							array(
								'product_id' => $product->id,
								'title'      => $product->name,
								'image'      => ( ! empty( $product->images ) ) ? json_decode( $product->images )->main : '',
								'variant'    => array(),
								'quantity'   => 1,
								'price'      => [
									'$' . number_format( $product->price, 2 ),
									number_format( $product->price, 2 )
								],
								'total'      => [
									'$' . number_format( $product->price * 1, 2 ),
									number_format( $product->price * 1, 2 )
								]
							)
						),
						'sub_total' => [
							'$' . number_format( $product->price * 1, 2 ),
							number_format( $product->price * 1, 2 )
						],
						'shipping'  => [ 'title' => 'Free', 'amount' => 0.00 ],
						'total'     => [
							'$' . number_format( $product->price * 1, 2 ),
							number_format( $product->price * 1, 2 )
						]
					);

					Session::forget( 'product_cart' );
					Session::save();

					Session::put( 'product_cart', $data );
					Session::save();

					//create session for per order
					Session::put( 'product_current_cart', $data );
					Session::save();

					echo json_encode(
						array(
							'status' => 'success',
							'html'   => View::make( 'editor.widgets.frontend.product_cart', array( 'cart' => $data['cart'] ) )->render()
						)
					);
				}

			} else {
				if ( Session::has( 'product_cart' ) ) {
					$cart = Session::get( 'product_cart' );

					echo json_encode(
						array(
							'status' => 'success',
							'html'   => View::make( 'editor.widgets.frontend.product_cart', array( 'cart' => $cart['cart'] ) )->render()
						)
					);

				} else {
					echo json_encode(
						array(
							'status' => 'error',
							'cart'   => array()
						)
					);
				}
			}
		}
	}


	public function updateBumpOnFly( Request $request ) {

		$page = Page::find( $request->input( 'page_id' ) );
		if ( ! empty( $page ) ) {
			$step     = FunnelStep::find( $page->funnel_step_id );
			$funnel   = Funnel::find( $page->funnel_id );
			$prevStep = FunnelStep::where( 'funnel_id', $funnel->id )
			                      ->where( 'order_position', '<', $step->order_position )
			                      ->orderBy( 'order_position', 'desc' )
			                      ->first();

			$stepProduct = StepProduct::where( 'step_id', $prevStep->id )
			                          ->orderBy( 'id', 'desc' )
			                          ->first();

			//print_r($stepProduct); die;
			if ( ! empty( $stepProduct ) ) {
				$details = json_decode( $stepProduct->details );
				echo json_encode(
					array(
						'status'          => 'success',
						'bump_product_id' => $details->product_id
					)
				);
			} else {
				echo json_encode(
					array(
						'status' => 'error'
					)
				);
			}
		}
	}


	//Get Order Session
	public function getOrderSession( Request $request ) {

		$data = array();

		if ( Session::has( 'product_order_info' ) ) {

			$order = Session::get( 'product_order_info' );

			//print_r($data['order']); die;

			die(
			json_encode(
				array(
					'status' => 'success',
					'order'  => $order
				)
			)
			);

			/*die(
                json_encode(
                    array(
                        'status'    => 'success',
                        'html'      => View::make('editor.widgets.frontend.product_order_info', array('order' => $order))->render()
                        //'html'      => view('editor.widgets.frontend.product_order_info')->withData($data)
                    )
                )
            );*/
		} else {
			die(
			json_encode(
				array(
					'status'  => 'error',
					'message' => 'Unable to fetch order information'
				)
			)
			);
		}
	}


	public function getScreenshoot( Request $request, $page_id ) {
		/*$args['force']               = 'false';      # [false,always,timestamp] Default: false
		$args['fullpage']            = 'false';      # [true,false] Default: false
		$args['thumbnail_max_width'] = 'false';      # scaled image width in pixels; Default no-scaling.
		$args['viewport']            = "1024x768";  # Max 5000x5000; Default 1280x1024

		$page = Page::find( $page_id );


		$URL2PNG_APIKEY = env("URLTOPNG_API_KEY");
		$URL2PNG_SECRET = env("URLTOPNG_API_SECRET");
		$url            = route( 'page.view', $page->slug );

		//echo $url; die;

		# urlencode request target
		$options['url'] = urlencode( $url );

		$options += $args;

		# create the query string based on the options
		foreach ( $options as $key => $value ) {
			$_parts[] = "$key=$value";
		}

		# create a token from the ENTIRE query string
		$query_string = implode( "&", $_parts );
		$TOKEN        = md5( $query_string . $URL2PNG_SECRET );*/

		$page = Page::find( $page_id );

		//echo $request->input('step_id'); die;

		if ( $request->input( 'action' ) == 'email' ) {
			$url = route( 'email.view', $request->input( 'step_id' ) );
		} else {
			$url = route( 'page.view', $page->slug );
		}

		$site_url             = urlencode( $url );
		$image_size           = "1024x768";
		$unique_id            = md5( Session::getId() );
		$capture_img_location = new UrlToPng( $site_url, $unique_id, $image_size );

		//die( "https://api.url2png.com/v6/$URL2PNG_APIKEY/$TOKEN/png/?$query_string" );

		//print_r($capture_img_location);
		if ( ! empty( $capture_img_location ) ) {
			die( $capture_img_location->final_location );
		} else {
			die( "#" );
		}
	}


	public function getScreenshootThumb( $page_id ) {

		$pageScreenshoot = PageScreenshoot::where( 'page_url', route( 'pages.show', $page_id ) )->first();
		//echo route('pages.show', $page_id); die;

		if ( ! empty( $pageScreenshoot ) && ( $pageScreenshoot->count() > 0 ) ) {
			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => asset( 'global/img/screenshoots/cache/thumb/' . $pageScreenshoot->screenshoot_url )
				)
			)
			);
		} else {
			die(
			json_encode(
				array(
					'status' => 'error',
					'url'    => '#'
				)
			)
			);
		}

		/*if ( Session::has('page_screenshoot') ) {

            $uri = Session::pull('page_screenshoot');

            Session::forget('page_screenshoot');
            Session::save();

            die(
                json_encode(
                    array(
                        'status'    => 'success',
                        'url'       => $uri
                    )
                )
            );
        } else {

            die(
                json_encode(
                    array(
                        'status'    => 'error',
                        'url'       => '#'
                    )
                )
            );
        }*/
	}


	public function gotoNextStep( $page_id ) {
		$page       = Page::find( $page_id );
		$funnelStep = FunnelStep::find( $page->funnel_step_id );
		$funnelType = FunnelType::find( $funnelStep->type );

		//echo '<pre>'; print_r($funnelType);

		$step = null;

		switch ( strtolower( $funnelType->name ) ) {

			case 'upsell':
				$step = $this->getStep( $page, 'downsell', 'confirmation' );
				break;

			case 'downsell':
				$step = $this->getStep( $page, 'confirmation' );
				break;

			case 'optin':
				$step = $this->getFunnelNextStep( $page_id );
				break;

			default:
				$step = $this->getStep( $page );
				break;
		}

		//echo '<pre>'; print_r($step); die;

		//if ( ($step != null) && (count($step) > 0) ) {
		if ( ! empty( $step ) ) {

			$stepPage = Page::where( 'funnel_step_id', $step->id )->first();
			//$stepPage = Page::find($stepPage->id);

			if ( ! empty( $stepPage ) ) {
				die( json_encode(
					array(
						'status' => 'success',
						'url'    => route( 'page.view', $stepPage->slug )
					)
				) );
			} else {
				die( json_encode(
					array(
						'status' => 'success',
						'url'    => '#'
					)
				) );
			}
		} else {

			die( json_encode(
				array(
					'status' => 'success',
					'url'    => '#'
				)
			) );
		}
	}


	public function getImageAdditional( Request $request, $product_id ) {

		//echo $product_id;

		$funnel = Funnel::find( $request->input( 'funnel_id' ) );

		$userIntegration = UserIntegration::where( 'user_id', $funnel->user_id )->where( 'service_type', 'shopify' )->first();
		$json            = json_decode( $userIntegration->details );

		$API_KEY      = $json->api_key;
		$API_PASSWORD = $json->password;
		$SECRET       = $json->shared_secret;
		$store_name   = $json->name;

		//https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

		//die($url);
		$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/images/" . $request->input( 'image_id' ) . ".json";
		die ( file_get_contents( $url ) );
	}


	public function updateProductAdd( Request $request ) {

		//product_current_cart, product_cart

		//print_r($_POST); die;

		if ( Session::has( 'product_cart' ) ) {

			$data = Session::get( 'product_cart' );

			if ( $request->input( 'action' ) == 'add_bump' ) {

				//check if the product associate with the step
				$stepProduct = $this->getStepProduct( $request->input( 'step_id' ), true );

				//echo $request->input( 'product_type' ); die;

				//if product_type is empty then check the funnel type
				$product_type = "manual";
				$funnel       = Funnel::find( $request->input( 'funnel_id' ) );
				if ( ! empty( $funnel ) ) {
					$product_type = $funnel->type;
				}


				if ( $stepProduct != false ) {

					if ( $product_type == 'manual' ) {
						$product         = Product::find( $request->input( 'product_id' ) );
						$product_variant = ProductOption::find( $request->input( 'hid_product_variant_id' ) );

						$variant_title = "";

						if ( ! empty( $product_variant ) && $product_variant->options->count() > 0 ) {
							foreach ( json_decode( $product_variant->options ) as $key => $option ) {

								if ( $key == 'price' ) {
									break;
								}

								$variant_title = $option . ',';
							}

							$variant_title = trim( $variant_title, ',' );

							//Prepare the cart info
							$data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['bump'] =
								array(
									'product_id' => $product->id,
									'title'      => $product->name,
									'image'      => ( ! empty( json_decode( $product->images )->main ) ) ? json_decode( $product->images )->main : asset( 'images/no-images.png' ),
									//json_decode($product->images)->main,
									'variant'    => [
										'title'   => $variant_title,
										'details' => json_decode( $product_variant->options ),
										'image'   => $product_variant->image
									],
									'quantity'   => $request->input( 'product_quantity' ),
									'price'      => [
										'$' . number_format( json_decode( $product_variant->options )->price, 2 ),
										number_format( json_decode( $product_variant->options )->price, 2 )
									],
									'total'      => [
										'$' . number_format( json_decode( $product_variant->options )->price, 2 ),
										number_format( json_decode( $product_variant->options )->price, 2 )
									]
								);
						} else {
							$data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['bump'] =
								array(
									'product_id' => $product->id,
									'title'      => $product->name,
									'image'      => ( ! empty( json_decode( $product->images )->main ) ) ? json_decode( $product->images )->main : asset( 'images/no-images.png' ),
									'variant'    => array(),
									'quantity'   => $request->input( 'product_quantity' ),
									'price'      => [
										'$' . number_format( $product->price, 2 ),
										number_format( $product->price, 2 )
									],
									'total'      => [
										'$' . number_format( $product->price, 2 ),
										number_format( $product->price, 2 )
									]
								);
						}


					} else {
						//Get the product
						$product = $this->getShopifyProduct( $request->input( 'product_id' ), $request );

						//Get the variant
						$product_variant = null;
						$product_image   = null;

						foreach ( $product->product->variants as $variant ) {
							//if ( $variant->id == $request->input('hid_product_variant_id') ) {
							$product_variant = $variant;

							foreach ( $product->product->images as $image ) {
								if ( $variant->image_id == $image->id ) {
									$product_image = $image->src;
									break;
								}
							}

							break;
							//}
						}

						//Prepare the cart info
						$data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['bump'] =
							array(
								'product_id' => $product->product->id,
								'title'      => $product->product->title,
								'image'      => $product->product->image->src,
								'variant'    => [
									'title'   => $product_variant->title,
									'details' => $product_variant,
									'image'   => $product_image
								],
								'quantity'   => $request->input( 'product_quantity' ),
								'price'      => [
									'$' . number_format( $product_variant->price, 2 ),
									number_format( $product_variant->price, 2 )
								],
								'total'      => [
									'$' . number_format( $product_variant->price, 2 ),
									number_format( $product_variant->price, 2 )
								]
							);
					}

					//sub total
					$data['cart']['sub_total'][1] = $data['cart']['sub_total'][1] + $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['bump']['total'][1];
					$data['cart']['sub_total'][0] = '$' . number_format( $data['cart']['sub_total'][1], 2 );

					//total
					$data['cart']['total'][1] = $data['cart']['total'][1] + $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['bump']['total'][1];
					$data['cart']['total'][0] = '$' . number_format( $data['cart']['total'][1], 2 );

					Session::put( 'product_cart', $data );
					Session::save();

					//create session for per order
					Session::put( 'product_current_cart', $data );
					Session::save();
				} else {
					die(
					json_encode(
						array(
							'status'  => 'error',
							'message' => 'No bump product in this step'
						)
					)
					);
				}

			} else {

				//sub total
				$data['cart']['sub_total'][1] = $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['total'][1];
				$data['cart']['sub_total'][0] = '$' . number_format( $data['cart']['sub_total'][1], 2 );

				//total
				$data['cart']['total'][1] = $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['total'][1];
				$data['cart']['total'][0] = '$' . number_format( $data['cart']['total'][1], 2 );

				unset( $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['bump'] );

				Session::put( 'product_cart', $data );
				Session::save();

				//create session for per order
				Session::put( 'product_current_cart', $data );
				Session::save();

				//echo '<pre>'; print_r($data); die;
			}

			//echo '<pre>'; print_r($data); die;

			die(
			json_encode(
				array(
					'status' => 'success',
					'html'   => View::make( 'editor.widgets.frontend.product_cart', array( 'cart' => $data['cart'] ) )->render()
				)
			)
			);
		}
	}


	public function getShippingMethods( Request $request ) {

		//echo $request->input('step_id'); die;

		if ( ! empty( $request->input( 'step_id' ) ) ) {

			$user_id     = $request->input( 'user_id' );
			$stepProduct = $this->getStepProduct( $request->input( 'step_id' ) );

			if ( ! empty( $stepProduct->details ) ) {
				if ( ! empty( json_decode( $stepProduct->details )->shipping ) ) {
					$shippings = json_decode( $stepProduct->details )->shipping;
				} else {
					$shippings = array();
				}

				//echo $stepProduct; die;

				if ( Session::has( 'product_cart' ) ) {
					$data = Session::get( 'product_cart' );
				} else {
					$data = array();
				}

				if ( ! empty( $data['cart'] ) ) {
					die(
					json_encode(
						array(
							'status' => 'success',
							'html'   => View::make( 'editor.widgets.frontend.shipping_method', array(
								'shippings' => $shippings,
								'id'        => time(),
								'cart'      => $data['cart']
							) )->render()
						)
					)
					);
				}
			}

		}

	}


	private function getStepProduct( $step_id, $bump = false ) {

		$step = FunnelStep::find( $step_id );

		if ( FunnelType::find( $step->type )->name == 'Order' ) {

			//$step = FunnelStep::where('funnel_id', $step->funnel_id)->orderBy('order_position', 'asc')->first();
			//$stepProduct = StepProduct::where('step_id', $step->id)->first();

			$step = FunnelStep::where( 'funnel_id', $step->funnel_id )->orderBy( 'order_position', 'asc' )->first();

			if ( $bump ) {
				$stepProducts = StepProduct::where( 'step_id', $step->id )->get();
				foreach ( $stepProducts as $stepProduct ) {

					if ( json_decode( $stepProduct->details )->bump ) {
						break;
					}
				}
			} else {
				$stepProduct = StepProduct::where( 'step_id', $step->id )->first();
			}

			/*$stepProducts = StepProduct::where('step_id', $step->id)->get();
            foreach ( $stepProducts as $stepProduct ) {
                $isBump = json_decode($stepProduct->details)->bump;
                if ( $isBump )
                    break;
            }*/

		} else {
			$stepProduct = StepProduct::where( 'step_id', $step->id )->first();
		}

		//check bump
		if ( $bump == true ) {
			$deails = json_decode( $stepProduct->details )->bump;

			if ( empty( $deails ) ) {
				return false;
				die;
			}
		}
		// dd($stepProduct);
		return $stepProduct;
	}


	public function updateCartWithShipping( Request $request ) {

		$user_id     = $request->input( 'user_id' );
		$stepProduct = StepProduct::where( 'step_id', $request->input( 'step_id' ) )->first();

		if ( Session::has( 'product_cart' ) ) {

			$data = Session::get( 'product_cart' );

			//print_r($data); die;

			//total
			/*if ( !empty($data['cart']['products'][count($data['cart']['products']) - 1]['discount']) ) {
                        if ( !empty($data['cart']['products'][count($data['cart']['products']) - 1]['shipping']) ) {
                            $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1] = number_format((floatval($data['cart']['products'][count($data['cart']['products']) - 1]['total'][1]) - floatval($data['cart']['products'][count($data['cart']['products']) - 1]['shipping']['amount'])) + floatval($request->input('amount')), 2);
                        } else {
                            $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1] = number_format(floatval($data['cart']['products'][count($data['cart']['products']) - 1]['total'][1]) + floatval($request->input('amount')), 2);
                        }
                        $data['cart']['products'][count($data['cart']['products']) - 1]['total'][0] = '$' . $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1];
                    } else {
                        $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1] = number_format(floatval($data['cart']['products'][count($data['cart']['products']) - 1]['price'][1]) + floatval($request->input('amount')), 2);
                        $data['cart']['products'][count($data['cart']['products']) - 1]['total'][0] = '$' . $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1];
                    }*/


			//if shipping was set remove it
			if ( ! empty( $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['shipping'] ) ) {
				unset( $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['shipping'] );
			}

			//assign the shipping amount
			$data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['shipping'] = array(
				'title'  => $request->input( 'shipping_name' ),
				'amount' => number_format( $request->input( 'amount' ), 2 )
			);


			//update total cost
			$sub_total = 0.0;
			$total     = 0.0;
			$shipping  = 0.0;
			$discount  = 0.0;

			foreach ( $data['cart']['products'] as $pproduct ) {
				$sub_total += floatVal( $pproduct['total'][1] );
				$total     += floatVal( $pproduct['total'][1] );

				//calculate the bump
				if ( ! empty( $pproduct['bump'] ) ) {
					$total += floatVal( $pproduct['bump']['total'][1] );
				}

				if ( ! empty( $pproduct['shipping'] ) ) {
					$total    += floatVal( $pproduct['shipping']['amount'] );
					$shipping += floatVal( $pproduct['shipping']['amount'] );
				}

				if ( ! empty( $pproduct['discount'] ) ) {
					$discount += floatVal( $pproduct['discount'] );
					$total    = $total - floatVal( $pproduct['discount'] );
				}
			}

			$data['cart']['sub_total'] = [ '$' . number_format( $sub_total, 2 ), number_format( $sub_total, 2 ) ];
			$data['cart']['total']     = [ '$' . number_format( $total, 2 ), number_format( $total, 2 ) ];

			//if ( !empty($data['cart']['products'][count($data['cart']['products']) - 1]['shipping']) ) {
			$data['cart']['shipping'] = [
				'title'  => $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['shipping']['title'],
				'amount' => $shipping
			];
			//}

			//$data['cart']['discount'] = $discount;


			Session::put( 'product_cart', $data );
			Session::save();

			//create session for per order
			Session::put( 'product_current_cart', $data );
			Session::save();

			//echo '<pre>'; print_r($data); die;

			die(
			json_encode(
				array(
					'status' => 'success',
					'html'   => View::make( 'editor.widgets.frontend.product_cart', array( 'cart' => $data['cart'] ) )->render()
				)
			)
			);
		}
	}


	public function applyCoupon( Request $request ) {

		//$user_id     = $request->input( 'user_id' );
		$stepProduct = $stepProduct = $this->getStepProduct( $request->input( 'step_id' ) );
		$coupon      = Coupon::find( json_decode( $stepProduct->details )->coupon_id );

		if ( Session::has( 'product_cart' ) ) {

			$data = Session::get( 'product_cart' );

			if ( ! empty( $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['discount'] ) ) {

				die(
				json_encode(
					array(
						'status'  => 'error',
						'message' => 'You have already applied the coupon'
					)
				)
				);

			} else {

				//check if the code is matched
				if ( ( ! empty( $request->input( 'code' ) ) && ( ! empty( $coupon->coupon_code ) ) ) && ( $request->input( 'code' ) == $coupon->coupon_code ) ) {

					//assign the shipping amount
					$data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['discount'] = number_format( floatval( $coupon->discount ), 2 );

					//sub total
					//$data['cart']['sub_total'][1] = $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1];
					//$data['cart']['sub_total'][0] = '$' . number_format($data['cart']['sub_total'][1], 2);

					//total
					/*if ( !empty($data['cart']['products'][count($data['cart']['products']) - 1]['shipping']) ) {
                        $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1] = number_format(floatval($data['cart']['products'][count($data['cart']['products']) - 1]['total'][1]) - floatval($coupon->discount), 2);
                        $data['cart']['products'][count($data['cart']['products']) - 1]['total'][0] = '$' . $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1];
                    } else {
                        $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1] = number_format(floatval($data['cart']['products'][count($data['cart']['products']) - 1]['sub_total'][1]) - floatval($coupon->discount), 2);
                        $data['cart']['products'][count($data['cart']['products']) - 1]['total'][0] = '$' . $data['cart']['products'][count($data['cart']['products']) - 1]['total'][1];
                    }*/


					//update the cart
					$sub_total = 0.0;
					$total     = 0.0;
					$shipping  = 0.0;
					$discount  = 0.0;

					foreach ( $data['cart']['products'] as $pproduct ) {
						$sub_total += floatVal( $pproduct['total'][1] );
						$total     += floatVal( $pproduct['total'][1] );

						//calculate the bump
						if ( ! empty( $pproduct['bump'] ) ) {
							$total += floatVal( $pproduct['bump']['total'][1] );
						}

						if ( ! empty( $pproduct['shipping'] ) ) {
							$total    += floatVal( $pproduct['shipping']['amount'] );
							$shipping += floatVal( $pproduct['shipping']['amount'] );
						}

						if ( ! empty( $pproduct['discount'] ) ) {
							$discount += floatVal( $pproduct['discount'] );
							//$total    = $total - floatVal( $pproduct['discount'] ); //wrong

							$percentage = ( floatVal( $discount ) / 100 ) * $total;
							$total      = $total - $percentage; //wrong

							//echo $total; die;
						}
					}

					$data['cart']['sub_total'] = [
						'$' . number_format( $sub_total, 2 ),
						number_format( $sub_total, 2 )
					];
					$data['cart']['total']     = [ '$' . number_format( $total, 2 ), number_format( $total, 2 ) ];

					if ( ! empty( $pproduct['shipping'] ) ) {
						$data['cart']['shipping'] = [
							'title'  => $data['cart']['products'][ count( $data['cart']['products'] ) - 1 ]['shipping']['title'],
							'amount' => $shipping
						];
					}

					$data['cart']['discount']  = $discount;
					$data['cart']['sub_total'] = [
						'$' . number_format( $sub_total, 2 ),
						number_format( $sub_total, 2 )
					];
					$data['cart']['total']     = [ '$' . number_format( $total, 2 ), number_format( $total, 2 ) ];


					Session::put( 'product_cart', $data );
					Session::save();

					//create session for per order
					Session::put( 'product_current_cart', $data );
					Session::save();

					//echo '<pre>'; print_r($data); die;

					die(
					json_encode(
						array(
							'status'  => 'success',
							'message' => 'Coupon has applied',
							'html'    => View::make( 'editor.widgets.frontend.product_cart', array( 'cart' => $data['cart'] ) )->render()
							//'html'    => View::make( 'editor.widgets.frontend.product_cart', array( 'cart' => $data['cart'] ) )->render()
						)
					)
					);
				} else {
					die(
					json_encode(
						array(
							'status'  => 'error',
							'message' => 'Sorry! you have entered wrong code'
						)
					)
					);
				}
			}
		}
	}


	public function getUserIP() {
		if ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $_SERVER ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			if ( strpos( $_SERVER['HTTP_X_FORWARDED_FOR'], ',' ) > 0 ) {
				$addr = explode( ",", $_SERVER['HTTP_X_FORWARDED_FOR'] );

				return trim( $addr[0] );
			} else {
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		} else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}


	public function storeStepProduct( Request $request, $funnel_id, $step_id ) {
		$funnelStep = FunnelStep::find( $step_id );

		$funnel = Funnel::find( $funnel_id );

		// print_r($_POST); die;


		$settings['product_id'] = $request->input( 'product_id' );

		////////////////////
		if ( ! empty( $request->input( 'action' ) ) ) {
			$stepProduct = StepProduct::where( 'step_id', $request->input( 'step_id' ) )->first();

			if ( ! empty( $stepProduct ) && $stepProduct->count() > 0 ) {
				$stepProduct = $stepProduct::find( $stepProduct->id );
			} else {
				$stepProduct = new StepProduct;
			}
		}

		$stepProduct->funnel_id    = $funnel_id;
		$stepProduct->step_id      = $step_id;
		$stepProduct->product_type = $funnel->type;
		$stepProduct->details      = json_encode( array( 'product_id' => $request->input( 'product_id' ) ) );

		if ( $stepProduct->save() ) {
			die( json_encode(
				array(
					'status'  => 'success',
					'message' => 'Product has been saved'
				)
			) );
		} else {
			die( json_encode(
				array(
					'status'  => 'error',
					'message' => 'ERROR! please try after sometime'
				)
			) );
		}
	}

	public function downloadFunnelBonus( $token ) {

		/*$funnelUpload = FunnelUpload::where('download_token', $token)->first();
        $path = public_path('frontend/funnel/softwares/' . $funnelUpload->file_path);

        $headers = [
            'Content-Type' => 'application/zip',
        ];

        return response()->download($path, $funnelUpload->file_path, $headers);*/

		return $this->downloadAsset( $token );
	}


	private function downloadAsset( $token ) {
		$funnelUpload = FunnelUpload::where( 'download_token', $token )->first();
		$assetUrl     = Storage::disk( 's3' )->url( 'bonuses/' . $funnelUpload->file_path );
		//$assetPath = Storage::disk('s3')->get('bonuses/'. $funnelUpload->file_path);
		$types = explode( '.', $funnelUpload->file_path );
		//$file_type = end(((explode('.', $funnelUpload->file_path))));
		$file_type = $types[ count( $types ) - 1 ];

		//return \Redirect::to($assetUrl);

		//return \Redirect::away($assetUrl);
		//return redirect()->away("google.com");
		return redirect()->away( $assetUrl );
		//header("Location: https://www.dropbox.com");

		/*header('Content-Description: File Transfer');
        header('Content-Type: ' . 'application/zip');
        header('Content-Disposition: attachment; filename=' . basename($assetUrl));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        //header('Content-Length: ' . strlen($assetPath));
        ob_clean();
        flush();
        readfile($assetPath);
        exit;*/


		//echo $file_type; die;

		/*header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . basename($assetPath));
        header("Content-Type: " . $file_type);*/

		//return readfile($assetPath);

		/*$headers = [
            "Cache-Control" => "public",
            "Content-Description" => "File Transfer",
            "Content-Disposition: attachment; filename=" => basename($assetUrl),
            'Content-Type' => 'application/zip'
        ];

        //return response()->download($assetPath, $funnelUpload->file_path, $headers);
        //readfile($assetPath);
        return response()->make($assetPath);*/

		/*$headers = [
            'Content-Type' => 'application/zip',
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename={basename($assetPath)}",
            'filename'=> $assetPath
        ];

        //return response($assetPath, 200, $headers);
        return response()->download($assetPath, $funnelUpload->file_path, $headers);*/
	}

	public function emailTemplatePreview( Request $request, $step_id ) {

		$step = FunnelStep::find( $step_id );

		$stepDetails = json_decode( $step->details );
		$contents    = $stepDetails->email;
		//print_r(json_decode($contents->content)->htmlbody); die;
		$contents = json_decode( $contents->content );

		return view( "builder.email_template_view", [ "contents" => $contents ] );
	}
}


class ZohoIntegration {

	var $username;
	var $password;

	public function __construct( $username, $password ) {

		$this->username = $username;
		$this->password = $password;
	}

	public function getAuth() {
		$username = $this->username;
		$password = $this->password;
		$param    = "SCOPE=ZohoCRM/crmapi&EMAIL_ID=" . $username . "&PASSWORD=" . $password;

		$ch = curl_init( "https://accounts.zoho.com/apiauthtoken/nb/create" );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $param );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		$result = curl_exec( $ch );
		//echo "POST:" . $result; die;
		$httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );

		$anArray   = explode( "\n", $result );
		$authToken = explode( "=", $anArray['2'] );
		$cmp       = strcmp( $authToken['0'], "AUTHTOKEN" );

		//print_r($authToken);

		return $authToken[1];
	}


	public function postData( $auth, $data ) {

		$rows = "";

		foreach ( $data as $key => $field ) {

			if ( $key == 'name' ) {
				$names      = explode( ' ', $field );
				$first_name = $names[0];
				$last_name  = ( ! empty( $names[1] ) ) ? $names[1] : $names[0];
			} elseif ( $key == 'first_name' ) {
				$first_name = $field;
			} elseif ( $key == 'last_name' ) {
				$last_name = $field;
			} elseif ( $key == 'email' ) {
				$email = $field;
			} elseif ( $key == 'phone' ) {
				$phone = $field;
			} else {
				if ( ( ! empty( $data['quantity'] ) ) ) {
					$quantity = $data['quantity'];
				} elseif ( ( ! empty( $data['qty'] ) ) ) {
					$quantity = $data['qty'];
				} elseif ( ( ! empty( $data['q'] ) ) ) {
					$quantity = $data['q'];
				} elseif ( ( ! empty( $data['range'] ) ) ) {
					$quantity = $data['range'];
				}
			}
		}

		//echo $first_name . ',' . $last_name . ',' . $email . ',' . $quantity;

		$xml =
			'<?xml version="1.0" encoding="UTF-8"?>
            <Contacts>
            <row no="1">
            <FL val="First Name">' . $first_name . '</FL>
            <FL val="Last Name"> ' . $last_name . ' </FL>
            <FL val="Email">' . $email . '</FL>
            <FL val="Description">' . $quantity . '</FL>
            <FL val="Phone">' . $phone . '</FL>
            <FL val="Fax">99999999</FL>
            <FL val="Mobile">99989989</FL>
            <FL val="Assistant">none</FL>
            </row>
            </Contacts>';
		//echo "--" . $xml; die;
		$url   = "https://crm.zoho.com/crm/private/xml/Contacts/insertRecords";
		$query = "authtoken=" . $auth . "&scope=crmapi&newFormat=1&xmlData=" . $xml;
		//echo $query;
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $query );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		$result = curl_exec( $ch );
		curl_close( $ch );

		return $result;
	}


	/*private function sendEmail(Request $request, $data = array()) {

            $to = $data['to'];
            $msg = $data['message'];
            $subject = $data['subject'];

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <info@cartumo.io>' . "\r\n";

            // send email
            mail($to, $subject, $msg, $headers);
        }*/

}
