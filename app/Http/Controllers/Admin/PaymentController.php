<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\User;
use App\PaymentGateway;
use App\AdminPaymentGateway;

use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth:admin');
     }
    
    public function index()
    {
        $data['paymentGateways'] = AdminPaymentGateway::where('admin_id', Auth::user()->id)->orderBy('id', 'desc')->paginate();
        $gateways = new PaymentGateway();
        $data['availableGateways'] = $gateways->getPaymentGateway();

        return view('admin.settings.payment-gateway.list')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gateways = new PaymentGateway();
        $data['availableGateways'] = $gateways->getAvailablePaymentGatewayAdmin();

        //print_r($data['availableGateways']); die;

        return view('admin.settings.payment-gateway.add')->withData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userPaymentGateway = new AdminPaymentGateway();
        $userPaymentGateway->admin_id    = Auth::user()->id;
        $userPaymentGateway->type      = $request->input('gateway');
        $userPaymentGateway->details    = json_encode($request->input('details'));
        $userPaymentGateway->save();

        die (
            json_encode(
                array(
                    'status'    => 'success',
                    'url'       => route('admin.payment-gateway.index')
                )
            )
        );
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
        $data = array();
        
        $data['paymentGateways'] = AdminPaymentGateway::where('admin_id', Auth::user()->id)->orderBy('id', 'desc')->paginate();
        $gateways = new PaymentGateway();
        $data['availableGateways'] = $gateways->getPaymentGateway();
        $data['gateway'] = AdminPaymentGateway::find($id);
        
        return view('admin.settings.payment-gateway.edit')->withData($data);
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
        $userPaymentGateway = AdminPaymentGateway::find($id);
        $userPaymentGateway->type      = $request->input('gateway');
        $userPaymentGateway->details    = json_encode($request->input('details'));
        $userPaymentGateway->save();

        die (
            json_encode(
                array(
                    'status'    => 'success',
                    'url'       => route('admin.payment-gateway.index')
                )
            )
        );
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
