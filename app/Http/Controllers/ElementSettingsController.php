<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;

use App\Models\Page;
use App\Models\Funnel;
use App\Models\FunnelStep;
use App\Models\FunnelType;
use App\Models\Product;

use Session;

class ElementSettingsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct() {
		$this->middleware( 'auth' );
	}

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


	public function getElementSettings( Request $request, $type ) {

		$data = array();

		$settings = json_decode( $request->settings );

		if ( $type == 'button' ) {

			$page             = Page::find( $request->input( 'page_id' ) );
			$data['products'] = Product::where( 'funnel_step_id', $page->funnel_step_id )->orderBy( 'id', 'desc' )->get();
			$funnelStep       = FunnelStep::find( $page->funnel_step_id );
			$data['type']     = FunnelType::find( $funnelStep->type );
			//echo $page;
		}

		echo view( 'editor.widgets.settings.' . $type, array( 'settings' => $settings, 'data' => $data ) );

		die;
	}


	public function getButtonUrl( Request $request, $url_type ) {

		$page       = Page::find( $request->page_id );
		$funnelType = FunnelType::find( $page->funnel_step_id );

		$funnelSteps = FunnelStep::where( 'funnel_id', $page->funnel_id )->get();
		$stepFlag    = false;

		foreach ( $funnelSteps as $key => $step ) {

			if ( $stepFlag ) {
				break;
			}

			if ( $step->id == $page->funnel_step_id ) {
				$stepFlag = true;
			}
		}

		$page = Page::where( 'funnel_step_id', $step->id )->where( 'funnel_id', $step->funnel_id )->first();

		if ( empty( $request->type ) ) {
			echo json_encode(
				array(
					'url' => route( 'pages.show', $page->id )
				)
			);
		} else {
			echo json_encode(
				array(
					'url' => ( ! empty( $page->slug ) ) ? route( 'page.view', $page->slug ) : "#"
				)
			);
		}
	}


	/*
	 * URl will be skip for Upsell or Downsell
	 */
	public function skipStepsUrl(Request $request, $url_type) {

		//echo $url_type; die;
		//print_r($request->all());

		$page = Page::find( $request->input('page_id') );
		$funnelStep = FunnelStep::find($page->funnel_step_id);
		$nextStep = FunnelStep::where('funnel_id', $funnelStep->funnel_id)
							   ->where('order_position', '>', $funnelStep->order_position)
							   ->where('type', '<>', $funnelStep->type)
							   ->first();
		$nextPage = Page::where('funnel_step_id', $nextStep->id)
						 ->first();

		echo json_encode(
			array(
				'url' => route( 'page.view', $nextPage->slug )
			)
		);
	}

	private function getPage( $page_id, $page_name = '' ) {

		$page = Page::find( $page_id );
		$step = $this->isStepPresent( $page, $page_name );

		if ( $step != null ) {
			$template = Page::where( 'funnel_id', $page->funnel_id )->where( 'funnel_step_id', $step->id )->first();

			if ( ! empty( $template ) ) {
				return route( 'pages.show', $template->id );
			}
		}

		//confirmation page
		$step = $this->isStepPresent( $page, 'Confirmation' );

		if ( ! empty( $step ) ) {
			$template = Page::where( 'funnel_id', $page->funnel_id )->where( 'funnel_step_id', $step->id )->first();

			if ( ! empty( $template ) ) {
				return route( 'pages.show', $template->id );
			}
		}

		return null;
	}


	private function isStepPresent( $page, $page_name = '' ) {

		$funnelSteps = FunnelStep::where( 'funnel_id', $page->funnel_id )->orderBy( 'order_position' )->get();

		foreach ( $funnelSteps as $step ) {

			$funnelType = FunnelType::find( $step->type );

			if ( strtolower( $funnelType->name ) == strtolower( $page_name ) ) {
				//echo strtolower($funnelType->name) == $page_name;
				return $step;
			}
		}

		return null;
	}


	/*public function getButtonUrl(Request $request, $url_type) {

		$url = "";
		$page = Page::find($request->page_id);
		$prevPage = $page;
		$prevFunnel = Funnel::find($prevPage->id);
		$funnelStep = new FunnelStep;

		switch ( $url_type ) {
			case 'next_step': $funnelStep = $this->getStepUrl($page);
							  break;

			default: die(
						json_encode(
							array('url'   => '#')
						)
					);
		}

		if ( !empty($funnelStep) ) {
			//echo $funnelStep; die;
			$page = Page::where('funnel_id', $funnelStep->funnel_id)->where('funnel_step_id', $funnelStep->id)->first();
		}

		//echo $page; die;

		if ( !empty($page) ) {
			$funnel = Funnel::find($page->funnel_id);

			echo json_encode(
				array(
					//'url'   => route('page.show', array($funnel->slug, $page->id))
					'url'   => route('pages.show', $page->id)
				)
			);
		} else {
			$funnel = Funnel::find($prevPage->funnel_id);

			echo json_encode(
				array(
					//'url'   => route('page.show', array($funnel->slug, $prevPage->id))
					'url'   => '#'
				)
			);
		}

		die;
	}




	private function getStepUrl(Page $page) {

		$funnelStep = FunnelStep::where('funnel_id', $page->funnel_id)->where('id', '<>', $page->funnel_step_id)->orderBy('order_position')->first();

		//echo $funnelStep; die;

		return $funnelStep;
	}*/


	private function loadImages() {
		$files = File::allFiles( public_path() . '/frontend/images/gallery' );

		return array( 'images' => $files );
	}
}
