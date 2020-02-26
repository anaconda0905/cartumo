<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Order;
use App\Models\Funnel;
use App\Models\Profile;
use App\Models\UserSubscription;

use Auth;

class ProfileController extends Controller
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
        $data = array();

        $data['profile'] = Profile::where('user_id', Auth::user()->id)->first();

        return redirect()->route('profile.edit', Auth::user()->id);
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
        $user = User::find(Auth::user()->id);
        $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->email = $request->input('email');
        $user->save();

        $profile = Profile::where('user_id', Auth::user()->id)->first();

        if ( empty($profile) )
            $profile = new profile();
        else
            $profile = Profile::find($profile->id);

        $profile->user_id = Auth::user()->id;
        $profile->country = $request->input('country');
        $profile->phone = $request->input('phone');
        $profile->street_address = $request->input('address');
        $profile->city = $request->input('city');
        $profile->state = $request->input('state');
        $profile->zip = $request->input('zip');

        $profile->save();

        return redirect()->route('profile.edit', Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();

        $data['profile'] = Profile::where('user_id', Auth::user()->id)->first();

        return view('profile.show')->withData($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();

        $data['profile'] = Profile::where('user_id', Auth::user()->id)->first();

        if ( empty(Auth::user()->secret) ) {
            
            $data['subscription'] = UserSubscription::where('user_id', Auth::user()->id)->first();
            
        } else {
            $data['subscription'] = array();
        }
            
        $data['total_funnels'] = Funnel::where('user_id', Auth::user()->id)->get()->count();
        //$data['total_sales'] = Order::where('user_id', Auth::user()->id)->get()->count();            

        $sales = Order::where('user_id', Auth::user()->id)->get(); 
        $total_sales = 0.0;

        foreach ( $sales as $sale ) {
            $total_sales += $sale->amount;
        }

        $data['total_sales'] = $total_sales;

        return view('profile.edit')->withData($data);
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
