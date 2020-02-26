<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UserUpgrade;
use App\FeatureUpgrad;
use App\AdminPaymentGateway;
use App\User;

use Auth;

class UserUpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
     {
         $this->middleware('auth:admin');
     }
     
    public function create($id)
    {
        $data['users'] = User::where('status', true)->orderBy('name')->get();
        $data['feature_upgrade'] = FeatureUpgrad::find($id);
        $data['gateways'] = AdminPaymentGateway::where('admin_id', Auth::user()->id)
                                                ->orderBy('type')
                                                ->get();

        //echo $data['feature_upgrade'];

        return view('admin.upgrade.user_upgrade')->withData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        //print_r($request->input('user_id'));

        //$user = User::find($request->input('user_id'));

        foreach ( $request->input('user_id') as $user_id ) {
            $userUpgrade = new UserUpgrade;
            $userUpgrade->user_id = $user_id;
            $userUpgrade->upgrade_id = $id;
            $userUpgrade->payment_id = $request->input('payment_gateway_id');
            $userUpgrade->type = $request->input('type');
            $userUpgrade->payment_status = ($request->input('type') == 'paid') ? false : true;
            $userUpgrade->status = false;

            $userUpgrade->save();           
        }

        return redirect()->route('admin.feature-upgrade.index')->with('status', 'New upgrade has been set');
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
    public function destroy($id, $user_id)
    {
        //die($id . ', ' . $user_id);

        $userUpgrade = UserUpgrade::find($id);

        if ( $userUpgrade->delete() ) {
            
            die(
                json_encode(
                    array(
                        'status'    => 'success'
                    )
                )
            );
        } else {
            die(
                json_encode(
                    array(
                        'status'    => 'error',
                        'message'   => 'Error occurred'
                    )
                )
            );
        }
    }
}
