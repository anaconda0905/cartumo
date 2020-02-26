<?php

namespace App\Http\Controllers\Developers;

use App\DeveloperGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Widgets;

use App\Product;

use App\StepProduct;

use App\UserShop;

use App\UserIntegration;

use App\UserGallery;

use Validator;

use File;

use App\FunnelStep;
use App\FunnelType;

use Storage;

use Auth;

class WidgetController extends Controller {
	public function __construct() {
		$this->middleware( 'auth:developer' );
	}


	public function index( $id = null ) {
		$widgets    = new Widgets;
		$allWidgets = $widgets->getWidgets();

		echo view( 'editor.widgets.' . $id, array( 'widgets' => $allWidgets ) );
		die;
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
		$widgets    = new Widgets;
		$allWidgets = $widgets->getWidget( $id );

		echo view( 'editor.widgets.' . $id, array( 'widgets' => $allWidgets ) );
		die;
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


	public function getElement( Request $request, $element_id ) {
		//echo $element_id; die; //section_product_main_image

		$data = array();

		//$view = str_ireplace('_', '.', $element_id);
		$id = $element_id . time();

		if ( $element_id == 'elements_order_2_step' ) {
			$data['months'] = range( 1, 12 );
			$data['years']  = range( date( 'Y' ), intval( date( 'Y' ) + 20 ) );
		}


		echo view( 'editor.widgets.backend.' . $element_id, array( 'id' => $id, 'data' => $data ) );
	}


	public function ajaxImageUpload() {
		echo 'uploading';
	}

	public function ajaxImageUploadPost( Request $request ) {


		//print_r($_POST); die;

		//$this->uploadFileToS3($request);

		$userImages = DeveloperGallery::where( 'developer_id', Auth::user()->id )->get();

		if ( ! empty( $userImages ) && $userImages->count() > env( 'MAX_IMAGE_UPLOAD_LIMIT' ) ) {
			//echo response()->json(['error'=>'You can not upload more than']);
			echo json_encode( array(
				'status'  => 'error',
				'message' => 'You can not upload more than ' . env( 'MAX_IMAGE_UPLOAD_LIMIT' ) . ' images'
			) );
			die;
		} else {

			$developerGalary = new DeveloperGallery();

			$validator = Validator::make( $request->all(), [
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			] );

			if ( $validator->passes() ) {

				$input          = $request->all();
				$input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
				$request->image->move( public_path( env('DEVELOPER_IMAGE_GALLERY_PATH') . strtolower( $request->input( 'media_tab' ) ) ), $input['image'] );

				//AjaxImage::create($input);

				$developerGalary->developer_id = Auth::user()->id;
				$developerGalary->path    = $input['image'];
				$developerGalary->status  = true;
				$developerGalary->save();

				echo json_encode( array( 'status' => 'success', 'data' => $request->input( 'media_tab' ) ) );
				die;
				//echo response()->json(['success'=>'done', 'data' => $request->input('media_tab')]);
			}
		}

		//echo response()->json(['error'=>$validator->errors()->all()]);
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
				$filePath      = '/library/' . $imageFileName;
				$s3->put( $filePath, file_get_contents( $image ), 'public' );

				//save to database
				$userGallery          = new UserGallery;
				$userGallery->user_id = Auth::user()->id;
				$userGallery->path    = $imageFileName;
				$userGallery->status  = true;
				$userGallery->save();

				die( json_encode( array( 'status' => 'success', 'data' => $request->input( 'media_tab' ) ) ) );
			} catch ( Exception $ex ) {
				die( json_encode( array( 'status' => 'error', $ex->getMessage() ) ) );
			}
		}
	}


	public function getGalleryImages( Request $request ) {

		$userImages = DeveloperGallery::where( 'developer_id', Auth::user()->id )->orderBy( 'id', 'desc' )->get();

		$files        = File::allFiles( public_path( env('DEVELOPER_IMAGE_GALLERY_PATH')) );
		$directories  = glob( public_path() . env('DEVELOPER_IMAGE_GALLERIES_PATH'), GLOB_ONLYDIR );
		$libraryFiles = array();

		//bucket files
		/*$awsFiles = Storage::disk('s3')->files('library/');
		//echo '<pre>'; print_r($awsFiles); die;
		$libraryFiles = array();

		foreach ( $awsFiles as $sfile ) {

			//echo '<pre>'; print_r($awsFiles); die;
			$afile = explode('library/', $sfile);

			foreach ( $userImages as $userImage ) {

				if ( $userImage->path == $afile[1] ) {
					$libraryFiles[] = Storage::disk('s3')->url($sfile);
				}
			}
		}*/

		echo view( 'editor.widgets.developer.gallery_images', array(
			'userImages'   => $userImages,
			'images'       => $files,
			'directories'  => $directories,
			'tab'          => $request->input( 'media_tab' ),
			'libraryFiles' => $libraryFiles
		) );

		//print_r($_GET);
	}



	public function removeGalleryImages( Request $request ) {

		$path = public_path( env( 'DEVELOPER_IMAGE_UPLOAD_PATH' ) . $request->input( 'image' ) );

		//echo $path;

		if ( File::exists( $path ) ) {
			File::delete( $path );
		} else {
			//$awsFile = Storage::disk( 's3' )->delete( 'library/', $request->input( 'image_id' ) );
		}

		//delete form database
		if ( strpos( $request->input( 'image_id' ), '.' ) != false ) {
			$userImage = DeveloperGallery::where( 'path', $request->input( 'image_id' ) )->first();
		} else {
			$userImage = DeveloperGallery::find( $request->input( 'image_id' ) );
		}


		if ( $userImage->delete() ) {
			$userImages = DeveloperGallery::where( 'developer_id', Auth::user()->id )->get()->count();
			die(
			json_encode(
				[ 'status' => 'success', 'total' => $userImages ]
			)
			);
		} else {
			$userImages = DeveloperGallery::where( 'developer_id', Auth::user()->id )->get()->count();
			die(
			json_encode(
				[ 'status' => 'error', 'total' => $userImages ]
			)
			);
		}

		/*} else {

			$awsFile = Storage::disk('s3')->delete('library/', $request->input('image_id'));
			print_r($awsFile);

			$userImages = UserGallery::where('user_id', Auth::user()->id)->get()->count();

			die(
				json_encode(
					['status'    => 'error', 'total' => $userImages]
				)
			);
		}*/
	}


	public function getUserGalleryImages( Request $request ) {

		$userImages = DeveloperGallery::where( 'developer_id', Auth::user()->id )->orderBy( 'id', 'desc' )->get();

		$files        = File::allFiles( public_path() . env('DEVELOPER_IMAGE_GALLERY_PATH') );
		$directories  = glob( public_path() . env('DEVELOPER_IMAGE_GALLERIES_PATH'), GLOB_ONLYDIR );
		$libraryFiles = array();

		/*//bucket files
		$awsFiles = Storage::disk('s3')->files('library/');
		//echo '<pre>'; print_r($awsFiles); die;
		$libraryFiles = array();

		foreach ( $awsFiles as $sfile ) {

			//echo '<pre>'; print_r($awsFiles); die;
			$afile = explode('library/', $sfile);

			//echo $userImages; die;

			foreach ( $userImages as $userImage ) {

				if ( $userImage->path == $afile[1] ) {
					$libraryFiles[] = Storage::disk('s3')->url($sfile);
				}
			}
		}*/

		echo view( 'editor.widgets.developer.gallery_images', array(
			'userImages'   => $userImages,
			'images'       => $files,
			'directories'  => $directories,
			'tab'          => $request->input( 'media_tab' ),
			'libraryFiles' => $libraryFiles
		) );
	}
}
