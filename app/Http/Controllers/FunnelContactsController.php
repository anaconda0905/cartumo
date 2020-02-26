<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Funnel;
use App\Models\FunnelStep;
use App\Models\FunnelType;

use Auth;

class FunnelContactsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($funnel_id) {

        $funnel = Funnel::find($funnel_id);
        $steps = FunnelStep::where('funnel_id', $funnel->id)->get();
        $funnelTypes = FunnelType::orderBy('name')->get();
        
        $currentContacts = Order::select('orders.id')
                                ->join('pages', 'pages.id', 'orders.page_id')
                                ->where('pages.funnel_id', $funnel_id)
                                ->where('user_id', Auth::user()->id)
                                ->get();

                                //echo $currentContacts;

        $customers = array();

        foreach ( $currentContacts as $contact ) {

            $details = json_decode($contact->orderDetails->details)->order;

            if ( !empty($details->stripe) )
                $paymentData = $details->stripe;
            else
                $paymentData = $details->paypal;

            if ( !empty($details->shopify) )
                $shopify = $details->shopify;

            
            //get phone number
            if ( !empty($paymentData->customer->phone) ) {
                $phone = $paymentData->customer->phone;
            } else {
                if ( (!empty($paymentData->billing)) && (!empty($paymentData->billing->phone)) ) {
                    $phone = $paymentData->billing->phone;
                } else {
                    $phone = "-";
                }
            }
                
            
            $customers[] = array(
                'first_name'    => $paymentData->customer->first_name,
                'last_name'     => $paymentData->customer->last_name,
                'email'         => (!empty($shopify)) ? $shopify->customer->email : $paymentData->customer->email,
                'phone'         =>  $phone,
            );
        }

        //$customers = array_unique($customers);
        $customers = array_map("unserialize", array_unique(array_map("serialize", $customers)));

        return view("funnels.contacts.list", ['funnel' => $funnel, 'steps' => $steps, 'funnelTypes' => $funnelTypes, 'currentContacts' => $currentContacts, 'customers' => $customers]);
    }
}
