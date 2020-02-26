<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Order;
use App\Models\Funnel;
use App\Models\UserSubscription;
use Cartalyst\Stripe\Stripe;

use Auth;

class AccountBillingController extends Controller
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
        $data['profile'] = Profile::where('user_id', Auth::user()->id)->first();
        $sales = Order::where('user_id', Auth::user()->id)->get(); 
        $total_sales = 0.0;

        foreach ( $sales as $sale ) {
            $total_sales += $sale->amount;
        }

        $data['total_sales'] = number_format($total_sales, 2);
        $data['total_funnels'] = Funnel::where('user_id', Auth::user()->id)->get()->count();

        if ( !empty(Auth::user()->secret) ) {
            
            //$data['subscription'] = UserSubscription::where('user_id', Auth::user()->id)->first();
            
        } else {

            $data['subscription'] = Auth::user()->subscriptions->first();
        }
        //echo $data['subscription']->stripe_plan; die;

        //echo '<pre>'; print_r(Auth::user()->subscriptions->first()->stripe_plan); die;
        /*foreach ( Auth::user()->subscriptions as $subscription ) {
            echo '<pre>'; print_r($subscription);
        }*/

        return view('settings.account-billing.details')->withData($data);
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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
