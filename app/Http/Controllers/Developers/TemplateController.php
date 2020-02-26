<?php

namespace App\Http\Controllers\Developers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use App\PageTemplate;
use App\TemplateType;
use App\FunnelType;
use App\PageTemplatePayment;
use App\DeveloperGallery;
use App\Widgets;

use Auth;
use File;
use Storage;

class TemplateController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct() {
		$this->middleware( 'auth:developer' );
	}

	public function index() {
		$data['page_templates'] = PageTemplate::where( 'user_id', Auth::user()->id )
		                                      ->orderBy( 'id', 'desc' )
		                                      ->paginate( 16 );

		$data['funnelTypes'] = TemplateType::orderBy( 'name' )->pluck( 'name', 'id' );

		return view( 'developer.template.list' )->withData( $data );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$input = Input::only(
			'template_name',
			'template_category',
			'payment_type'
		);

		//Validate the data
		$validation = Validator::make( $input, array(

			'template_name'     => 'required|max:255',
			'template_category' => 'required|max:255',
			'payment_type'      => 'required|max:255'
		) );

		if ( $validation->fails() ) {
			//return redirect()->back()->withInput()->withErrors($validation->messages());
			echo json_encode( $validation->messages() );
			//die(return response()->json($validator->errors(), 422));
		} else {
			//print_r($request->all()); die;

			//save to database
			$pageTemplate             = new PageTemplate;
			$pageTemplate->user_id    = Auth::user()->id;
			$pageTemplate->title      = $request->input( 'template_name' );
			$pageTemplate->type       = $request->input( 'template_category' );
			$pageTemplate->decription = $request->input( 'template_description' );
			$pageTemplate->content    = json_encode( array() );

			$image_file = json_decode( $this->uploadFileToSharedHost( $request ) );
			if ( $image_file->status == 'success' ) {
				$pageTemplate->image = $image_file->image;
			}

			$pageTemplate->status = false; //not available to marketplace immediately

			if ( $pageTemplate->save() ) {

				//add payment details
				$pageTemplatePayment                   = new PageTemplatePayment;
				$pageTemplatePayment->page_template_id = $pageTemplate->id;
				$pageTemplatePayment->type             = $request->input( 'payment_type' );
				$pageTemplatePayment->amount           = 0.00;
				$pageTemplatePayment->status           = true;
				$pageTemplatePayment->save();

				echo json_encode(
					array(
						'status' => 'success',
						'url'    => route( 'developer.templates.show', [ $pageTemplate->id ] )
					)
				);
			} else {
				echo json_encode(
					array(
						'status'  => 'error',
						'message' => 'Something is wrong! please try again later'
					)
				);
			}
		}

		//print_r($request->all()); die;
	}

	private function uploadFileToS3( Request $request ) {

		$validator = Validator::make( $request->all(), [
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:999999',
		] );

		if ( $validator->passes() ) {

			try {
				$s3            = Storage::disk( 's3' );
				$image         = $request->file( 'image' );
				$input         = $request->all();
				$imageFileName = time() . '.' . $request->image->getClientOriginalExtension();
				$filePath      = '/page_templates/' . $imageFileName;
				$s3->put( $filePath, file_get_contents( $image ), 'public' );

				//save to database
				//echo  $imageFileName;

				return ( json_encode( array( 'status' => 'success', 'image' => $imageFileName ) ) );
			} catch ( Exception $ex ) {
				return ( json_encode( array( 'status' => 'error' ) ) );
			}
		}

		return ( json_encode( array( 'status' => 'error' ) ) );
	}

	private function uploadFileToSharedHost( Request $request ) {

		if ( ! empty( $userImages ) && $userImages->count() > env( 'MAX_IMAGE_UPLOAD_LIMIT' ) ) {
			//echo response()->json(['error'=>'You can not upload more than']);
			echo json_encode( array(
				'status'  => 'error',
				'message' => 'You can not upload more than ' . env( 'MAX_IMAGE_UPLOAD_LIMIT' ) . ' images'
			) );
			die;
		} else {

			$validator = Validator::make( $request->all(), [
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			] );

			if ( $validator->passes() ) {

				$input         = $request->all();
				$imageFileName = $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
				$request->image->move( public_path( env( 'DEVELOPER_IMAGE_UPLOAD_PATH' ) . strtolower( $request->input( 'media_tab' ) ) ), $input['image'] );

				return ( json_encode( array( 'status' => 'success', 'image' => $imageFileName ) ) );
			} else {
				return ( json_encode( array( 'status' => 'error' ) ) );
			}
		}

		return ( json_encode( array( 'status' => 'error' ) ) );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		$data['pageTemplate'] = PageTemplate::find( $id );

		//get the image from AWS bucket if not empty
		if ( ! empty( $data['pageTemplate']->image ) ) {

			//bucket files
			/*$awsFiles = Storage::disk('s3')->files('page_templates/');
			foreach ( $awsFiles as $sfile ) {
				//echo $sfile; die;
				$afile = explode('page_templates/', $sfile);
				//print_r($afile[1]); die;
				if ( $data['pageTemplate']->image == $afile[1] ) {
					$data['pageTemplate']->image = Storage::disk('s3')->url($sfile);
					break;
				}
			}*/

			$developerImages = DeveloperGallery::where( 'developer_id', Auth::user()->id )->orderBy( 'id', 'desc' )->get();
			//$data['pageTemplate']->image = public_path('/') . env('DEVELOPER_IMAGE_UPLOAD_PATH') . $data['pageTemplate']->image;
			$data['pageTemplate']->image = route( 'index' ) . env( 'DEVELOPER_IMAGE_UPLOAD_PATH' ) . $data['pageTemplate']->image;
		}

		$data['funnelTypes'] = TemplateType::orderBy( 'name' )->pluck( 'name', 'id' );

		return view( 'developer.template.view' )->withData( $data );
	}


	public function viewTemplateDesign( $id ) {

		$template = PageTemplate::find( $id );

		$contents = json_decode( $template->content );

		return view( 'developer.template.design', compact( 'contents', 'template' ) );
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
		$input = Input::only(
			'template_name',
			'template_category',
			'payment_type'
		);

		//Validate the data
		$validation = Validator::make( $input, array(

			'template_name'     => 'required|max:255',
			'template_category' => 'required|max:255',
			'payment_type'      => 'required|max:255'
		) );

		if ( $validation->fails() ) {
			//return redirect()->back()->withInput()->withErrors($validation->messages());
			echo json_encode( $validation->messages() );
			//die(return response()->json($validator->errors(), 422));
		} else {
			//print_r($request->all()); die;

			//save to database
			$pageTemplate             = PageTemplate::find( $id );
			$pageTemplate->title      = $request->input( 'template_name' );
			$pageTemplate->type       = $request->input( 'template_category' );
			$pageTemplate->decription = $request->input( 'template_description' );

			if ( ! empty( $request->file( 'image' ) ) ) {
				$image_file = json_decode( $this->uploadFileToSharedHost( $request ) );
				if ( $image_file->status == 'success' ) {
					$pageTemplate->image = $image_file->image;
				}
			}

			$pageTemplate->status = $request->input( 'status' );

			if ( $pageTemplate->save() ) {

				echo json_encode(
					array(
						'status' => 'success',
						'url'    => route( 'developer.templates.show', [ $pageTemplate->id ] )
					)
				);
			} else {
				echo json_encode(
					array(
						'status'  => 'error',
						'message' => 'Something is wrong! please try again later'
					)
				);
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		$pageTemplate = PageTemplate::find( $id );

		if ( $pageTemplate->delete() ) {
			die(
			json_encode(
				array(
					'status' => 'success',
					'url'    => route( 'developer.templates.index' )
				)
			)
			);
		} else {
			die(
			json_encode(
				array(
					'status'  => 'error',
					'message' => "Something is wrong! Please try after sometime."
				)
			)
			);
		}
	}


	public function design( $id ) {

		$template = PageTemplate::find( $id );

		$data = array();

		$content    = $template->content;
		$contents   = json_decode( $template->content );
		$widget     = new Widgets;
		$widgets    = $widget->getWidgetNames();
		$funnelType = $template->getCategory( $template->type );

		switch ( strtolower( $template->getCategory( $template->type )->name ) ) {

			case 'optin'   :
				$action = route( 'optin.save' );
				break;

			case 'sales' :
			case 'downsell' :
			case 'upsell'   :
				$action = route( 'order.store' );
				break;

			case 'order':
				$action = route( 'order.store' );
				break;

			case 'product'   :
				$action = route( 'products.checkout' );
				break;

			default:
				$action = '';
		}

		//gallery images
		$userImages   = DeveloperGallery::where( 'developer_id', Auth::user()->id )->get();
		$files        = File::allFiles( public_path() . '/frontend/builder/images/gallery' );
		$directories  = glob( public_path() . '/frontend/builder/images/gallery/*', GLOB_ONLYDIR );
		$libraryFiles = array();


		/*//bucket files
		$awsFiles = Storage::disk( 's3' )->files( 'library/' );
		//echo '<pre>'; print_r($awsFiles); die;
		$libraryFiles = array();

		foreach ( $awsFiles as $sfile ) {

			$libraryFiles[] = Storage::disk( 's3' )->url( $sfile );
		}*/


		if ( strtolower( $funnelType->name ) != 'confirmation' ) {
			return view( 'developer.template.page_template', [
				'userImages'   => $userImages,
				'template'     => $template,
				'action'       => $action,
				'data'         => $data,
				'contents'     => $contents,
				'images'       => $files,
				'directories'  => $directories,
				'widgets'      => $widgets,
				'funnelType'   => $funnelType,
				'libraryFiles' => $libraryFiles
			] );
		} else {
			return view( 'developer.template.page_template', [
				'userImages'   => $userImages,
				'template'     => $template,
				'action'       => $action,
				'data'         => $data,
				'contents'     => $contents,
				'images'       => $files,
				'directories'  => $directories,
				'widgets'      => $widgets,
				'funnelType'   => $funnelType,
				'libraryFiles' => $libraryFiles
			] );
		}

		//return view('developer.template.page_template')->withData($data);
	}


	public function designUpdate( Request $request, $id ) {

		$page    = PageTemplate::find( $id );
		$content = str_replace( array( "\\n", "\\r\\n", "\\r" ), '', $request->page );
		//$content = str_replace(array("\\&"), '', $content);
		$page->content    = $content;
		$page->updated_at = date( 'Y-m-d h:i:s' );

		//echo $content; die;

		$response = json_encode( array( 'success' => $page->save() ) );

		die ( $response );
	}


	public function clearTemplate( $id ) {
		//echo $id; die;

		$pageTemplate          = PageTemplate::find( $id );
		$pageTemplate->content = json_encode( array() );

		if ( $pageTemplate->save() ) {
			die(
			json_encode(
				array(
					'status'  => 'success',
					'message' => "Template content has been cleared"
				)
			)
			);
		} else {
			die(
			json_encode(
				array(
					'status'  => 'error',
					'message' => "Something is wrong! Please try after sometime."
				)
			)
			);
		}
	}
}
