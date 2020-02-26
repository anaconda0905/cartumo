<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PageTemplate;
use App\Models\Page;
use App\Models\BaseUrl;
use App\Models\Widgets;
use App\Models\Product;
use App\Models\Funnel;
use App\Models\FunnelStep;
use App\Models\FunnelType;
use App\Models\UserGallery;
use Session;
use File;

use Image;
use Auth;
use Storage;
use App\Models\PageScreenshoot;
use App\Models\StepProduct;

class PagesController extends Controller {

	public function __construct() {
		$this->middleware( 'auth' );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( $slug ) {
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
	public function show( $id = null ) {
		$data = array();

		//echo $id; die;


		if ( $id ) {
			$pageTemplate = PageTemplate::find( $id );

			if ( ! empty( $pageTemplate ) ) {

				//if( $page )
				//{
				//decide action
				$data['action'] = array();

				$contents = json_decode( $pageTemplate->content );
				$sty      = json_decode( $pageTemplate->content );

				//print_r($contents); die;
				return view( "builder.page_template_show", [ "contents" => $contents, 'data' => $data ] );
				//}
			} else {
				return view( "builder.no_page_template_show" );
			}
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Request $request, $id = null ) {
		$data = array();

		//echo $flag; die;

		$page = Page::find( $id );
		if ( ! $page ) {
			return redirect()->route( 'funnels' )->with( 'error', 'Page not found.' );
		}

		$content  = $page->content;
		$imgSrc   = asset( BaseUrl::getPageTemplateUrl() );
		$contents = json_decode( $page->content );
		$widget   = new Widgets;
		$widgets  = $widget->getWidgetNames();

		$funnelStep = FunnelStep::where( 'id', $page->funnel_step_id )->where( 'funnel_id', $page->funnel_id )->first();
		$funnelType = FunnelType::find( $funnelStep->type );

		//echo $funnelStep; die;

		switch ( strtolower( $funnelType->name ) ) {

			case 'optin'   :
				$action      = route( 'optin.save' );
				$stepProduct = array();
				break;

			case 'sales' :
			case 'downsell' :
			case 'upsell'   :
				$action      = route( 'order.store' );
				$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();
				break;

			case 'order':
				$action      = route( 'order.store' );
				$prevStep    = $this->getPreviousStep( $page->funnel_id, $page->funnel_step_id );
				$stepProduct = StepProduct::where( 'step_id', $prevStep->id )->first();
				break;

			case 'product'   :
				$action      = route( 'products.checkout' );
				$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();
				break;

			default:
				$action = '';
		}
		//echo $stepProduct; die;

		//echo $funnelStep->id; die;

		//$stepProduct = $this->getProduct($page->funnel_id, $page->funnel_id);

		//echo $stepProduct->product_type ; die;
		if ( ! empty( $stepProduct ) ) {
			if ( $stepProduct->product_type == 'manual' ) {
				$data['stepProduct'] = Product::find( json_decode( $stepProduct->details )->product_id );
			} else {
				$data['stepProduct'] = json_decode( $stepProduct->details )->product_id;
			}
		} else {
			$data['stepProduct'] = null;
		}

		//echo $data['stepProduct']; die;

		//print_r($data['stepProduct']);        die;
		$userImages  = UserGallery::where( 'user_id', Auth::user()->id )->get();
		$files       = File::allFiles( public_path() . '/frontend/builder/images/gallery' );
		$directories = glob( public_path() . '/frontend/builder/images/gallery/*', GLOB_ONLYDIR );
		$libraryFiles = array();

		/*//bucket files
		$awsFiles = Storage::disk( 's3' )->files( 'library/' );
		//echo '<pre>'; print_r($awsFiles); die;
		$libraryFiles = array();

		foreach ( $awsFiles as $sfile ) {

			$libraryFiles[] = Storage::disk( 's3' )->url( $sfile );
		}*/

		//Page editor
		if ( strtolower( $funnelType->name ) != 'confirmation' ) {
			return view( 'builder.page_template', [
				'userImages'   => $userImages,
				'page'         => $page,
				'action'       => $action,
				'data'         => $data,
				'contents'     => $contents,
				'images'       => $files,
				'directories'  => $directories,
				'widgets'      => $widgets,
				'stepProduct'  => $stepProduct,
				'funnelType'   => $funnelType,
				'flag'         => $request->input( 'flag' ),
				'libraryFiles' => $libraryFiles
			] );
		} else {
			return view( 'builder.page_template', [
				'userImages'   => $userImages,
				'page'         => $page,
				'action'       => $action,
				'data'         => $data,
				'contents'     => $contents,
				'images'       => $files,
				'directories'  => $directories,
				'widgets'      => $widgets,
				'funnelType'   => $funnelType,
				'flag'         => $request->input( 'flag' ),
				'libraryFiles' => $libraryFiles
			] );
		}
	}


	public function updateTemplate( Request $request, $id = null ) {

		$data = array();

		//print_r($request->all()); die;

		$page = Page::find( $id );
		if ( ! $page ) {
			return redirect()->route( 'funnels' )->with( 'error', 'Page not found.' );
		}

		$content  = $page->content;
		$imgSrc   = asset( BaseUrl::getPageTemplateUrl() );
		$contents = json_decode( $page->content );
		$widget   = new Widgets;
		$widgets  = $widget->getWidgetNames();

		$funnelStep = FunnelStep::where( 'id', $page->funnel_step_id )->where( 'funnel_id', $page->funnel_id )->first();
		$funnelType = FunnelType::find( $funnelStep->type );

		//echo $funnelStep; die;

		switch ( strtolower( $funnelType->name ) ) {

			case 'sales' :
			case 'downsell' :
			case 'upsell'   :
				//$action      = route( 'order.store' );
				$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();
				break;

			case 'order':
				//$action      = route( 'order.store' );
				$prevStep    = $this->getPreviousStep( $page->funnel_id, $page->funnel_step_id );
				$stepProduct = StepProduct::where( 'step_id', $prevStep->id )->first();
				break;


			case 'product'   :
				//$action      = route( 'products.checkout' );
				$stepProduct = StepProduct::where( 'step_id', $funnelStep->id )->first();
				break;
		}

		$action = route( 'page.view', $page->slug );

		//echo $stepProduct->product_type ; die;
		if ( ! empty( $stepProduct ) ) {
			if ( $stepProduct->product_type == 'manual' ) {
				$data['stepProduct'] = Product::find( json_decode( $stepProduct->details )->product_id );

				/*$data['product']['images']      = json_decode( $data['stepProduct']->images );
				$data['product']['title']       = $data['product']->name;
				$data['product']['price']       = $data['product']->price;
				$data['product']['description'] = $data['product']->description;
				$data['product']['variants']    = app('App\Http\Controllers\ProductController')->getVariants();
				//$data['product']['variants']    = $this->getProductVariants();*/

			} else {
				$data['stepProduct'] = json_decode( $stepProduct->details )->product_id;
			}
		} else {
			$data['stepProduct'] = null;
		}

		//check auto update flag, if it's 'autoupdate' then set page's 'page_update_status' column to true
		if ( $request->input( 'flag' ) == 'autoupdate' ) {
			//$page->page_update_status = true;
			//$page->update();
		}

		if ( strtolower( $funnelType->name ) != 'confirmation' ) {
			return view( 'builder.page_template_update', [
				'page'        => $page,
				'action'      => $action,
				'data'        => $data,
				'contents'    => $contents,
				'widgets'     => $widgets,
				'stepProduct' => $stepProduct,
				'funnelType'  => $funnelType,
				'flag'        => 'autoupdate'
			] );
		} else {
			return view( 'builder.page_template_update', [
				'page'       => $page,
				'action'     => $action,
				'data'       => $data,
				'contents'   => $contents,
				'widgets'    => $widgets,
				'funnelType' => $funnelType,
				'flag'       => 'autoupdate'
			] );
		}
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
		/*$response = [
			'success' => null
		];

		if( $request->ajax() )
		{
			$page = Page::find($id);
			if( $page && isset($request->page['htmlbody']) )
			{
				$page->content = $request->$request->page['htmlbody'];
				if( $page->save() )
				{
					$response['success'] = 1;
				}
			}
		}

		return json_encode($response);*/

		//print_r($request->page); die;

		$page    = Page::find( $id );
		$content = str_replace( array( "\\n", "\\r\\n", "\\r" ), '', $request->page );
		//$content = str_replace(array("\\&"), '', $content);
		$page->content = $content;

		//echo $content; die;

		$response = json_encode( array( 'success' => $page->save() ) );


		$funnel             = Funnel::find( $page->funnel_id );
		$funnel->updated_at = date( 'Y-m-d h:i:s' );
		$funnel->save();

		die ( $response );

		//print_r($request->input());
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

	/**
	 * Takes a screen-shot of edited page
	 *
	 * @param  image data
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function saveThumbnail( Request $request ) {
		$response = [
			'success' => null
		];

		if ( $request->img && $request->page_id ) {
			$data      = $request->img;
			$file      = $request->page_id . '.png';
			$uri       = substr( $data, strpos( $data, "," ) + 1 );
			$file_path = base_path() . "/" . BaseUrl::getPageThumbnailUrl() . "/" . $file;
			if ( file_put_contents( $file_path, base64_decode( $uri ) ) ) {
				$response['success'] = 1;
			}
		}

		return json_encode( $response );
	}

	/**
	 * Uploads an image
	 *
	 * @param  image data
	 *
	 * @return URL of uploaded image
	 */
	public function ajax_uploadImage( Request $request ) {
		$response = [
			'success' => null
		];

		if ( $request->ajax() ) {
			// checking if file is not empty
			// ---------------------------------------------------
			if ( ! isset( $_FILES['image'] ) || ( $_FILES['image']['error'] > 0 ) ) {
				$response['message'] = "Sorry! File not found.";

				return json_encode( $response );
			}

			// checking if name is not empty
			// ---------------------------------------------------
			$imgName = $_FILES['image']['name'];
			$imgName = trim( $imgName );
			if ( ! $imgName ) {
				$response['message'] = "Sorry! Something is not right. Please save and reload the page and try again.";

				return json_encode( $response );
			}

			// checking extension
			// ---------------------------------------------------
			$allowedExtensions = [ "jpg", "jpeg", "png", "gif" ];
			$imgNameArr        = explode( '.', $imgName );
			$ext               = array_pop( $imgNameArr );
			$ext               = strtolower( $ext );
			if ( ! in_array( $ext, $allowedExtensions ) ) {
				$response['message'] = "Sorry! Only jpg, jpeg, png and gif extensions are allowed.";

				return json_encode( $response );
			}

			$name = microtime();
			$name = str_replace( ".", "", $name );
			$name = str_replace( " ", "", $name );

			/*define("DS", DIRECTORY_SEPARATOR);
			if(! (is_dir(public_path().DS."global".DS."uploads".DS."users".DS.Auth::id())) )
			{
				mkdir(public_path().DS."global".DS."uploads".DS."users".DS.Auth::id(), 0755);
			}*/

			if ( move_uploaded_file( $_FILES['image']['tmp_name'], public_path() . "/global/uploads/users/$name.$ext" ) ) {
				$response['success'] = 1;
				$response['src']     = asset( "public/global/uploads/users/$name.$ext" );
			}
		}

		return json_encode( $response );
	}


	public function showPage( $slug ) {

		//echo $slug; die;
		$data = array();

		$page = Page::where( 'slug', $slug )->first();

		//echo $page; die;

		//$this->show($page->id);


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


	public function getTemplateImage( Request $request ) {

		// /print_r($request->input('uri_load'));

		$html_content = file_get_contents( $request->input( 'uri_load' ) );
		$html2pdf     = new HTML2PDF( 'P', 'A4' );
		$html2pdf->writeHTML( $html_content );
		$file = $html2pdf->Output( 'temp.pdf', 'F' );

		$im = new imagick( 'temp.pdf' );
		$im->setImageFormat( "jpg" );
		$img_name = time() . '.jpg';
		$im->setSize( 800, 600 );
		$im->writeImage( $img_name );
		$im->clear();
		$im->destroy();

		die;
	}


	public function addTemplate( Request $request, $step_id ) {

		//echo $step_id;
		//print_r($request->input('page_template_id')); die;

		$template = PageTemplate::find( $request->input( 'page_template_id' ) );

		//print_r($template->content); die;

		$funnelStep = FunnelStep::find( $request->input( 'step_id' ) );

		$page                 = new Page;
		$page->funnel_id      = $request->input( 'funnel_id' );
		$page->funnel_step_id = $step_id;
		//$page->content = $template->content;
		$page->content = $template->content;
		$page->slug    = $funnelStep->slug;
		$page->image   = $template->image;
		//$page->created_at = date('Y-m-d h:i:s');
		//$page->updated_at = date('Y-m-d h:i:s');
		$page->save();

		$funnel             = Funnel::find( $request->input( 'funnel_id' ) );
		$funnel->updated_at = date( 'Y-m-d h:i:s' );
		$funnel->save();

		//print_r($page->content); die;

		echo json_encode( array( 'status' => 200, 'page_id' => $page->id ) );

		die;
	}


	public function removeTemplate( Request $request, $page_id ) {

		//echo $page_id;

		$page = Page::find( $page_id );
		$page->delete();

		$funnel             = Funnel::find( $page->funnel_id );
		$funnel->updated_at = date( 'Y-m-d h:i:s' );
		$funnel->save();

		echo json_encode(
			array(
				'status' => 200
			)
		);

		die;
	}


	public function getScreenshoot( $page_id ) {

		/*$page = Page::find($page_id);
		$content = json_decode($page->content);

		//print_r($content->htmlbody); die;

		echo $content->htmlbody;

		die;*/

		/*$url = route('pages.show', $page_id);
		echo $url; die;


		$URL2PNG_APIKEY = "P9CDC38DCFCDD5A";
		$URL2PNG_SECRET = "S_1D74819348F59";

		# urlencode request target
		$options['url'] = urlencode(urlencode($url));

		//$options += $args;

		# create the query string based on the options
		foreach ($options as $key => $value) {
			$_parts[] = "$key=$value";
		}

		# create a token from the ENTIRE query string
		$query_string = implode("&", $_parts);
		$TOKEN = md5($query_string . $URL2PNG_SECRET);

		return "https://api.url2png.com/v6/$URL2PNG_APIKEY/$TOKEN/png/?$query_string";*/

		$args['force']               = 'false';      # [false,always,timestamp] Default: false
		$args['fullpage']            = 'false';      # [true,false] Default: false
		$args['thumbnail_max_width'] = 'false';      # scaled image width in pixels; Default no-scaling.
		$args['viewport']            = "1280x1024";  # Max 5000x5000; Default 1280x1024


		$URL2PNG_APIKEY = "P9CDC38DCFCDD5A";
		$URL2PNG_SECRET = "S_1D74819348F59";
		$url            = route( 'pages.show', $page_id );

		# urlencode request target
		$options['url'] = urlencode( $url );

		$options += $args;

		# create the query string based on the options
		foreach ( $options as $key => $value ) {
			$_parts[] = "$key=$value";
		}

		# create a token from the ENTIRE query string
		$query_string = implode( "&", $_parts );
		$TOKEN        = md5( $query_string . $URL2PNG_SECRET );

		return "https://api.url2png.com/v6/$URL2PNG_APIKEY/$TOKEN/png/?$query_string";

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


	private function getProduct( $funnel_id, $currentFunnelStep = null ) {

		$funnelSteps       = FunnelStep::where( 'funnel_id', $funnel_id )->orderBy( 'order_position', 'asc' )->get();
		$currentFunnelType = FunnelType::find( $currentFunnelStep->type );

		//echo $funnelSteps; die;

		//echo

		if ( ( strtolower( $currentFunnelType->name ) != 'order' ) && ( strtolower( $currentFunnelType->name ) != 'confirmation' ) ) {
			$stepProduct = StepProduct::where( 'step_id', $currentFunnelStep->id )->first();

			if ( ! empty( $stepProduct ) ) {
				$product = Product::find( $stepProduct->product_id );

				return $product;
			}
		} else {
			foreach ( $funnelSteps as $step ) {

				$funnelType = FunnelType::find( $step->type );

				if ( strtolower( $funnelType->name ) == 'product' || strtolower( $funnelType->name ) == 'sales' ) {
					//echo $step; die;
					//return $step;

					$stepProduct = StepProduct::where( 'step_id', $step->id )->first();

					if ( ! empty( $stepProduct ) ) {
						$product = Product::find( $stepProduct->product_id );

						return $product;
					}
				}
			}
		}


		return null;
	}


	public function getNextStep( $page_id ) {

		$page       = Page::find( $page_id );
		$funnelStep = FunnelStep::find( $page->funnel_step_id );
		$funnelType = FunnelType::find( $funnelStep->type );

		//echo '<pre>'; print_r($POST); die;

		$step = null;

		switch ( strtolower( $funnelType->name ) ) {

			case 'upsell':
				$step = $this->getStep( $page, 'downsell', 'confirmation' );
				break;

			case 'downsell':
				$step = $this->getStep( $page, 'confirmation' );
				break;

			default:
				$step = $this->getStep( $page );
				break;
		}

		if ( $step != null ) {

			$stepPage = Page::where( 'funnel_step_id', $step->id )->first();
			//$stepPage = Page::find($stepPage->id);

			die( json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'pages.show', $stepPage->id )
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


	private function getStep( $page, $type_name = null, $alternate_type_name = null ) {

		$funnelSteps = FunnelStep::where( 'funnel_id', $page->funnel_id )->orderBy( 'order_position', 'asc' )->get();
		$found       = false;

		if ( $type_name != null ) {
			foreach ( $funnelSteps as $step ) {

				$funnelType = FunnelType::find( $step->type );

				if ( strtolower( $funnelType->name ) == strtolower( $type_name ) ) {
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
		} else {
			$flag = false;
			foreach ( $funnelSteps as $step ) {

				if ( $flag ) {
					return $step;
					break;
				}

				$funnelType = FunnelType::find( $step->type );

				if ( $step->id == $page->funnel_step_id ) {
					$flag = true;
				}
			}
		}

		return null;
	}


	public function saveScreenShoot( Request $request ) {


		$path = public_path( 'global/img/screenshoots/cache/' );

		@mkdir( $path );
		@mkdir( $path . '/thumb/' );

		$data = $request->input( 'data' );
		$file = md5( uniqid() ) . '.png';
		$uri  = substr( $data, strpos( $data, "," ) + 1 );
		file_put_contents( $path . $file, base64_decode( $uri ) );

		//resize screenshoot
		$image_path = $path . $file;
		$img        = Image::make( $image_path )->crop( 1280, 1024, 0, 0 );
		$image_name = $file;
		$img->save( $path . 'thumb/' . $image_name );

		//Session::put('page_screenshoot', asset('global/img/screenshoots/cache/thumb/' . $image_name));
		//Session::save();

		$pageScreenshoot = PageScreenshoot::where( 'page_url', route( 'pages.show', $request->input( 'page_id' ) ) )->first();

		if ( ! empty( $pageScreenshoot ) && ( $pageScreenshoot->count() > 0 ) ) {
			$pageScreenshoot = PageScreenshoot::find( $pageScreenshoot->id );
		} else {
			$pageScreenshoot = new PageScreenshoot;
		}

		$pageScreenshoot->page_url        = route( 'pages.show', $request->input( 'page_id' ) );
		$pageScreenshoot->screenshoot_url = $image_name;
		$pageScreenshoot->save();

		//die('saved');
	}


	public function upgradePageStatus( Request $request, $id ) {

		$page = Page::find( $id );

		//print_r($page); die;

		//echo " ACTION: " . (!empty($request->input( 'action' ))) ? $request->input( 'action' ) : "No";

		if ( ( ! empty( $request->input() ) ) && ( $request->input( 'action' ) == 'stop_update' ) ) {
			$page->page_update_status = 2; //indicate page update complete
			$page->update();
			echo "-->saved<--";
		}

		die( json_encode(
			array(
				'status'      => 'success',
				'page_status' => $page->page_update_status
			)
		) );
	}


	public function updatePageStatus( Request $request, $id ) {

		$page = Page::find( $id );

		$page->page_update_status = $request->input( 'status' );
		$page->update();
		echo "-->update<--";

		die( json_encode(
			array(
				'status' => 'success'
			)
		) );
	}
}
