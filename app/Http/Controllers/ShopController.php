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

use View;
use Session;
use Mail;
use Storage;

class ShopController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
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


	/* ----------------------------------------- CUSTOMS ---------------------------------------------- */
	public function showPage( Request $request, $slug = null ) {

		$data = array();

		if ( empty( $request->except( '_token' ) ) ) {

			$page                = Page::where( 'slug', $slug )->first();
			$contents            = json_decode( $page->content );
			$data['funnelStep']  = $funnelStep = FunnelStep::find( $page->funnel_step_id );
			$data['$funnelType'] = $funneltype = FunnelType::find( $funnelStep->type );
			$funnelType          = $data['$funnelType'];

			switch ( strtolower( $funnelType->name ) ) {

				case 'sales' :
				case 'downsell' :
				case 'upsell'   :
					$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();
					break;

				case 'order':
					//$prevStep    = $this->getPreviousStep( $page->funnel_id, $page->funnel_step_id );
					//$stepProduct = StepProduct::where( 'step_id', $prevStep->id )->first();
					break;


				case 'product'   :
					$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();
					break;
			}


			$data['action'] = route( 'page.view.post', $slug );

			return view( "builder.page_template_view", compact( 'page', 'data', 'contents' ) );
		} else {

			/*echo '<pre>';
			print_r($request->all()); die;*/

			$funnel      = Page::find( $request->input( 'funnel_id' ) );
			$page        = Page::find( $request->input( 'page_id' ) );
			$funnelStep  = FunnelStep::find( $request->input( 'step_id' ) );
			$stepProduct = StepProduct::find( $funnelStep->step_id );
			$funnelType  = FunnelType::find( $funnelStep->type );

			// if other product is order rather than step's product
			if ( $funnel->type == 'manual' ) {
				if ( ! empty( $request->input( 'product_id' ) ) ) {
					$product = Product::find( $request->input( 'product_id' ) );
				}
			} else {
				$product = array();
			}

			//for product page submit
			if ( strtolower( $funnelType->name ) == 'product' ) {

				//if ( empty( $request->input( 'product_id' ) ) ) {

				if ( $funnel->type == 'manual' ) {
					if ( empty( $product ) ) {
						$details = json_decode( $stepProduct->details );
						$product = Product::find( $details->product_id );
					}

					//if variant id is present, by default choose the first option as variant if present
					if ( ! empty( $request->input( 'hid_product_variant_id' ) ) ) {

						$productVariant = ProductOption::find( $request->input( 'hid_product_variant_id' ) );
						$this->createCart( $request, $stepProduct, $product, $productVariant );

					} else {

						//default variant
						$productVariant = ProductOption::where( 'product_id', $product->id )
						                               ->first();
						if ( ! empty( $productVariant ) ) {
							$this->createCart( $request, $stepProduct, $product, $productVariant );
						} else {
							$this->createCart( $request, $stepProduct, $product );
						}
					}
				}
				/*} else {
					if ( $funnel->type == 'manual' ) {
						$this->createCart( $stepProduct, $product );
					}
				}*/

			} elseif ( strtolower( $funnelType->name ) == 'order' ) {

			} elseif ( strtolower( $funnelType->name ) == 'upsell' ) {

			} elseif ( strtolower( $funnelType->name ) == 'downsell' ) {

			} elseif ( strtolower( $funnelType->name ) == 'confirmation' ) {

			}


			$action = $this->getNextStepURL( $funnelStep );

			die( json_encode(
				array(
					'status' => 'success',
					'url'    => $action
				)
			) );
		}
	}


	/*
	 * Create or prepare CART for Order payment and store it in a session called session_shop_cart
	 */
	private function createCart( $request, $stepProduct, $product, $variant = array() ) {

		if ( Session::has( 'session_shop_cart' ) ) {
			$session_shop_cart = Session::get( 'session_shop_cart' );
		} else {
			$session_shop_cart = array();
		}

		$image = json_decode( $product->images );

		$session_shop_cart['cart']               = array();
		$session_shop_cart['cart']['products']   = array();
		$session_shop_cart['cart']['products'][] = array(
			'product_id'       => $product->id,
			'product_name'     => $product->name,
			'product_image'    => ( ! empty( $image ) ) ? $image->main : '',
			'product_type'     => $stepProduct->product_type,
			'product_amount'   => $product->price,
			'product_quantity' => $request->input( 'product_quantity' ),
			'sub_total'        => doubleValue( $product->price ) * intval( $request->input( 'product_quantity' ) ),
			'total'            => doubleValue( $product->price ) * intval( $request->input( 'product_quantity' ) ),
			'bump'             => array(),
			'coupon'           => array()
		);

		//calculate grand total
		$sub_total = 0.00;
		$total     = 0.00;
		$tax       = 0.00;

		foreach ( $session_shop_cart['cart']['products'] as $cart_item ) {

			$sub_total += $cart_item['sub_total'];
			$total     += $cart_item['total'];
		}

		$session_shop_cart['cart']['totals'] = array(
			'sub_total' => $sub_total,
			'tax'       => $tax,
			'total'     => $total
		);

		Session::save();

		return $session_shop_cart;
	}


	/*
	 * Generate next step URL depending on the funnel steps
	 */
	private function getNextStepURL( $funnelStep ) {

		$nextFunnelStep = FunnelStep::where( 'funnel_id', $funnelStep->funnel_id )
		                            ->where( 'order_position', '>', $funnelStep->order_position )
		                            ->orderBy( 'order_position' )
		                            ->first();

		$page = Page::where( 'funnel_id', $nextFunnelStep->funnel_id )
		            ->where( 'funnel_step_id', $nextFunnelStep->id )
		            ->first();

		//if ( strtolower($funnelSteps->type->name) == '' ){}

		return route( 'page.view', $page->slug );
	}
}
