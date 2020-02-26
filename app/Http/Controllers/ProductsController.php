<?php

namespace App\Http\Controllers;

use Dompdf\Exception;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Funnel;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\FunnelStep;
use App\Models\FunnelType;
use App\Models\StepProduct;
use App\Models\UserShop;
use App\Models\UserIntegration;
use App\Models\ProductPayment;
use App\Models\ProductEmailIntegration;

use DB;

use Auth;
use View;

class ProductsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function index( $funnel_id, $step_id ) {
		//echo $product_id . ', ' . $step_id;

		$funnel       = Funnel::find( $funnel_id );
		$steps        = FunnelStep::where( 'funnel_id', $funnel_id )->orderBy( 'order_position' )->get();
		$currentStep  = FunnelStep::find( $step_id );
		$page         = Page::where( 'funnel_id', $funnel->id )->where( 'funnel_step_id', $step_id )->get()->first();
		$funnelTypes  = FunnelType::orderBy( 'name' )->get();
		$currentType  = FunnelType::find( $currentStep->type );
		$stepProducts = StepProduct::where( 'funnel_id', $funnel_id )->where( 'step_id', $step_id )->orderBy( 'id', 'desc' )->get();
		// dd($stepProducts);

		$coupons = Coupon::where( 'user_id', Auth::id() )->get();

		//$userIntegrations = UserIntegration::where('service_type', '!=', 'shopify')->orderBy('service_type')->get();
		//$productEmailIntegration = ProductEmailIntegration::where('step_id', '=', $currentStep->id)->first();
		$product = array();

		//echo $stepProducts; die;
		$hasProduct = false;

		if ( ! empty( $stepProducts ) ) {

			foreach ( $stepProducts as $stepProduct ) {
				if ( $stepProduct->product_type == 'manual' ) {

				} else {
					$details = json_decode( $stepProduct->details );
					$product = $this->getShopifyProduct( $details->product_id );
					if ( ! empty( $product ) ) {
						$product = $product->product;
					} else {
						$product = (object) array();
					}
				}

				if ( empty( json_decode( $stepProduct->details )->bump ) && ! $hasProduct ) {
					$hasProduct = true;
				}
			}

		}

		//check if bump os exists or not
		$hasBump = false;
		foreach ( $stepProducts as $stepProduct ) {
			if ( ( ! empty( json_decode( $stepProduct->details )->bump ) ) && ( json_decode( $stepProduct->details )->bump != false ) ) {
				$hasBump = true;
				break;
			}
		}

		//echo $steps; die;

		return view( 'funnels.products.list', array(
			'funnel'       => $funnel,
			'steps'        => $steps,
			'currentStep'  => $currentStep,
			'currentType'  => $currentType,
			'funnelTypes'  => $funnelTypes,
			'product'      => $product,
			'stepProducts' => $stepProducts,
			'page'         => $page,
			'hasBump'      => $hasBump,
			'hasProduct'   => $hasProduct,
			'coupons'      => $coupons
		) );
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
	 * Product bump
	 */
	public function productBump( $funnel_id, $step_id ) {
		//echo $product_id . ', ' . $step_id;

		$funnel       = Funnel::find( $funnel_id );
		$steps        = FunnelStep::where( 'funnel_id', $funnel_id )->orderBy( 'order_position' )->get();
		$currentStep  = FunnelStep::find( $step_id );
		$page         = Page::where( 'funnel_id', $funnel->id )->where( 'funnel_step_id', $step_id )->get()->first();
		$funnelTypes  = FunnelType::orderBy( 'name' )->get();
		$currentType  = FunnelType::find( $currentStep->type );
		$stepProducts = StepProduct::where( 'funnel_id', $funnel_id )->where( 'step_id', $step_id )->orderBy( 'id', 'desc' )->get();		

		//check if bump os exists or not
		$hasBump = false;
		foreach ( $stepProducts as $stepProduct ) {
			if ( ( ! empty( json_decode( $stepProduct->details )->bump ) ) && ( json_decode( $stepProduct->details )->bump != false ) ) {
				$hasBump = true;
				break;
			}
		}

		return view( 'funnels.products.bump.list', array(
			'funnel'       => $funnel,
			'steps'        => $steps,
			'currentStep'  => $currentStep,
			'currentType'  => $currentType,
			'funnelTypes'  => $funnelTypes,
			'stepProducts' => $stepProducts,
			'page'         => $page,
			'hasBump'      => $hasBump
		) );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request, $funnel_id, $step_id ) {
		// dd($request->all());
		$funnelStep = FunnelStep::find( $step_id );

		//print_r($_POST); die;


		$settings['product_id'] = $request->input( 'product_id' );

		// save shipping
		if ( ! empty( $request->input( 'shipping' ) ) ) {

			$settings['shipping'] = $request->input( 'shipping' );
		}

		// save coupon id
		if ( ! empty( $request->input( 'shipping' ) ) ) {

			$settings['coupon_id'] = $request->input( 'coupon_id' );
		}

		// bump
		if ( ! empty( $request->input( 'chk_bump_product' ) ) ) {
			$settings['bump'] = true;
		} else {
			$settings['bump'] = false;
		}


		$stepProducts = StepProduct::where( 'step_id', $step_id )->get();

		// dd($stepProducts); die;

		if ( empty( $request->input( 'type' ) ) ) {
			if ( ! empty( $stepProducts ) && $stepProducts->count() > 0 ) {
				foreach ( $stepProducts as $stepProduct ) {
					if ( ( ! empty( json_decode( $stepProduct->details )->bump ) ) && ( json_decode( $stepProduct->details )->bump != false ) ) {

					} else {
						$stepProduct = StepProduct::find( $stepProduct->id );
						break;
					}
				}
			} else {
				$stepProduct = new StepProduct;
				//echo "true"; die;
			}
		} else {
			$stepProduct = new StepProduct;
		}

		//print_r($stepProduct); die;


		////////////////////
		if ( ! empty( $request->input( 'action' ) ) ) {
			$stepProduct = StepProduct::where( 'step_id', $request->input( 'step_id' ) )->first();

			if ( ! empty( $stepProduct ) && $stepProduct->count() > 0 ) {
				$stepProduct = $stepProduct::find( $stepProduct->id );
			} else {
				$stepProduct = new StepProduct;
			}
		}


		//$stepProduct = new StepProduct;
		$stepProduct->funnel_id    = $funnel_id;
		$stepProduct->step_id      = $step_id;
		$stepProduct->product_type = $request->input( 'product_type' );
		$stepProduct->details      = json_encode( $settings );
		//$stepProduct->created_at = date('Y-m-d h:i:s');
		//$stepProduct->created_at = date('Y-m-d h:i:s');
		//$stepProduct->save();

		if ( $stepProduct->save() ) {

			$funnel             = Funnel::find( $funnel_id );
			$funnel->updated_at = date( 'Y-m-d h:i:s' );
			$funnel->save();

			die( json_encode(
				array(
					'status'  => 'success',
					'message' => 'Product has been saved',
					'bump'    => $settings['bump'],
					'url'     => route( 'product.index', [ $funnel_id, $step_id ] )
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
	public function edit( $funnel_id, $step_id, $step_product_id ) {
		$stepProduct = StepProduct::find( $step_product_id );
		//$product = Product::find($stepProduct->product->id);
		$manualProducts = Product::where( 'product_type', 'manual' )->get();

		//echo $product;
		echo view( 'funnels.products.edit', array(
			'stepProduct'    => $stepProduct,
			'manualProducts' => $manualProducts
		) );
		die;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $funnel_id, $step_id, $step_product_id ) {
		$stepProduct            = StepProduct::find( $step_product_id );
		$stepProduct->funnel_id = $funnel_id;
		$stepProduct->step_id   = $step_id;
		//$stepProduct->product_id = $request->input('product_id');
		$stepProduct->product_type = $request->input( 'product_type' );
		$stepProduct->details      = json_encode( $request->input( 'product_id' ) );
		//$stepProduct->email_options = json_encode( array() );
		$stepProduct->created_at = date( 'Y-m-d h:i:s' );
		$stepProduct->created_at = date( 'Y-m-d h:i:s' );
		$stepProduct->save();

		$funnel             = Funnel::find( $funnel_id );
		$funnel->updated_at = date( 'Y-m-d h:i:s' );
		$funnel->save();

		//echo view( 'funnels.products.list_item', array('stepProduct' => $stepProduct) );

		die;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Request $request, $funnel_id, $step_id, $step_product_id ) {
		//echo 'destroy';

		//$stepProduct = StepProduct::where('funnel_id', $funnel_id)->where('step_id', $step_id)->first();
		$stepProduct = StepProduct::find( $request->input( 'step_product_id' ) );
		$stepProduct->delete();

		$funnel             = Funnel::find( $funnel_id );
		$funnel->updated_at = date( 'Y-m-d h:i:s' );
		$funnel->save();

		die( json_encode(
			array(
				'status'  => 200,
				'message' => 'Product has removed from step'
			)
		) );
	}


	public function addBumpProduct( Request $request, $step_id ) {


	}


	public function ajaxGetProductList( $funnel_id, $step_id ) {

		/*$funnel = Funnel::find($funnel_id);
		$steps   = FunnelStep::where('funnel_id', $funnel_id)->get();
		$currentStep = FunnelStep::find($step_id);
		$page = Page::where('funnel_id', $funnel->id)->where('funnel_step_id', $step_id)->get()->first();
		$funnelTypes = FunnelType::orderBy('name')->get();
		$products = Product::where('funnel_id', $funnel_id)->where('funnel_step_id', $step_id)->orderBy('id', 'desc')->get();*/

		$stepProducts = StepProduct::where( 'funnel_id', $funnel_id )->where( 'step_id', $step_id )->orderBy( 'id', 'desc' )->get();

		echo view( 'editor.widgets.frontend.product_list', array( 'stepProducts' => $stepProducts ) );
	}


	//Manual product list show ............. //
	public function getProductList( Request $request, $step_id ) {

		$data['products'] = Product::where( 'user_id', Auth::id() )->orderBy( 'id', 'desc' )->get();

		/*foreach ( $data['products'] as $product ) {
			echo $product->name; die;
		}*/

		$step = FunnelStep::find( $step_id );

		$data['funnel_id'] = $step->funnel_id;
		$data['step_id']   = $step->id;

		if ( ! empty( $request->input( 'step_product_id' ) ) ) {
			$data['stepProduct'] = StepProduct::find( $request->input( 'step_product_id' ) );
		}

		echo view( 'product.manual-product-list' )->withData( $data );
	}

	//Manual product list show ............. //
	public function getBumpProductList( Request $request, $step_id ) {

		$data 				= array();
		$data['type'] 		= $request->input( 'type' );
		$funneProductlStep 	= get_funnel_step($step_id); // get the 'Product' step by default	
		$step				= FunnelStep::find( $step_id );
		$stepProduct    	= StepProduct::where( 'step_id', $funneProductlStep->id )->first();	
		

		/*if ( $data['type'] == 'manual' ) {

			$products = Product::where( 'user_id', Auth::user()->id )
			                   ->orderBy( 'id', 'desc' )->get();

			
			$details          = json_decode( $stepProduct->details );
			$data['products'] = array();

			foreach ( $products as $product ) {

				//if ( intval($details->product_id) != $product->id )
				array_push( $data['products'], (object) $product );
			}

			//echo '<pre>'; print_r($data['products']); die;

			//$data['products'] = $products;

			// $step              = FunnelStep::find( $step_id );
			$data['funnel_id'] = $step->funnel_id;
			$data['step_id']   = $step->id;

		} else {

			//echo $request->input('type'); die;

			$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();
			// $stepProduct     = StepProduct::where( 'step_id', $step_id )->first();
			$details         = json_decode( $stepProduct->details );

			//echo $userIntegration; die;

			if ( ! empty( $userIntegration ) ) {

				$json         = json_decode( $userIntegration->details );
				$API_KEY      = $json->api_key;
				$API_PASSWORD = $json->password;
				$SECRET       = $json->shared_secret;
				$store_name   = $json->name;

				$step              = FunnelStep::find( $step_id );
				$data['funnel_id'] = $step->funnel_id;
				$data['step_id']   = $step->id;

				//die($url);
				$url      = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products.json";
				$products = json_decode( file_get_contents( $url ) );
				//echo '<pre>'; print_r($products); die;
				$data['products'] = array();
				foreach ( $products->products as $product ) {

					//if ( $details->product_id != $product->id )
					array_push( $data['products'], (object) $product );
				}

				//print_r($data['products']); die;
			}
		}*/

		//print_r($data); die;

		echo view( 'product.bump-product-list' )->withData( $data );
	}


	//Shopify
	public function getShopifyProductList( Request $request ) {

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'https://example.com/student_list.php' );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		$response = curl_exec( $ch );
		$result   = json_decode( $response );

		echo '<pre>';
		print_r( $result );
		die;
	}


	public function getShopifyProduct( $product_id ) {

		$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();
		$json            = json_decode( $userIntegration->details );

		$API_KEY      = $json->api_key;
		$API_PASSWORD = $json->password;
		$SECRET       = $json->shared_secret;
		$store_name   = $json->name;

		//https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json
		//https://44f9a6f160d07787d6520b502299c160:6bbe909017cfc20f4402514271807c83@shobaan.myshopify.com/admin/orders.json
		//die($url);

		if ( $product_id != 'undefined' ) {
			$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . ".json";

			//print_r(file_get_contents( $url )); die;
			try {
				$shopify_json_data = file_get_contents( $url );
				$shopify_data      = json_decode( $shopify_json_data );
			} catch ( Exception $exception ) {
				$shopify_data = array();
			}
		} else {
			$shopify_data = array();
		}

		return $shopify_data;
	}


	public function getStepProductDetails( Request $request ) {

		$product_id = $request->input( 'product_id' );
		$funnel_id  = $request->input( 'funnel_id' );
		$step_id    = $request->input( 'step_id' );

		$data['stepProduct']      = $stepProduct = StepProduct::where( 'step_id', $step_id )->first();
		$data['userIntegrations'] = UserIntegration::where( 'service_type', '!=', 'shopify' )->orderBy( 'service_type' )->get();

		if ( ! empty( json_decode( $stepProduct->details )->integration->integration_method ) ) {
			$data['userIntegration']  = UserIntegration::find( json_decode( $stepProduct->details )->integration->integration_method );
			$data['integrationLists'] = json_decode( app( 'App\Http\Controllers\IntegrationController' )->fetchList( $request, $data['userIntegration']->id, false ) );
			$data['list_lead']        = json_decode( $stepProduct->details )->integration->list_lead;
		}

		if ( $stepProduct->product_type == 'shopify' ) {

			$data['product'] = $this->getShopifyProduct( json_decode( $stepProduct->details )->product_id );
		} else {

			$data['product'] = Product::find( json_decode( $step_id->details )->product_id );
		}

		die(
		json_encode(
			array(
				'status' => 'success',
				'html'   => View::make( 'product.edit_details', array( 'data' => $data ) )->render()
			)
		)
		);
	}


	public function loadProducts( Request $request, $funnel_id ) {

		//print_r($_POST);

		$funnel = Funnel::find( $funnel_id );

		if ( $funnel->type == 'manual' ) {

			//load manual products
			$data['type']     = 'manual';
			$data['products'] = Product::where( 'user_id', Auth::user()->id )->orderBy( 'name' )->get();
		} else {

			//load shopify products
			$data['type']     = 'shopify';
			$data['products'] = $this->getShopifyProducts( $request->input( 'step_id' ) );
		}

		die(
		json_encode(
			array(
				'status' => 'success',
				'html'   => View::make( 'funnels.products.product_list', array( 'data' => $data ) )->render()
			)
		)
		);

	}


	public function getProductVariants( Request $request, $funnel_id, $product_id ) {

		$funnel = Funnel::find( $funnel_id );
		//echo $funnel;

		$data['type'] = $funnel->type;

		if ( $funnel->type == 'manual' ) {
			$data['product'] = Product::find( $product_id );
		} else {
			$data['product'] = $this->getShopifyProduct( $product_id );
		}

		die(
		json_encode(
			array(
				'status' => 'success',
				'html'   => View::make( 'funnels.products.product_variants', array( 'data' => $data ) )->render()
			)
		)
		);

	}


	public function getVariantDetails( Request $request, $product_id ) {

		$this->getImageVarient( $request, $product_id );
		//echo "hello";
	}


	private function getShopifyProducts( $step_id ) {

		$data            = array();
		$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();

		if ( ! empty( $userIntegration ) ) {

			$json = json_decode( $userIntegration->details );

			$API_KEY      = $json->api_key;
			$API_PASSWORD = $json->password;
			$SECRET       = $json->shared_secret;
			$store_name   = $json->name;

			$url              = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products.json";
			$data['products'] = json_decode( file_get_contents( $url ) );

			return $data['products']->products;
		}
	}


	private function getImageVarient( Request $request, $product_id ) {
		$funnel = Funnel::find( $request->input( 'funnel_id' ) );

		if ( $funnel->type == 'manual' ) {
			$product  = Product::find( $product_id );
			$variants = $product->options;

			//print_r($variants); die;

			if ( ( ! empty( $variants ) ) && ( $variants->count() > 0 ) ) {
				$data = $this->findMatch( $request, $variants );

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
				if ( ! empty( $product ) ) {
					die(
					json_encode(
						array(
							'status'     => 'success',
							'image'      => json_decode( $product->images )->main,
							'available'  => ( $product->quantity >= $request->input( 'quantity' ) ),
							'price'      => [
								number_format( $product->price, 2 ),
								'$' . number_format( $product->price, 2 )
							],
							'variant_id' => array()

						)
					)
					);
				} else {
					die(
					json_encode(
						array(
							'status'     => 'success',
							'available'  => ( $product->quantity >= $request->input( 'quantity' ) ),
							'price'      => [
								number_format( $product->price, 2 ),
								'$' . number_format( $product->price, 2 )
							],
							'variant_id' => array()
						)
					)
					);
				}
			}


		} else {
			$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();
			$data            = array();

			if ( ! empty( $userIntegration ) ) {

				$json = json_decode( $userIntegration->details );
				//$url = "https://" . $json->name . ".shopify.com/admin/products.json";

				$API_KEY      = $json->api_key;
				$API_PASSWORD = $json->password;
				$SECRET       = $json->shared_secret;
				$store_name   = $json->name;

				$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/variants.json";

				$varients = json_decode( file_get_contents( $url ) );

				$data = $this->findMatch( $request, $varients, 'shopify', $product_id );
			}

			if ( $data !== false ) {
				die(
				json_encode(
					array(
						'status'     => 'success',
						'image'      => $data[0],
						'available'  => $data[1],
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


	/////////////////////////////////////////////////////////////////////////////////
	private function findMatch( Request $request, $variants, $type = 'manual', $product_id = null ) {

		$found = false;

		//print_r($_POST);

		if ( $type === 'manual' ) {
			$variant_options = json_decode( $variants->first() );
			//print_r(json_decode($variant_options->options)->options); die;
			$variant_options = json_decode( $variant_options->options, true )['options'];

			foreach ( $variants as $variant ) {

				$options = json_decode( $variant->options, true );

				if ( count( $request->input( 'product_options' ) ) == 3 ) {
					if ( ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][0] ) ] == $options[ strtolower( $variant_options['option_name'][0] ) ] ) && ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][1] ) ] == $options[ strtolower( $variant_options['option_name'][1] ) ] ) && ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][2] ) ] == $options[ strtolower( $variant_options['option_name'][2] ) ] ) ) {
						return [ $variant->image, $options['inventory'], $options['price'], $variant->id ];
					}
				} elseif ( count( $request->input( 'product_options' ) ) == 2 ) {
					if ( ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][0] ) ] == $options[ strtolower( $variant_options['option_name'][0] ) ] ) && ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][1] ) ] == $options[ strtolower( $variant_options['option_name'][1] ) ] ) ) {
						return [ $variant->image, $options['inventory'], $options['price'], $variant->id ];
					}
				} else {
					if ( ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][0] ) ] == $options[ strtolower( $variant_options['option_name'][0] ) ] ) ) {
						return [ $variant->image, $options['inventory'], $options['price'], $variant->id ];
					}
				}
			}
		} else {

			$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();


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
						return [ $data['image']->image->src, $variant->inventory_quantity, $variant->id ];
					}
				}
			}
		}

		return false;
	}


	public function searchFunnelProducts( Request $request, $funnel_id ) {

		$funnel            = Funnel::find( $funnel_id );
		$data['funnel_id'] = $funnel_id;
		$data['step_id']   = $request->input( 'step_id' );

		if ( $funnel->type == 'manual' ) {

			$data['products'] = $this->searchManualProducts( $request, $request->input( 'keyword' ) );
			//echo view( 'product.manual-product-list' )->withData( $data );
			die(
			json_encode(
				array(
					'status' => 'success',
					'html'   => View::make( 'product.manual-product-list', array( 'data' => $data ) )->render()
				)
			)
			);

		} else {

			if ( $_POST['action'] != 'step_product_remove' ) {
				$data['products'] = $this->searchManualProducts( $request, $request->input( 'keyword' ) );
			}

			//$data['products'] = $this->searchShopifyProducts( $request->input( 'keyword' ) );
		}
	}


	private function searchManualProducts( Request $request=NULL, $keyword = '' ) {

		//DB::enableQueryLog();

		if ( $_POST['action'] != 'step_product_remove' ) {
			//$products = Product::where( 'user_id', '=', Auth::user()->id )->orderBy( 'name' );
			$products = Product::where( 'user_id', Auth::user()->id )
				//->where('LOWER(name)', 'like', strtolower($keyword))
				               ->where( 'name', 'LIKE', '%' . strtolower( $keyword ) . '%' )
			                   ->orderBy( 'id', 'DESC' )->get();

			//dd(DB::getQueryLog()); die;
			return $products;
		} else {
			$this->removeStepProducts($request, $_POST['step_id']);
		}
	}


	public function removeStepProducts( Request $request, $step_id ) {

		$step         = FunnelStep::find( $step_id );
		$funnel       = Funnel::find( $step->funnel_id );
		$stepProducts = StepProduct::where( 'step_id', $step_id )
		                           ->get();


		if ( count( $stepProducts ) > 0 ) {

			foreach ( $stepProducts as $stepProduct ) {

				$curStep = StepProduct::where('step_id', $stepProduct->step_id);
				$curStep->delete();
			}

			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'product.index', array( $funnel->id, $step->id ) )
				)
			)
			);
		} else {
			die(
			json_encode(
				array(
					'status'  => 'error',
					'message' => "Something is wrong! Please try again later."
				)
			)
			);
		}
	}
}
