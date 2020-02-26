<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use URL;
use Session;

use App\Models\Page;
use App\Models\Funnel;
use App\Models\FunnelType;
use App\Models\FunnelStep;

class FunnelsController extends Controller
{
	public function index($slug = null)
	{
		if ( $slug == null ) {
			$funnels = Funnel::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
			$funnelCount = Funnel::where('user_id', Auth::id())->count();
			//return view('funnels_list', compact('funnels', 'funnelCount'));
			return view('funnels.list', compact('funnels', 'funnelCount'));
		} else {

            if ( Session::has('purchaded_products') )
                Session::forget('purchaded_products');

			$funnel = Funnel::where('slug', $slug)->first();
			//echo $funnel; die;
			if ( !empty($funnel) ) {
				$page = Page::where('funnel_id', $funnel->id)->first();

				if ( !empty($page) ) {
					$contents = json_decode( $page->content );
					return view( "layouts.page_template_view", [ "contents"=>$contents, 'page' => $page ] );
				} else {
					return redirect()->route('dashboard');//->with('error', 'Template not found.');
					die;
				}
			}
		}
	}

	/**
	 * creares a new funnel
	 *
	 * @return
	 */
	public function store(Request $request)
	{
		// Data Validations
		// ----------------------------------------------
		/*$request->funnelName;
		$validator = Validator::make(
				[
					'funnel_name' => $request->funnelName
				],
				[
					'funnel_name' => 'required'
				]
			);

		if($validator->fails())
		{
			return redirect()->back()->with('error', 'Funnel Name Cannot be empty.');
		}*/
		// End - Data Validations

		// Creates and saves a new Funnel
		// ----------------------------------------------

		//create slug
		$slug = str_ireplace(' ', '-', strtolower($request->funnel_name));

		//search for the slug if exists
		$isSlugExists = Funnel::where('slug', $slug)->count();

		if ( $isSlugExists )
			$newSlug = $slug . '_' . $isSlugExists;
		else
			$newSlug = $slug;

		$funnel = new Funnel;
		$funnel->user_id    = Auth::id();
		$funnel->name       = $request->funnel_name;
		$funnel->slug       = $newSlug;
		$funnel->created_at = date('Y-m-d H:i:s');
		$funnel->updated_at = date('Y-m-d H:i:s');
		if($funnel->save())
		{
			//return redirect()->route('funnels.show', [$funnel->id]);

			echo json_encode(
				array(
					'status'	=> 200,
					'route'		=> route('funnels.edit', [$funnel->id])
				)
			);
		}
		else
		{
			echo json_encode(
				array(
					'status'	=> 500,
					'message'	=> 'Something wrong! please try again later'
				)
			);
		}

		die;
	}

	/*public function edit(Request $request)
	{

	}*/

	public function edit($id)
    {
		$funnel = Funnel::find($id);
		if(!$funnel)
		{
			return redirect()->route('funnels')->with('error', 'Funnel not found.');
		}

		$steps = FunnelStep::where('funnel_id', $funnel->id)->get();
		$funnelStep = FunnelStep::where('funnel_id', $funnel->id)->first();
		$funnelTypes = FunnelType::orderBy('name')->get();

		// Creates a new Funnel Step if not exists
		// ------------------------------------------
		/*if(!$funnelStep)
		{
			$funnelStep = new FunnelStep;
			$funnelStep->funnel_id = $funnel->id;
			$funnelStep->name = "Squeeze";
			$funnelStep->type = "squeeze";
			$funnelStep->save();
		}*/

		//return redirect()->route('funnels.steps.show', [$funnel->id, $funnelStep->id]);
		//return redirect()->route('funnels.edit', [$funnel->id]);
		return view('funnels.edit', compact('funnel', 'funnelStep', 'steps', 'funnelTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$slug = str_ireplace(' ', '-', strtolower($request->funnel_name));

		//search for the slug if exists
		$isSlugExists = Funnel::where('slug', $slug)->count();

		if ( $isSlugExists )
			$newSlug = $slug . '_' . $isSlugExists;
		else
			$newSlug = $slug;

		$funnel = Funnel::find($id);
		$funnel->user_id    = Auth::id();
		$funnel->name       = $request->funnel_name;
		$funnel->slug       = $newSlug;
		$funnel->updated_at = date('Y-m-d H:i:s');

		if($funnel->save())
		{
			//return redirect()->route('funnels.show', [$funnel->id]);

			echo json_encode(
				array(
					'status'	=> 200,
					'route'		=> route('funnels.edit', [$funnel->id])
				)
			);
		}
		else
		{
			echo json_encode(
				array(
					'status'	=> 500,
					'message'	=> 'Something wrong! please try again later'
				)
			);
		}

		die;
    }

	public function show($id=null)
	{
		// Checks if Funnnel exists or not
		// ------------------------------------------
		$funnel = Funnel::find($id);
		if(!$funnel)
		{
			return redirect()->route('funnels.index')->with('error', 'Funnel not found.');
		}

		$steps   = FunnelStep::where('funnel_id', $funnel->id)->get();
		$funnelStep = FunnelStep::where('funnel_id', $funnel->id)->first();
		$funnelTypes = FunnelType::orderBy('name')->get();

		// Creates a new Funnel Step if not exists
		// ------------------------------------------
		/*if(!$funnelStep)
		{
			$funnelStep = new FunnelStep;
			$funnelStep->funnel_id = $funnel->id;
			$funnelStep->name = "Squeeze";
			$funnelStep->type = "squeeze";
			$funnelStep->save();
		}*/

		if ( !empty($funnelStep) ) {
			return redirect()->route('steps.show', [$funnel->id, $funnelStep->id]);
			die;
		}

		//return redirect()->route('funnels.steps.show', [$funnel->id, $funnelStep->id]);
		//return redirect()->route('funnels.edit', [$funnel->id]);
		return view('funnels.edit', compact('funnel', 'funnelStep', 'funnelTypes', 'steps'));
	}



	public function getFunnelBySlug($slug) {

		$funnel = Funnel::where('slug', $slug)->first();

		if ( !empty($funnel) ) {
			return redirect()->route('steps.show', [$funnel->id, $funnelStep->id]);
			die;
		}
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funnel = Funnel::find($id);
		$funnel->delete();

		echo json_encode(
			array(
				'status'	=> 200,
				'route'		=> route('funnels.index')
			)
		);
    }





    public function changeStep(Request $request, $funnel_id) {

        //echo $request->steps; die;

		$steps = explode(',', $request->steps);

		foreach ( $steps as $key=>$step ) {
			$funnelStep = FunnelStep::find($step);
			$funnelStep->order_position = $key;
			$funnelStep->save();
		}

		//pint_r($steps);

		die(json_encode(['status' => 'success']));
    }
}
