<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use View;
use App\Models\Page;
use App\Models\Funnel;
use App\Models\Product;
use App\Models\FunnelStep;
use App\Models\FunnelType;
use App\Models\ProductOption;
use App\Models\UserShop;
use App\Models\UserIntegration;
use App\Models\ProductPayment;
use App\Models\StepProduct;

use Auth;
use Session;


class ProductController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$products = Product::where( 'user_id', Auth::id() )->orderBy( 'id', 'desc' )->paginate( 15 );

		return view( 'product.list', array( 'products' => $products ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( 'product.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//product image
		$images = array();
		if ( ! empty( $request->input( 'image' ) ) ) {
			$images['main'] = $request->input( 'image' );
		}

		if ( ! empty( $request->input( 'additionsals' ) ) ) {
			foreach ( $request->input( 'additionsals' ) as $additional ) {
				$images['additionals'][] = $additional;
			}
		}

		//echo '<pre>'; print_r($_POST); die;

		$product              = new Product;
		$product->user_id     = Auth::id();
		$product->name        = $request->input( 'name' );
		$product->description = $request->input( 'description' );
		$product->sku         = $request->input( 'sku' );
		$product->price       = $request->input( 'price' );
		$product->quantity    = $request->input( 'quantity' );
		//$product->details = $request->input('details');
		$product->images       = json_encode( $images );
		$product->product_type = 'manual';
		$product->status       = true;
		$product->created_at   = date( 'Y-m-d h:i:s' );
		$product->created_at   = date( 'Y-m-d h:i:s' );
		$product->save();

		//product varients
		$varients = array();

		if ( ! empty( $request->input( 'variants' ) ) ) {

			foreach ( $request->input( 'variants' ) as $key => $variant ) {
				$options      = explode( ',', $variant );
				$variant_data = array();

				foreach ( $options as $opk => $option ) {
					$variant_data[ strtolower( $request->input( 'option_name' )[ $opk ] ) ] = $option;
				}

				$variant_data['price']     = $request->input( 'option_price' )[ $key ];
				$variant_data['sku']       = $request->input( 'option_sku' )[ $key ];
				$variant_data['inventory'] = $request->input( 'option_inventory' )[ $key ];

				$variant_data['options'] = array(
					'option_name'  => $request->input( 'option_name' ),
					'option_value' => $request->input( 'option_value' )
				);

				//echo json_encode($variant_data);

				$productOption             = new ProductOption;
				$productOption->product_id = $product->id;
				$productOption->options    = json_encode( $variant_data );
				$productOption->image      = ( ! empty( $request->input( 'varient_image' )[ $key ] ) ) ? $request->input( 'varient_image' )[ $key ] : null;
				$productOption->save();
			}
		}

		//echo view( 'funnels.products.list_item', array('product' => $product) );
		die ( json_encode(
			array(
				'status' => 200,
				'url'    => route( 'products.index' )
			)
		) );
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
		$product  = Product::find( $id );
		$options  = ProductOption::where( 'product_id', $product->id )->first();
		$variants = ProductOption::where( 'product_id', $product->id )->get();

		//echo $product;
		return view( 'product.edit', array( 'product' => $product, 'options' => $options, 'variants' => $variants ) );
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
		//echo '<pre>'; print_r($request->all()); die;

		//product image
		$images = array();
		if ( ! empty( $request->input( 'image' ) ) ) {
			$images['main'] = $request->input( 'image' );
		}

		if ( ! empty( $request->input( 'additionsals' ) ) ) {
			foreach ( $request->input( 'additionsals' ) as $additional ) {
				$images['additionals'][] = $additional;
			}
		}

		$product              = Product::find( $id );
		$product->name        = $request->input( 'name' );
		$product->description = $request->input( 'description' );
		$product->sku         = $request->input( 'sku' );
		$product->price       = $request->input( 'price' );
		$product->quantity    = $request->input( 'quantity' );
		//$product->details = $request->input('details');
		$product->images       = json_encode( $images );
		$product->product_type = 'manual';
		$product->status       = true;
		$product->created_at   = date( 'Y-m-d h:i:s' );
		$product->created_at   = date( 'Y-m-d h:i:s' );
		$product->save();

		//product varients
		$varients               = array();
		$product_variant_option = array();

		if ( ! empty( $request->input( 'variants' ) ) ) {

			//remove all past variants
			$productOptions = ProductOption::where( 'product_id', $id )->get();
			foreach ( $productOptions as $option ) {
				$product_variant_option = json_decode( $option->options, true ); //
				$productOption          = ProductOption::find( $option->id );
				$productOption->delete();
			}

			/*//$variants = current($request->input('variants'));

			foreach ( $request->input('variants') as $opk=>$variant_option ) {
				foreach ( $variant_option as $key => $variant ) {
					$variant_data[ strtolower( $opk ) ][] = $variant;
				}
			}

			echo '<pre>'; print_r($variant_data); die;*/

			//echo '<pre>'; print_r($product_variant_option); die;

			foreach ( $request->input( 'variants' ) as $key => $variant ) {
				$options      = explode( ',', $variant ); //XL,Red
				$variant_data = array();

				foreach ( $options as $opk => $option ) {
					if ( ! empty( $request->input( 'option_name' ) ) ) {
						$variant_data[ strtolower( $request->input( 'option_name' )[ $opk ] ) ] = $option;
					} else {
						$variant_data[ strtolower( $product_variant_option['options']['option_name'][ $opk ] ) ] = $option;
					}
				}

				$variant_data['price']     = $request->input( 'option_price' )[ $key ];
				$variant_data['sku']       = $request->input( 'option_sku' )[ $key ];
				$variant_data['inventory'] = $request->input( 'option_inventory' )[ $key ];

				if ( ! empty( $request->input( 'option_name' ) ) ) {
					$variant_data['options'] = array(
						'option_name'  => $request->input( 'option_name' ),
						'option_value' => $request->input( 'option_value' )
					);
				} else {
					$variant_data['options'] = array(
						'option_name'  => $product_variant_option['options']['option_name'],
						'option_value' => $product_variant_option['options']['option_value']
					);
				}

				//echo '<pre>'; print_r($variant_data); die;

				//echo '<pre>'; print_r($variant_data);

				//echo json_encode($variant_data);

				$productOption             = new ProductOption;
				$productOption->product_id = $product->id;
				$productOption->options    = json_encode( $variant_data );
				$productOption->image      = ( ! empty( $request->input( 'varient_image' )[ $key ] ) ) ? $request->input( 'varient_image' )[ $key ] : asset( 'global/img/products/no-images.png' );
				$productOption->save();
			}
		}

		//echo view( 'funnels.products.list_item', array('product' => $product) );
		die ( json_encode(
			array(
				'status' => 200,
				'url'    => route( 'products.index' )
			)
		) );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $product_id ) {
		//echo 'destroy';

		$product = Product::find( $product_id );
		$product->delete();

		echo json_encode(
			array(
				'status'  => 200,
				'message' => 'Product has removed'
			)
		);

		die;
	}


	function str_special_underscore( $str ) {
		$str = preg_replace( "[^a-z0-9\040]", "", str_replace( "_", " ", $str ) );
		$str = preg_replace( "[\040]+", "_", trim( $str ) );

		return strtolower( $str );
	}


	public function removeVariantDetails( Request $request, $product_id, $variant_id ) {

		$productOption = ProductOption::find( $variant_id );

		if ( $productOption->delete() ) {

			die ( json_encode(
				array(
					'status'  => 'success',
					'message' => 'Product variant has been removed'
				)
			) );
		} else {
			die ( json_encode(
				array(
					'status'  => 'error',
					'message' => 'ERROR! Please try again later'
				)
			) );
		}
	}



	//edit varient details
	/*public function editVariantDetails($variant_id) {


	}*/


	public function ajaxGetProductList( $funnel_id, $step_id ) {

		$funnel      = Funnel::find( $funnel_id );
		$steps       = FunnelStep::where( 'funnel_id', $funnel_id )->get();
		$currentStep = FunnelStep::find( $step_id );
		$page        = Page::where( 'funnel_id', $funnel->id )->where( 'funnel_step_id', $step_id )->get()->first();
		$funnelTypes = FunnelType::orderBy( 'name' )->get();
		$products    = Product::where( 'funnel_id', $funnel_id )->where( 'funnel_step_id', $step_id )->orderBy( 'id', 'desc' )->get();

		echo view( 'editor.widgets.frontend.product_list', array( 'products' => $products ) );
	}


	public function editorGetProductList() {

		$products = Product::orderBy( 'id', 'desc' )->get();

		echo view( 'editor.widgets.backend.editor_product_list', array( 'products' => $products ) );
	}


	public function getProductDetailsEditorView( $product_id ) {

		$product = Product::find( $product_id );
		echo view( 'editor.widgets.product.details', array(
			'product' => $product,
			'id'      => 'elements_text_block' . time()
		) );
	}


	public function productImageUpload( request $request ) {

		//die ("hello");

		$validator = Validator::make( $request->all(), [
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		] );

		if ( $validator->passes() ) {

			@mkdir( 'global/img/products/' );

			$input          = $request->all();
			$input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
			$request->image->move( public_path( 'global/img/products/' ), $input['image'] );

			//AjaxImage::create($input);

			//'url' => asset('asset/Timthumb.php?src=') . asset('global/img/products/' . $input['image'] . '&w=640&h=480')

			echo json_encode(
				array(
					'success' => 'done',
					'url'     => asset( 'global/img/products/' . $input['image'] )
				)
			);
		} else {
			echo response()->json( [ 'error' => $validator->errors()->all() ] );
		}

		die;
	}


	public function productVarientImageUpload( request $request ) {

		//die ("hello");

		$validator = Validator::make( $request->all(), [
			'varient_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		] );

		if ( $validator->passes() ) {

			$cache_dir = "images/cache";
			$image_dir = "global/img/products/";

			@mkdir( $cache_dir );

			$input                  = $request->all();
			$input['varient_image'] = time() . '.' . $request->varient_image->getClientOriginalExtension();
			$request->varient_image->move( public_path( $image_dir . '/' ), $input['varient_image'] );
			//@copy(public_path($image_dir), public_path($cache_dir . '/') . $input['varient_image']);

			//AjaxImage::create($input);

			echo json_encode(
				array(
					'success' => 'done',
					'url'     => asset( $image_dir . $input['varient_image'] ),
					'image'   => public_path( $image_dir ) . $input['varient_image']
				)
			);
		} else {
			echo response()->json( [ 'error' => $validator->errors()->all() ] );
		}

		die;
	}


	public function removeProductVarient( $varient_id ) {

		$productOption = ProductOption::find( $varient_id );
		$productOption->delete();

		die (
		json_encode(
			array(
				'status' => 200,
			)
		)
		);
	}


	public function productCheckout( Request $request ) {

		//echo '<pre>'; print_r($_POST); die;

		$data['cart'] = array();

		$funnelStep  = FunnelStep::find( $request->input( 'frm_hid_funnel_step_id' ) );
		$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();


		if ( $stepProduct->product_type == 'manual' ) {
			$product         = Product::find( json_decode( $stepProduct->details )->product_id );
			$product_variant = ProductOption::find( $request->input( 'hid_product_variant_id' ) );

			$variant_title = "";

			foreach ( json_decode( $product_variant->options ) as $key => $option ) {

				if ( $key == 'price' ) {
					break;
				}

				$variant_title = $option . ',';
			}

			$variant_title = trim( $variant_title, ',' );


			//Prepare the cart info
			$data['cart'] = array(
				'products'  => array(
					array(
						'product_id' => $product->id,
						'title'      => $product->name,
						'image'      => json_decode( $product->images )->main,
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
							'$' . number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 ),
							number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 )
						]
					)
				),
				'sub_total' => [
					'$' . number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 ),
					number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 )
				],
				'shipping'  => 'Free',
				'total'     => [
					'$' . number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 ),
					number_format( ( json_decode( $product_variant->options )->price * $request->input( 'product_quantity' ) ), 2 )
				]
			);

		} else {
			//Get the product
			$product = $this->getShopifyProduct( json_decode( $stepProduct->details )->product_id );

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

			//Prepare the cart info
			$data['cart'] = array(
				'products' => array(
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
							'$' . number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 ),
							number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 )
						]
					)
				),

				'sub_total' => [
					'$' . number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 ),
					number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 )
				],
				'shipping'  => 'Free',
				'total'     => [
					'$' . number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 ),
					number_format( ( $product_variant->price * $request->input( 'product_quantity' ) ), 2 )
				]
			);
		}

		$next_url = $this->getNextStep( $request->input( 'page_id' ) );
		//print_r($next_url); die;

		//Session::put('product_checkout_product', $data);

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


	private function getNextStep( $page_id ) {

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
	}


	public function getProductCartInfo( $product_id ) {

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


	/*public function getProductCartInfo($product_id)
	{

		//print_r($product_id); die;

		if (Session::has('product_cart')) {

			//$pdata = Session::get('product_checkout_details');

			$cart = Session::get('product_cart');



			$data['stepProduct'] = $stepProduct = StepProduct::where('step_id', $cart['cart']['step'])->first();

			if ( $stepProduct->product_type == 'manual' ) {
				$data['product'] = Product::find($cart['cart']['product_id']);

				$data['product_variant_image'] = NULL;

				//varient Image
				foreach ( $data['product']->options as $option ) {
					if ( $option->id ==  $cart['cart']['product_variant_id'] ) {
						$data['product_variant_image'] = $option->image;
					}
				}

			} else {
				$data['product'] = $this->getShopifyProduct(json_decode($stepProduct->details)->product_id);
			}

			//Quantity
			$data['product_quantity'] = (!empty($cart['cart']['product_quantity'])) ? $cart['cart']['product_quantity'] : 1;




			if ( $stepProduct->product_type == 'manual' ) {
				$option_str = "";

				foreach ($cart['cart']['product_options'] as $option)
					$option_str .= $option . ', ';

				$data['product_options'] = trim($option_str, ', ');
				$data['product_price'] = number_format(doubleval($cart['cart']['product_price'] * $cart['cart']['product_quantity']), 2);
			} else {

				//fetch variant title
				$data['product_variant'] = $this->getProductVariant(json_decode($stepProduct->details)->product_id, $cart['cart']['product_variant_id']);
				$data['product_variant_image'] = $this->getProductImage(json_decode($stepProduct->details)->product_id, $data['product_variant']->variant->image_id);

				$data['product_price'] = number_format(doubleval($data['product_variant']->variant->price * $data['product_quantity']), 2);

				//print_r($data['product_variant']); die;
			}

			echo json_encode(
				array(
					'status' => 'success',
					'html' => View::make('editor.widgets.frontend.product_cart', array('data' => $data))->render()
				)
			);

		} else {
			echo json_encode(
				array(
					'status' => 'error',
					'cart' => array()
				)
			);
		}
	}*/


	public function getImageVarient( Request $request ) {
		$stepProduct = StepProduct::where( 'step_id', $request->input( 'step_id' ) )->first();

		if ( $stepProduct->product_type == 'manual' ) {
			$product = Product::find( json_decode( $stepProduct->details )->product_id );
			//$variants = $product->options;
			$variants = $product->options;

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
			$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();


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

		//print_r($data); die;


		//die ($image);


	}


	private function findMatch( Request $request, $variants, $type = 'manual', $product_id = null ) {

		$found = false;

		if ( $type === 'manual' ) {
			$variant_options = json_decode( $variants->first() );
			//print_r(json_decode($variant_options->options)->options); die;
			$variant_options = json_decode( $variant_options->options, true )['options'];

			foreach ( $variants as $variant ) {

				$options = json_decode( $variant->options, true );

				if ( count( $variant_options ) == 3 ) {
					if ( ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][0] ) ] == $options[ strtolower( $variant_options['option_name'][0] ) ] ) && ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][1] ) ] == $options[ strtolower( $variant_options['option_name'][1] ) ] ) && ( $request->input( 'product_options' )[ strtolower( $variant_options['option_name'][2] ) ] == $options[ strtolower( $variant_options['option_name'][2] ) ] ) ) {
						return [ $variant->image, $options['inventory'], $options['price'], $variant->id ];
					}
				} elseif ( count( $variant_options ) == 2 ) {
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
						return [ $data['image']->image->src, $variant->inventory_quantity, $variant->price, $variant->id ];
					}

					/*if ( !empty($variant_options['option_name'][2]) ) {
						if ( ($variant->option1 == $variant_options['option_name'][0]) && ($variant->option2 == $variant_options['option_name'][1]) && ($variant->option3 == $variant_options['option_name'][2]) ) {
							if ($variant->image_id != null) {
								$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/images/" . $variant->image_id . ".json";
								$data['image'] = json_decode(file_get_contents($url));

								return [$data['image']->image->src, $variant->inventory_quantity];
							}
						} elseif ( !empty($variant_options['option_name'][1]) ) {

							if ( ($variant->option1 == $variant_options['option_name'][0]) && ($variant->option2 == $variant_options['option_name'][1]) ) {
								if ($variant->image_id != null) {
									$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/images/" . $variant->image_id . ".json";
									$data['image'] = json_decode(file_get_contents($url));

									return [$data['image']->image->src, $variant->inventory_quantity];
								}
							}

						} elseif ( !empty($variant_options['option_name'][0]) ) {
							if ( ($variant->option1 == $variant_options['option_name'][0]) ) {
								if ( $variant->image_id != null ) {
									$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/images/" . $variant->image_id . ".json";
									$data['image'] = json_decode(file_get_contents($url));

									return [$data['image']->image->src, $variant->inventory_quantity];
								}
							}
						}
					}*/
				}
			}
		}

		return false;
	}


	private function getShopifyProduct( $product_id ) {

		$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();
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

	private function getProductVariant( $product_id, $variant_id ) {

		//$userShop = UserShop::where('user_id', Auth::user()->id)->first();
		$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();
		$json            = json_decode( $userIntegration->details );

		$API_KEY      = $json->api_key;
		$API_PASSWORD = $json->password;
		$SECRET       = $json->shared_secret;
		$store_name   = $json->name;

		//https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

		//die($url);
		$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/variants/" . $variant_id . ".json";

		return json_decode( file_get_contents( $url ) );
	}

	private function getProductImage( $product_id, $image_id ) {

		$userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();
		$json            = json_decode( $userIntegration->details );

		$API_KEY      = $json->api_key;
		$API_PASSWORD = $json->password;
		$SECRET       = $json->shared_secret;
		$store_name   = $json->name;

		//https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

		//die($url);
		$url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/images/" . $image_id . ".json";

		return json_decode( file_get_contents( $url ) );
	}
}
