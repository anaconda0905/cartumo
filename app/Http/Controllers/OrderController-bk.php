<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input as Input;

use Illuminate\Support\Facades\Validator;

use Response;

use Auth;
use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Stripe\Token;
use Cartalyst\Stripe\Stripe\Customer;
use Cartalyst\Stripe\Stripe\Charge;

use App\Models\FunnelStep;
use App\Models\FunnelType;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Page;
use App\Models\OrderDetail;

use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(15);

        return view('order.list', array('orders'=>$orders));
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

    public function store(Request $request) {

        /*$validator = Validator::make(Input::all(), [
            'full_name' => 'required|string|min:5|max:52',
            'email' => 'required|email',
            'phone' => 'required',
            'full_address'  => 'required',
            'city'  => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'product' => 'required',
            'number' => 'required',
            'ccv' => 'required',
            'exp-month' => 'required',
            'exp-year' => 'required'
        ]);

        if ($validator->fails()) {
            echo redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }*/

        $stripe = Stripe::make('sk_test_EhoRMK73zCnQH0kKMESPBmgQ', '2017-04-07');

        $dcard = array(
            'number'    => $request->get('number'),
            'exp_month' => $request->get('exp-month'),
            'cvc'       => $request->get('ccv'),
            'exp_year'  => $request->get('exp-year'),
        );

        //print_r($dcard); die;

        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $request->get('number'),
                    'exp_month' => $request->get('exp-month'),
                    'cvc'       => $request->get('ccv'),
                    'exp_year'  => $request->get('exp-year'),
                ],
            ]);

            if (!isset($token['id'])) {
                echo 'The Stripe Token was not generated correctly';
            } else {
                //print_r($token); die;
            }
        } catch (Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /*public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), [
            'full_name' => 'required|string|min:5|max:52',
            'email' => 'required|email',
            'phone' => 'required',
            'full_address'  => 'required',
            'city'  => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'product' => 'required',
            'number' => 'required',
            'ccv' => 'required',
            'exp-month' => 'required',
            'exp-year' => 'required'
        ]);

        if ($validator->fails()) {
            echo redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $stripe = Stripe::make('sk_test_EhoRMK73zCnQH0kKMESPBmgQ', '2017-04-06');

        //echo $request->input('number') . ',' . $request->input('exp-month') . ', ' . $request->input('exp-year') . ', ' . $request->input('ccv');


        if ( !Session::has('credit_card_details') ) {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $request->input('number'),
                    'exp_month' => $request->input('exp-month'),
                    'exp_year'  => $request->input('exp-year'),
                    'cvc'       => $request->input('ccv'),
                ],
            ]);

            Session::put('token_details', array('id' => $token['id']));
        }

        //print_r(Session::get('token_details')); die;
        else {
            $card = Session::get('credit_card_details');
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $card['number'],
                    'exp_month' => $card['exp_month'],
                    'exp_year'  => $card['exp_year'],
                    'cvc'       => $card['ccv'],
                ],
            ]);
        }


        if ( !Session::has('shipping_details') ) {
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $full_address = $request->input('full_address');
            $city = $request->input('city');
            $state = $request->input('state');
            $zip = $request->input('zip');
            $country = $request->input('country');

            Session::put('shipping_details', array(
                'first_name'     => $first_name,
                'last_name'     => $last_name,
                'email'         => $email,
                'phone'         => $phone,
                'full_address'  => $full_address,
                'city'          => $city,
                'state'         => $state,
                'zip'           => $zip,
                'country'      => $country,
            ));
        } else {

            $shipping = Session::get('shipping_details');

            $full_name = $shipping['first_name'] . ' ' . $shipping['last_name'];
            $email = $shipping['email'];
            $phone = $shipping['phone'];
            $full_address = $shipping['full_address'];
            $city = $shipping['city'];
            $state = $shipping['state'];
            $zip = $shipping['zip'];
            $country = $shipping['country'];
        }

        if ( !Session::has('credit_card_details') ) {

            $card_number = $request->input('card_number');
            $ccv = $request->input('ccv');
            $exp_month = $request->input('exp_month');
            $exp_year = $request->input('exp_year');

            Session::put(
                'credit_card_details', array(
                    'number'        => $request->input('number'),
                    'ccv'           => $request->input('ccv'),
                    'exp_month'     => $request->input('exp-month'),
                    'exp_year'      => $request->input('exp-year')
                )
            );

            //Session::save();

        } else {

            $card = Session::get('credit_card_details');

            $card_number = $card['number'];
            $ccv = $card['ccv'];
            $exp_month = $card['exp_month'];
            $exp_year = $card['exp_year'];
        }

        $token = $token['id'];
        //$product = $request->input('product');
        $stepProduct = StepProduct::find(Session::get('product_checkout_product'));
        $product = Product::find($stepProduct->product_id);
        $names = explode(' ', $full_name);
        $emailCheck = User::where('email', $email)->value('email');

        $page = Page::find($request->input('frm_hid_page_id'));
        $funnelStep = FunnelStep::find($page->funnel_step_id);
        $funnelType = FunnelType::find($funnelStep->type);*/


        //$customer = $stripe->customers()->find($request->input('stripeToken'));

        //print_r($product); die;

        /*try {
                //$customer = $stripe->customers()->find($token);

                //if ( empty($customer['id']) ) {
                    $customer = $stripe->customers()->create([
                'source' => $token,
                'email' => $email,
                'metadata' => [
                    "First Name" => $first_name,
                    "Last Name" => $last_name
                ]
                    ]);
                //}

                //print_r($customer);
            } catch (\Stripe\Error\Card $e) {
                return redirect()->route('order')
                    ->withErrors($e->getMessage())
                    ->withInput();
            }

        $charge = $stripe->charges()->create([
            'amount' => doubleval(Session::get('product_price')),
                'currency' => 'usd',
                'customer' => $customer['id'],
                'metadata' => [
                    'product_name' => $product->name
                ]
        ]);

        //echo '<pre>'; print_r($customer);

        if ( !empty($charge['id']) ) {

            /////////////////////////////////



            /////////////////////////
            $order = new Order;
            $order->user_id = Auth::id();
            $order->product_id = $product->id;
            $order->step_product_id = $request->input('step_product_id');
            $order->created_at = date('Y-m-d h:i:s');
            $order->updated_at = date('Y-m-d h:i:s');
            $order->save();

            $payment_data = array(
                'charge'    => $charge,
                'customer'  => $customer
            );

            $orderDetails = new OrderDetail;
            $orderDetails->order_id = $order->id;
            $orderDetails->payment_getway = 'stripe';
            $orderDetails->stripe_details = json_encode($payment_data);
            $orderDetails->created_at = date('Y-m-d h:i:s');
            $orderDetails->updated_at = date('Y-m-d h:i:s');
            $orderDetails->save();


            //store orders to seesion to view recent purchased
            $products = array();

            if ( Session::has('purchaded_products') ) {
                $products = Session::get('purchaded_products');
            }

            $product->price = doubleval(Session::get('product_price'));

            array_push($products, $product);
            Session::put('purchaded_products', $products);
            Session::save();


            //////////////////////////////////////////////////////
            if ( strtolower($funnelType->name) == 'order' ) {
                $pageRoute = $this->getPage($request->input('page_id'), 'upsell');
            } elseif ( strtolower($funnelType->name) == 'upsell' ) {
                $pageRoute = $this->getPage($request->input('page_id'), 'downsell');
            } else {
                $pageRoute = $this->getPage($request->input('page_id'), 'confirmation');
            }

            echo json_encode(
                array(
                    'status'    => 200,
                    'url'       => (!empty($pageRoute)) ? $pageRoute : '#'
                )
            );
        }

        die;
    }
    */


    private function getPage($page_id, $page_name='') {

        $page = Page::find($page_id);
        $step = $this->isStepPresent($page, $page_name);

        if ( $step != null ) {
            $template = Page::where('funnel_id', $page->funnel_id)->where('funnel_step_id', $step->id)->first();

            if ( !empty($template) )
                return route('pages.show', $template->id);
        }

        //confirmation page
        $step = $this->isStepPresent($page, 'Confirmation');

        if ( !empty($step) ) {
            $template = Page::where('funnel_id', $page->funnel_id)->where('funnel_step_id', $step->id)->first();

            if ( !empty($template) )
                return route('pages.show', $template->id);
        }

        return null;
    }


    private function isStepPresent($page, $page_name='') {

        $funnelSteps = FunnelStep::where('funnel_id', $page->funnel_id)->orderBy('order_position')->get();

        foreach ( $funnelSteps as $step ) {

            $funnelType = FunnelType::find($step->type);

            if ( strtolower($funnelType->name) == strtolower($page_name) ) {
                //echo strtolower($funnelType->name) == $page_name;
                return $step;
            }
        }

        return null;
    }




    public function getRecentOrders() {

        $products = Session::get('purchaded_products');

        //print_r($products); die;
        //echo "hello"; die;

        die (view('editor.widgets.frontend.recent_order_list', array('products' => $products)));
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







    public function downloadCSV()
    {
        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=sales.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        $orders = Order::where('user_id', Auth::id())->get();
        $downloadOrders = array();

        foreach ($orders as $key => $order) {

            $details = $order->orderDetails;
            $paymentDetails = json_decode( $order->orderDetails->stripe_details );
            //$product = $order->product;

            $downloadOrders['orders'][] = array(
                'id'                => $order->id,
                'product_name'      => $order->product->name,
                'currency'          => '$',
                'product_cost'      => '$' . $order->product->price,
                'date'              => date('Y-m-d h:i:s', strtotime($order->updated_at)),
                'payment_method'    => $details->payment_getway,
                'status'            => $paymentDetails->charge->status
            );
        }

        //print_r($downloadOrders);

        //print_r($list);

        $downloadOrders = $downloadOrders['orders'];

        # add headers for each column in the CSV download
        array_unshift($downloadOrders, array_keys($downloadOrders[0]));

        $callback = function() use ($downloadOrders)
        {
            $FH = fopen('php://output', 'w');
            foreach ($downloadOrders as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);
    }
}
