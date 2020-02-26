<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HelpCenterTopic;
use App\Models\HelpCenterCategory;

use View;

class HelpCenterController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$helpCategories = HelpCenterCategory::where( 'status', true )
		                                    ->orderBy( 'position' )
		                                    ->get();

		foreach ( $helpCategories as $helpCategory ) {

			$topics = HelpCenterTopic::where( 'category_id', $helpCategory->id )
			                         ->where( 'status', true )
			                         ->orderBy( 'id', 'desc' )
			                         ->get();

			$helpCategory->topics = $topics;
		}

		$ip_address = '';

		return view( 'help_center.index', compact( 'helpCategories', 'ip_address' ) );
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


	public function getTopic( $slug ) {

		$helpCenterTopic = HelpCenterTopic::where( 'slug', $slug )->first();

		return view( 'help_center.topic', compact( 'helpCenterTopic' ) );
	}

	public function search( Request $request ) {

		if ( ! empty( $request->input( 'keyword' ) ) ) {

			$helpCenterTopics = HelpCenterTopic::orWhere( 'title', 'like', '%' . $request->input( 'keyword' ) . '%' )
			                                   ->orWhere( 'details', 'like', '%' . $request->input( 'keyword' ) . '%' )
			                                   ->get();


			die(
				json_encode(
					array(
						'status'    => 'success',
						'html'      => View::make('help_center.search', compact( 'helpCenterTopics' ) )->render()
					)
				)
			);
		} else {
			die(
			json_encode(
				array(
					'status'    => 'success',
					'html'      => ''
				)
			)
			);
		}
	}
}
