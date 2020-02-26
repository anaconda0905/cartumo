<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CMSPage;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator;

use URL;

class CmsController extends Controller {
	public function __construct() {
		$this->middleware( 'auth:admin' );
	}

	public function index() {

		$cmsPages = CMSPage::orderBy( 'id', 'DESC' )->paginate( 20 );

		return view( 'admin.cms.pages.list', compact( 'cmsPages' ) );
	}

	public function create() {
		return view( 'admin.cms.pages.create', compact( 'categories' ) );
	}


	public function store( Request $request ) {
		if ( ! empty( $request->input( 'action' ) ) && $request->input( 'action' ) == 'image_upload' ) {

			if ( $_FILES['file']['name'] ) {
				if ( ! $_FILES['file']['error'] ) {
					$name        = md5( rand( 100, 200 ) );
					$ext         = explode( '.', $_FILES['file']['name'] );
					$filename    = $name . '.' . $ext[1];
					$destination = public_path( '/global/img/pages/' . $filename ); //change this directory
					$location    = $_FILES["file"]["tmp_name"];
					move_uploaded_file( $location, $destination );
					echo URL::asset( 'global/img/pages/' . $filename );//change this URL
				} else {
					echo $message = 'Ooops!  Your upload triggered the following error:  ' . $_FILES['file']['error'];
				}
			}
		} else {

			$input = Input::only(
				'title',
				'slug',
				'details',
				'status'
			);

			//Validate the data
			$validation = Validator::make( $input, array(

				'title'   => 'required|max:191',
				'slug'    => 'required|unique:cms_pages',
				'details' => 'required',
				'status'  => 'required'
			) );

			//echo '<pre>'; print_r(Input::all()); die;

			if ( $validation->fails() ) {
				return redirect()->back()->withInput()->withErrors( $validation->messages() );
			} else {
				$cmsPage          = new CMSPage();
				$cmsPage->title   = $request->input( 'title' );
				$cmsPage->slug    = $request->input( 'slug' );
				$cmsPage->details = $request->input( 'details' );
				$cmsPage->status  = $request->input( 'status' );
				$cmsPage->save();

				return redirect()->route( 'admin.cms.index' )->with( 'status', 'New page has been created!' );;
			}
		}
	}

	public function show( $id ) {

	}

	public function edit( Request $request, $id ) {

		$cmsPage = CMSPage::find($id);

		return view('admin.cms.pages.edit', compact('cmsPage'));
	}

	public function update( Request $request, $id ) {
		if ( ! empty( $request->input( 'action' ) ) && $request->input( 'action' ) == 'image_upload' ) {

			if ( $_FILES['file']['name'] ) {
				if ( ! $_FILES['file']['error'] ) {
					$name        = md5( rand( 100, 200 ) );
					$ext         = explode( '.', $_FILES['file']['name'] );
					$filename    = $name . '.' . $ext[1];
					$destination = public_path( '/global/img/pages/' . $filename ); //change this directory
					$location    = $_FILES["file"]["tmp_name"];
					move_uploaded_file( $location, $destination );
					echo URL::asset( 'global/img/pages/' . $filename );//change this URL
				} else {
					echo $message = 'Ooops!  Your upload triggered the following error:  ' . $_FILES['file']['error'];
				}
			}
		} else {

			$input = Input::only(
				'title',
				'slug',
				'details',
				'status'
			);

			//Validate the data
			$validation = Validator::make( $input, array(

				'title'   => 'required|max:191',
				'slug'    => 'required|unique:cms_pages,id',
				'details' => 'required',
				'status'  => 'required'
			) );

			//echo '<pre>'; print_r(Input::all()); die;

			if ( $validation->fails() ) {
				return redirect()->back()->withInput()->withErrors( $validation->messages() );
			} else {
				$cmsPage              = CMSPage::find( $id );
				$cmsPage->title       = $request->input( 'title' );
				$cmsPage->slug        = $request->input( 'slug' );
				$cmsPage->details     = $request->input( 'details' );
				$cmsPage->status      = $request->input( 'status' );
				$cmsPage->save();

				return redirect()->route( 'admin.cms.index' )->with( 'status', 'Page has been updated!' );
			}
		}
	}

	public function delete( $id ) {

		$page = CMSPage::find($id);
		if ( $page->delete() ) {
			die(
			json_encode(
				array(
					'status' => 'success'
				)
			)
			);
		}
	}
}