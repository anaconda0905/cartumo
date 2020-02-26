<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Funnel;
use App\Models\FunnelType;
use App\Models\FunnelStep;
use App\Models\Product;
use App\Models\StepProduct;

class FunnelEmailController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($funnel_id, $step_id)
	{
		$funnel = Funnel::find($funnel_id);
		$steps   = FunnelStep::where('funnel_id', $funnel_id)->orderBy('order_position')->get();
		$currentStep = FunnelStep::find($step_id);


		/*if(!$funnel || !$steps || !$currentStep)
		{
			return redirect()->route('funnels.index');
			die;
		}*/

		if ( empty($currentStep) ) {
			return redirect()->route('funnels.edit', $funnel->id);
			die;
		}

		$currentType = FunnelType::find($currentStep->type);

		//echo $step_id; die;

		$page = Page::where('funnel_id', $funnel->id)->where('funnel_step_id', $currentStep->id)->first();
		$funnelTypes = FunnelType::orderBy('name')->get();
		$content = json_decode($page->content);

		if ( !empty(json_decode($currentStep->details)->email) ) {
			$email = json_decode($currentStep->details)->email;
		} else {
			$email = array();
		}

		return view('funnels.steps.email.show', ['funnel' => $funnel, 'steps' => $steps, 'page' => $page, 'currentStep' => $currentStep, 'content' => $content, 'funnelTypes' => $funnelTypes, 'templates' => array(), 'currentType' => $currentType, 'email' => $email]);

		//return view('funnels.steps.email.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $funnel_id, $step_id)
	{
		$funnelStep = FunnelStep::find($step_id);

		//print_r($funnelStep);

		//if ( !empty(json_decode($funnelStep->details)->email) ) {

		$data['email'] = array();
		//$json = json_decode($funnelStep->details)->email;

		$data['email']['subject'] = $request->input('subject');
		$data['email']['message'] = $request->input('message');

		$funnelStep->details = json_encode($data);


		if ( $funnelStep->save() ) {

			$funnel = Funnel::find($funnel_id);
			$funnel->updated_at = date('Y-m-d h:i:s');
			$funnel->save();

			die(
			json_encode(
				array(
					'status'    => 'success',
					'url'       => route('funnel.step.email.show', [$funnel_id, $step_id])
				)
			)
			);
		}
		//}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
