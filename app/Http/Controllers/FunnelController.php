<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use URL;
use Session;
use View;

use App\Models\Page;
use App\Models\Funnel;
use App\Models\Profile;
use App\Models\FunnelType;
use App\Models\FunnelStep;
use App\Models\PageVisitor;
use App\Models\UserPaymentGateway;
use App\Models\UserSubscription;
use App\Models\UserMarketplace;
use App\Models\Order;

class FunnelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($slug = null)
    {
        $profile = Profile::where('user_id', Auth::user()->id)->first();

        if ($slug == null) {
            /*$funnels = Funnel::where('user_id', Auth::id())
                             ->orderBy('id', 'desc')->paginate(20);*/

            $funnels = Funnel::where('user_id', Auth::id())
                             ->where('marketplace', false)
                             ->orderBy('id', 'desc')->get();

            $recentFunnels = Funnel::where('user_id', Auth::id())
                             ->where('marketplace', false)
                             ->orderBy('updated_at', 'desc')->get();

            $funnelCount = Funnel::where('user_id', Auth::id())->where('marketplace', false)->count();
            //return view('funnels_list', compact('funnels', 'funnelCount'));


            //archived funnels
            $archivedFunnels = Funnel::where('user_id', Auth::id())
                                    ->where('archived', true)
                                    ->orderBy('id', 'desc')->get();

            //archived funnels
            /*$marketPlaceFunnels = Funnel::where('marketplace', true)
                                    ->orderBy('id', 'desc')->get();*/

            $marketPlaceFunnels = Funnel::select('funnels.*')
                                        ->leftJoin('user_marketplaces', 'user_marketplaces.funnel_id', 'funnels.id')
                                        ->where('user_marketplaces.user_id', Auth::id())
                                        ->get();


            $paymentGateways = UserPaymentGateway::where('user_id', Auth::user()->id)->get();

            if ( empty(Auth::user()->secret) ) {

                $data['subscription'] = UserSubscription::where('user_id', Auth::user()->id)->first();

            } else {
                $data['subscription'] = array();
            }

            //echo '<pre>'; print_r(Auth::user()->subscription('main')->stripe_plan); die;

            /*if (Auth::user()->subscription('main')->onTrial()) {
                $data['subscription_mode'] = "Trial";
            } else {
                $data['subscription_mode'] = "";
            }*/


            $data['total_funnels'] = Funnel::where('user_id', Auth::user()->id)->get()->count();
            $sales = Order::where('user_id', Auth::user()->id)->get();
            $total_sales = 0.0;

            foreach ( $sales as $sale ) {
                $total_sales += $sale->amount;
            }
            $data['total_sales'] = $total_sales;

            return view('funnels.list', compact('funnels', 'funnelCount', 'profile', 'paymentGateways', 'data', 'archivedFunnels', 'marketPlaceFunnels', 'recentFunnels'));
        }

        //$funnels = Funnel::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        //$funnelCount = Funnel::where('user_id', Auth::id())->count();
        //return view('funnels_list', compact('funnels', 'funnelCount'));
        //return view('funnels.list', compact('funnels', 'funnelCount'));
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
        $isSlugExists = Funnel::where('slug', 'like', '%' . $slug . '%')->get()->count();

        //echo $isSlugExists; die;

        if ($isSlugExists) {
            $newSlug = $slug . '_' . intVal($isSlugExists);
        }
        else {
            $newSlug = $slug;
        }

        $funnel = new Funnel;
        $funnel->user_id = Auth::id();
        $funnel->name = $request->funnel_name;
        $funnel->slug = $newSlug;
        $funnel->type = $request->input('funnel_type');
        $funnel->payment_gateway = (!empty($request->input('payment_gateway'))) ? $request->input('payment_gateway') : NULL;
        $funnel->allow_service = NULL;

        if ($funnel->save()) {
            //return redirect()->route('funnels.show', [$funnel->id]);

            die(json_encode(
                array(
                    'status' => "success",
                    'route' => route('funnels.show', [$funnel->id])
                )
            ));
        } else {
            die(json_encode(
                array(
                    'status' => 500,
                    'message' => 'Something wrong! please try again later'
                )
            ));
        }
    }

    /*public function edit(Request $request)
    {

    }*/

    public function edit($id)
    {
        $funnel = Funnel::find($id);
        if (!$funnel) {
            return redirect()->route('funnels')->with('error', 'Funnel not found.');
        }

        $steps = FunnelStep::where('funnel_id', $funnel->id)->orderBy('order_position')->get();
        $funnelTypes = FunnelType::orderBy('name')->get();

        //if ( $steps->count() > 0 )

        if ( $steps->count() > 0 ) {
            $currentStep = $funnelStep = FunnelStep::where('funnel_id', $funnel->id)->first();

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
            return view('funnels.edit', compact('funnel', 'funnelStep', 'currentStep', 'steps', 'funnelTypes'));
        } else {
            return view('funnels.edit', compact('funnel', 'funnelStep', 'currentStep', 'steps', 'funnelTypes'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $funnel = Funnel::find($id);
        $funnel->name = $request->funnel_name;
	    $funnel->slug       = $request->input( 'hid_slug_availability' );
        /*$funnel->type = $request->product_type;

        //if ( $request->product_type !== 'shopify' )
            $funnel->payment_gateway = $request->payment_gateway_id;
        /*else
            $funnel->payment_gateway = $request->NULL;

        $funnel->allow_service = $request->allow_service;*/
        $funnel->updated_at = date('Y-m-d H:i:s');

        if ($funnel->save()) {
            return redirect()->route('funnels.show', [$funnel->id]);

            /*echo json_encode(
                array(
                    'status' => 200,
                    'route' => route('funnels.edit', [$funnel->id])
                )
            );*/
        } else {
            /*echo json_encode(
                array(
                    'status' => 500,
                    'message' => 'Something wrong! please try again later'
                )
            );*/
        }

        die;
    }

    public function show($id = null)
    {
        // Checks if Funnnel exists or not
        // ------------------------------------------
        $funnel = Funnel::find($id);
        if (!$funnel) {
            return redirect()->route('funnels.index')->with('error', 'Funnel not found.');
        }

        //$steps = FunnelStep::where('funnel_id', $funnel->id)->get();
        $steps   = FunnelStep::where('funnel_id', $funnel->id)->orderBy('order_position')->get();
        $funnelStep = FunnelStep::where('funnel_id', $funnel->id)->first();
        $funnelTypes = FunnelType::orderBy('name')->get();



        //get total visitors of the funnel
        $visitors = PageVisitor::select('page_visitors.ip_address')
                                ->join('pages', 'pages.id', 'page_visitors.page_id')
                                ->where('pages.funnel_id', $funnel->id)
                                ->groupBy('page_visitors.ip_address')
                                ->get()->count();


                                /*$sales = Order::select('id', 'created_at')
                                ->where('user_id', Auth::user()->id)
                                ->get();*/

        $total_sales = 0.00;

        //get total sales of the funnel
        $sales = Order::select('orders.id', 'orders.amount')
                        ->join('pages', 'pages.id', 'orders.page_id')
                        ->join('funnels', 'funnels.id', 'pages.funnel_id')
                        ->where('pages.funnel_id', $funnel->id)
                        ->get();

        if ( $sales->count() > 0 ) {
            foreach ( $sales as $sale ) {
                $total_sales += $sale->amount;
            }
        }

        $total_sales = number_format($total_sales, 2);

        return view('funnels.home', compact('funnel', 'funnelStep', 'funnelTypes', 'steps', 'sales', 'visitors', 'total_sales'));

        /**/

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

        /*if (!empty($funnelStep)) {
            return redirect()->route('steps.show', [$funnel->id, $funnelStep->id]);
            die;
        }

        //return redirect()->route('funnels.steps.show', [$funnel->id, $funnelStep->id]);
        //return redirect()->route('funnels.edit', [$funnel->id]);
        return view('funnels.edit', compact('funnel', 'funnelStep', 'funnelTypes', 'steps'));*/
    }


    public function getFunnelPage($slug) {

        $funnel = Funnel::where('slug', $slug)->first();

        if ( !empty($funnel) ) {

            $step = FunnelStep::where('funnel_id', $funnel->id)->orderBy('order_position')->first();

            if ( !empty($step) ) {
                $page = Page::where('funnel_step_id', $step->id)->first();

                return redirect()->route("page.view", (!empty($page->slug)) ? $page->slug : $page->id);
            }
        }
    }


    public function getFunnelBySlug($slug)
    {

        $funnel = Funnel::where('slug', $slug)->first();

        if (!empty($funnel)) {
            return redirect()->route('steps.show', [$funnel->id, $funnelStep->id]);
            die;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funnel = Funnel::find($id);

        //delete pages related to the funnel
        Page::where('funnel_id', $id)->delete();

        //delete steps related to funnel
        FunnelStep::where('funnel_id', $id)->delete();

        if ( $funnel->delete() ) {

            echo json_encode(
                array(
                    'status' => 200,
                    'route' => route('funnels.index')
                )
            );
        } else {
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => 'ERROR! please try again later'
                )
            );
        }
    }


    public function changeStep(Request $request, $funnel_id)
    {

        //echo $request->steps; die;

        $steps = explode(',', $request->steps);

        foreach ($steps as $key => $step) {
            $funnelStep = FunnelStep::find($step);
            $funnelStep->order_position = $key;
            $funnelStep->save();
        }

        //pint_r($steps);

        die(json_encode(['status' => 'success']));
    }



    public function cloneFunnel($funnel_id, $user_email='', $return=false) {

        if ( $user_email !== '' ) {

            $user = get_the_user_by_email($user_email);

            if ( $user === null ) {

                return false;
            }

            // check other parameters of the user
        }

        //create new funnel
        $cloneFunnel = Funnel::find($funnel_id);
        $slug = $cloneFunnel->slug;

        //search for the slug if exists
        /*$isSlugExists = Funnel::where('slug', 'like', '%' . $cloneFunnel->slug . '%')->get()->count();

        if ($isSlugExists) {
            $newSlug = $slug . '_' . intVal($isSlugExists);
        }
        else {
            $newSlug = $slug;
        }*/

        $newSlug = $slug . '-' . time();

        $funnel = new Funnel;
        $funnel->user_id = ( !empty($user) ) ? $user->id : Auth::id();
        $funnel->name = $cloneFunnel->name;
        $funnel->slug = $newSlug;
        $funnel->type = $cloneFunnel->type;
        $funnel->payment_gateway = $cloneFunnel->payment_gateway;
        $funnel->allow_service = NULL;
        $funnel->updated_at = date('Y-m-d h:i:s');
        $funnel->save();

        //create the steps
        foreach ( $cloneFunnel->steps as $step )  {

            $funnelStep = new FunnelStep;
            $funnelStep->funnel_id = $funnel->id;
            $funnelStep->name = $step->name;
            $funnelStep->display_name = $step->display_name;
            $funnelStep->slug = strtolower(str_ireplace(' ', '-', $step->display_name)) . time();
            $funnelStep->type = $step->type;
            $funnelStep->order_position = $step->order_position;
            $funnelStep->save();

            //page
            $clonePage = $step->page;

            if ( !empty($clonePage) ) {
                $page = new Page;
                $page->funnel_id = $funnel->id;
                $page->funnel_step_id = $funnelStep->id;
                if ( !empty($clonePage->content) )
                    $page->content = str_replace(array("\\n","\\r\\n","\\r"), '', $clonePage->content);
                else
                $page->content = ' ';
                $page->slug = $funnelStep->slug;

                if ( !empty($clonePage->content) )
                    $page->image = $clonePage->image;
                else
                    $page->image = ' ';

                $page->save();
            }
        }

        if ( !$return ) {

            echo json_encode(
                array(
                    'status' => 'success',
                    'url'    => route('funnels.index')
                )
            );

            return;
        }

        return $funnel;
    }


    public function searchFunnel(Request $request) {

        $keyword = $request->input('keyword');

        //if ( !empty($keyword) ) {

            $funnels = Funnel::where('user_id', Auth::id())
                             ->where('name', 'like', '%' . $keyword . '%')
                             ->orderBy('id', 'desc')
                             ->get();

            die(
                json_encode(
                    array(
                        'status'    => 'success',
                        'html'      => View::make('funnels.search', array('funnels' => $funnels))->render()
                    )
                )
            );
        //}
    }


    /**
     * Share funnel with user
     * Input should have an email address
     * The existing funnel will be cloned on the DB and set the 'shared` field as TRUE
     */
    public function shareWithUser(Request $request) {

        $funnel = Funnel::find($request->input('funnel_id'));

        // use existing function to clone the current funnel
        // user email will be used to find the user and assign the new funnel to that user
        // and return the new cloned funnel
        $clonedFunnel = $this->cloneFunnel($funnel->id, $request->input('user_email'), true);

        if ( $clonedFunnel ) {

            // updated the 'shared' to mark the funnel as shared
            $clonedFunnel = Funnel::find($clonedFunnel->id);
            $clonedFunnel->shared = true;
            $clonedFunnel->save();            

            return response()->json(
                array(
                    'status'    => 'success',
                    'message'   => __('The funnel has been shared with <strong>' . $request->input('user_email') . '</strong>'),
                    'url'       => route('funnels.index')
                )
            );
        }

        return response()->json(
            array(
                'status'    => 'error',
                'message'   => __('Something is wrong by sharing the funnel with the user!'),
                'url'       => route('funnels.index')
            )
        );
    }


    /**
     * Share funnel with marketplace
     */
    public function shareWithMarketplace(Request $request) {

        $funnel = Funnel::find($request->input('funnel_id'));

        // use existing function to clone the current funnel
        // and return the new cloned funnel
        $clonedFunnel = $this->cloneFunnel($funnel->id, '', true);

        if ( $clonedFunnel ) {

            // updated the 'marketplace' field to mark the funnel is on Marketplace
            $clonedFunnel               = Funnel::find($clonedFunnel->id);
            $clonedFunnel->marketplace  = true;
            $clonedFunnel->save();
            
            // add entry to user marketplace
            $userMarketplace = new UserMarketplace();
            $userMarketplace->fill(['funnel_id'=>$clonedFunnel->id, 'user_id'=>$clonedFunnel->user_id, 'status'=>true]);
            $userMarketplace->save();

            return response()->json(
                array(
                    'status'    => 'success',
                    'message'   => __('The funnel has been shared on the Marketplace'),
                    'url'       => route('funnels.index')
                )
            );
        }

        return response()->json(
            array(
                'status'    => 'error',
                'message'   => __('Something is wrong by sharing the funnel on the Marketplace!'),
                'url'       => route('funnels.index')
            )
        );
    }


	public function isSlugExists( Request $request, $funnel_id ) {

		$funnel = Funnel::whereRaw( 'LOWER(`slug`) like ?', array($request->input( 'slug' )) )
						->where('id', '!=', $funnel_id)
		                ->first();

		if ( ! empty( $funnel ) ) {

			echo json_encode(
				array(
					'status'       => 'success',
					'availability' => false,
					'message'      => "Not available"
				)
			);
		} else {
			echo json_encode(
				array(
					'status'       => 'success',
					'availability' => true,
					'message'      => "Available"
				)
			);
		}
	}
}
