<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input as Input;

use Illuminate\Support\Facades\Validator;

use Response;

use Auth;
/*use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Stripe\Token;
use Cartalyst\Stripe\Stripe\Customer;
use Cartalyst\Stripe\Stripe\Charge;*/

use App\Models\Funnel;
use App\Models\FunnelStep;
use App\Models\FunnelType;
use App\Models\Product;
use App\Models\StepProduct;
use App\Models\ProductOption;
use App\Models\UserShop;
use App\Models\User;
use App\Models\Order;
use App\Models\Page;
use App\Models\UserPaymentGateway;
use App\Models\OrderDetail;
use App\Models\UserIntegration;

use Session;
use Stripe\Stripe;
use View;
use DateTime;



class OrderController extends Controller
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

        //echo '<pre>'; print_r($_POST); die;

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

        /*$stripe = Stripe::make('sk_test_EhoRMK73zCnQH0kKMESPBmgQ', '2017-04-07');

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
        }*/


        //echo '<pre>'; print_r($_POST); die;

        $page = Page::find($request->input('page_id'));
        $funnelStep = FunnelStep::find($page->funnel_step_id);
        $funnel = Funnel::find($funnelStep->funnel_id);
        $funnelType = FunnelType::find($funnelStep->type);

        //echo strtolower($funnelType->name);

        switch ( strtolower($funnelType->name) ) {

            case 'upsell':  $step = $this->getStep($page, 'upsell', 'downsell');
                $funnelStep = FunnelStep::find($page->funnel_step_id);
                $this->updateProductCart($request, $funnelStep);
                break;

            case 'downsell':    $step = $this->getStep($page, 'downsell', 'confirmation');
                $funnelStep = FunnelStep::find($page->funnel_step_id);
                $this->updateProductCart($request, $funnelStep);
                break;

            case 'order':  $this->saveOrderInfo($request);

            default: $step = $this->getStep($page); break;
        }




        //print_r($step); die;
        //Payment
        $paymentGateway = UserPaymentGateway::find($funnel->payment_gateway);

        if ( $funnel->type == 'shopify' ) {

            if (Session::has('product_current_cart')) {

                //new PaymentController()->makeShopifyPayment();

                app('App\Http\Controllers\PaymentController')->makeShopifyPayment($request, $paymentGateway);

            }

        } else {

            if ( $paymentGateway->type == 'stripe' ) {
                app('App\Http\Controllers\PaymentController')->makeStripePayment($request, $paymentGateway);
            }

            //echo '<pre>'; print_r($paymentGateway); die;

        }





        if ( $step != NULL ) {

            $stepPage = Page::where('funnel_step_id', $step->id)->first();
            //$stepPage = Page::find($stepPage->id);

            die(json_encode(
                array(
                    'status'    => 'success',
                    'url'       => route('page.view', (!empty($stepPage->slug)) ? $stepPage->slug : $stepPage->id)
                )
            ));
        } else {

            die(json_encode(
                array(
                    'status'    => 'success',
                    'url'       => '#'
                )
            ));
        }
    }






    //save payment info
    private function saveOrderInfo(Request $request) {

        //print_r($_POST); die;


        $data['order'] = array();

        //save customer info to session
        $data['order']['customer'] = array(
            'email' => $request->input('email')
        );

        //save shipping to session
        $data['order']['shipping'] = array(
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'full_address' => $request->input('full_address'),
            'apt' => $request->input('apt'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
            'phone' => $request->input('phone')
        );

        //save billing to session
        if ( (!empty($request->input('selection'))) && ($request->input('selection') == 'same') ) {
            $data['order']['billing'] = array(
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'full_address' => $request->input('full_address'),
                'apt' => $request->input('apt'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'state' => $request->input('state'),
                'zip' => $request->input('zip'),
                'phone' => $request->input('phone')
            );
        } else {
            $data['order']['billing'] = array(
                'first_name' => $request->input('billing_first_name'),
                'last_name' => $request->input('billing_last_name'),
                'full_address' => $request->input('billing_full_address'),
                'apt' => $request->input('billing_apt'),
                'city' => $request->input('billing_city'),
                'country' => $request->input('billing_country'),
                'state' => $request->input('billing_state'),
                'zip' => $request->input('billing_zip'),
                'phone' => $request->input('billing_phone')
            );
        }

        //save payment to session
        $data['order']['payment'] = array(
            'number' => $request->input('number'),
            'ccv' => $request->input('ccv'),
            'exp-month' => $request->input('exp-month'),
            'exp-year' => $request->input('exp-year')
        );

        Session::put('product_order_info', $data);
        Session::save();
    }



    //Update Cart
    private function updateProductCart(Request $request, $funnelStep)
    {
        if (Session::has('product_cart')) {
            $data['cart'] = Session::get('product_cart')['cart'];
        } else {
            $data['cart'] = array();
        }

        if (Session::has('product_current_cart')) {
            //$product_current_cart['cart'] = Session::get('product_current_cart')['cart'];
            Session::forget('product_current_cart');
            Session::save();
        } /*else {
            $product_current_cart['cart'] = array();
        }*/

        $product_current_cart['cart'] = array();

        //echo '<pre>'; print_r($data['cart']); die;


        $stepProduct = StepProduct::where('step_id', $funnelStep->id)->first();

        //print_r($funnelStep); die;

        if ( $stepProduct->product_type == 'manual' ) {
            $product = Product::find(json_decode($stepProduct->details)->product_id);
            $product_variant = ProductOption::find($request->input('hid_product_variant_id'));

            $variant_title = "";

            if ( !empty($product_variant->options) ) {
                foreach (json_decode($product_variant->options) as $key => $option) {

                    if ($key == 'price')
                        break;

                    $variant_title = $option . ',';
                }

                $variant_title = trim($variant_title, ',');
            }

            $product_quantity = (!empty($request->input('product_quantity'))) ? $request->input('product_quantity') : 1;

            $data['cart']['products'][] = array(
                'product_id'    => $product->id,
                'title'         => $product->name,
                'image'         => json_decode($product->images)->main,
                'variant'       => (!empty($product_variant->options)) ? ['title' => $variant_title, 'details' => json_decode($product_variant->options), 'image' => $product_variant->image] : array(),
                'quantity'      => $product_quantity,
                'price'         => (!empty($product_variant->options)) ? ['$' . number_format(json_decode($product_variant->options)->price, 2), number_format(json_decode($product_variant->options)->price, 2)] : ['$' . number_format($product->price, 2), number_format($product->price, 2)],
                'total'         => (!empty($product_variant->options)) ? ['$' . number_format((json_decode($product_variant->options)->price * $product_quantity), 2), number_format((json_decode($product_variant->options)->price * $product_quantity), 2)] : ['$' . number_format($product->price * $product_quantity, 2), number_format($product->price * $product_quantity, 2)]
            );

            //recent
            $product_current_cart['cart']['products'][] = array(
                'product_id'    => $product->id,
                'title'         => $product->name,
                'image'         => json_decode($product->images)->main,
                'variant'       => (!empty($product_variant->options)) ? ['title' => $variant_title, 'details' => json_decode($product_variant->options), 'image' => $product_variant->image] : array(),
                'quantity'      => $product_quantity,
                'price'         => (!empty($product_variant->options)) ? ['$' . number_format(json_decode($product_variant->options)->price, 2), number_format(json_decode($product_variant->options)->price, 2)] : ['$' . number_format($product->price, 2), number_format($product->price, 2)],
                'total'         => (!empty($product_variant->options)) ? ['$' . number_format((json_decode($product_variant->options)->price * $product_quantity), 2), number_format((json_decode($product_variant->options)->price * $product_quantity), 2)] : ['$' . number_format($product->price * $product_quantity, 2), number_format($product->price * $product_quantity, 2)]
            );

            $sub_total = 0.0;
            $total = 0.0;

            foreach ( $data['cart']['products'] as $pproduct ) {
                //echo '<pre>'; print_r($pproduct); die;
                $sub_total += doubleval($pproduct['total'][1]);
                $total += doubleval($pproduct['total'][1]);
            }

            $data['cart']['sub_total'] = ['$' . number_format($sub_total, 2), number_format($sub_total, 2)];
            $data['cart']['shipping'] = 'Free';
            $data['cart']['total'] = ['$' . number_format($total, 2), number_format($total, 2)];

            //recent
            $product_current_cart['cart']['sub_total'] = ['$' . number_format($sub_total, 2), number_format($sub_total, 2)];
            $product_current_cart['cart']['shipping'] = 'Free';
            $product_current_cart['cart']['total'] = ['$' . number_format($total, 2), number_format($total, 2)];

        } else {
            //Get the product
            $product = $this->getShopifyProduct(json_decode($stepProduct->details)->product_id, $request);

            //Get the variant
            $product_variant = NULL;
            $product_image = NULL;

            foreach ( $product->product->variants as $variant ) {
                if ( $variant->id == $request->input('hid_product_variant_id') ) {
                    $product_variant = $variant;

                    foreach ( $product->product->images as $image ) {
                        if ( $variant->image_id == $image->id ) {
                            $product_image = $image->src;
                            break;
                        }
                    }

                    break;
                }
            }

            $product_quantity = (!empty($request->input('product_quantity'))) ? $request->input('product_quantity') : 1;


            $data['cart']['products'][] = array(
                'product_id'    => $product->product->id,
                'title'         => $product->product->title,
                'image'         => $product->product->image->src,
                'variant'       => ['title' => $product_variant->title, 'details' => $product_variant, 'image' => $product_image],
                'quantity'      => $product_quantity,
                'price'         => ['$' . number_format($product_variant->price, 2), number_format($product_variant->price, 2)],
                'total'         => ['$' . number_format(($product_variant->price * $product_quantity), 2), number_format(($product_variant->price * $product_quantity), 2)]
            );

            //recent
            $product_current_cart['cart']['products'][] = array(
                'product_id'    => $product->product->id,
                'title'         => $product->product->title,
                'image'         => $product->product->image->src,
                'variant'       => ['title' => $product_variant->title, 'details' => $product_variant, 'image' => $product_image],
                'quantity'      => $product_quantity,
                'price'         => ['$' . number_format($product_variant->price, 2), number_format($product_variant->price, 2)],
                'total'         => ['$' . number_format(($product_variant->price * $product_quantity), 2), number_format(($product_variant->price * $product_quantity), 2)]
            );

            $sub_total = 0.0;
            $total = 0.0;

            foreach ( $data['cart']['products'] as $pproduct ) {
                $sub_total += doubleval($pproduct['total'][1]);
                $total += doubleval($pproduct['total'][1]);
            }

            $data['cart']['sub_total'] = ['$' . number_format($sub_total, 2), number_format($sub_total, 2)];
            $data['cart']['shipping'] = 'Free';
            $data['cart']['total'] = ['$' . number_format($total, 2), number_format($total, 2)];


            //recent
            $product_current_cart['cart']['sub_total'] = ['$' . number_format($sub_total, 2), number_format($sub_total, 2)];
            $product_current_cart['cart']['shipping'] = 'Free';
            $product_current_cart['cart']['total'] = ['$' . number_format($total, 2), number_format($total, 2)];
        }

        Session::forget('product_cart');
        Session::save();

        Session::put('product_cart', $data);
        Session::save();

        //create session for per order
        Session::put('product_current_cart', $product_current_cart);
        Session::save();

        //echo '<pre>'; print_r($data); die;

        return TRUE;
    }



    private function getStep($page, $type_name=NULL, $alternate_type_name=NULL) {

        $funnelSteps = FunnelStep::where('funnel_id', $page->funnel_id)->orderBy('order_position', 'asc')->get();
        $found = false;

        if ( $type_name != NULL ) {
            foreach ($funnelSteps as $step) {

                //return next
                if ( $found ) {
                    return $step;
                }

                $funnelType = FunnelType::find($step->type);

                if ( (strtolower($funnelType->name) == strtolower($type_name)) && ($step->id == $page->funnel_step_id) ) {
                    $found = true;
                }
            }

            if (!$found && $alternate_type_name != NULL) {
                foreach ($funnelSteps as $step) {

                    $funnelType = FunnelType::find($step->type);

                    if (strtolower($funnelType->name) == strtolower($alternate_type_name)) {
                        $found = true;
                        return $step;
                    }
                }
            }

            if ( !$found ) {
                foreach ($funnelSteps as $step) {

                    $funnelType = FunnelType::find($step->type);

                    if (strtolower($funnelType->name) == 'confirmation') {
                        $found = true;
                        return $step;
                    }
                }
            }
        } else {
            $flag = false;
            foreach ($funnelSteps as $step) {

                if ( $flag )
                    return $step;

                //$funnelType = FunnelType::find($step->type);

                if ( $step->id == $page->funnel_step_id ) {
                    $flag = true;
                }
            }
        }

        return NULL;
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
        $order = Order::find($id);

        $html = View::make('order.details', array('order' => $order))->render();

        die(
            json_encode(
                array(
                    'status'    => 'success',
                    'html'      => $html
                )
            )
        );
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







    //Get Order Session
    public function getOrderSession(Request $request) {

        $data = array();

        if (Session::has('product_order_info')) {

            $order = Session::get('product_order_info');

            //print_r($data['order']); die;

            die(
            json_encode(
                array(
                    'status'    => 'success',
                    'html'      => View::make('editor.widgets.frontend.product_order_info', array('order' => $order))->render()
                    //'html'      => view('editor.widgets.frontend.product_order_info')->withData($data)
                )
            )
            );
        } else {
            die(
            json_encode(
                array(
                    'status'    => 'error',
                    'message'   => 'Unable to fetch order information'
                )
            )
            );
        }
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

            $stripe = json_decode( $order->orderDetails->details )->order->stripe;
            $shopify = json_decode( $order->orderDetails->details )->order->stripe;
            //$product = $order->product;

            $downloadOrders['orders'][] = array(
                'id'                => $order->id,
                'date'              => date('M d, Y', strtotime($order->updated_at)),
                'title'             => $shopify->product->title . '(' . \App\FunnelType::find(\App\FunnelStep::find(\App\Page::find($order->page_id)->funnel_step_id)->type)->name . ')',
                'amount'            => number_format($shopify->amount,2) . ' ' . $shopify->currency,
                'customer'          => $shopify->customer->first_name . ' ' .$shopify->customer->last_name . '(' . $shopify->customer->email . ')',
                'status'              => $stripe->status
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


    private function getShopifyProduct($product_id, $request) {

        $userIntegration = UserIntegration::where('user_id', $request->input('frm_hid_user_id'))->where('service_type', 'shopify')->first();
        $json = json_decode($userIntegration->details);

        $API_KEY = $json->api_key;
        $API_PASSWORD = $json->password;
        $SECRET = $json->shared_secret;
        $store_name = $json->name;

        //https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

        //die($url);
        $url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . ".json";
        return json_decode(file_get_contents($url));
    }


    public function getLatestOrderToast(Request $request) {

        $date = new DateTime;
        $date->modify('-1 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');

        //echo $formatted_date; die;
        
        $order = Order::where('user_id','=', Auth::id())
                      ->where('created_at','<=', $formatted_date)
                      ->where('status', false)
                      ->orderBy('id', 'desc')
                      ->first();  
                      
        //echo $order; die;

        if ( (!empty($order)) && $order->count() > 0 ) {
            $details = json_decode($order->orderDetails->details)->order;   

            if ( !empty($details->stripe) )
                $pdetails = $details->stripe;
            elseif ( $details->paypal )
                $pdetails = $details->paypal;
            
            //update the order status, as viewed
            $order->status = true;
            $order->save();

            die(
                json_encode(
                    array(
                        'status'    => 'success',
                        'title'     => $pdetails->customer->first_name . ' ' . $pdetails->customer->last_name,
                        'message'   => 'Brought ' . $pdetails->product->title,
                        'url'       => route('sales.index')
                    )
                )
            );
        } else {
            die(
                json_encode(
                    array(
                        'status'    => 'error'
                    )
                )
            );
        }
    }


    public function addTracking() {
dd('httt');
        $order = Order::find($order_id);
        $order->tracking_number = $request->input('tracking_number');
        
        if ( $order->save() ) {
            die(
                json_encode(
                    array(
                        'status'    => 'success',
                        'message'   => 'Tracking number has been updated'
                    )
                )
            );
        } else {
            die(
                json_encode(
                    array(
                        'status'    => 'error',
                        'message'   => 'Error! please try again later'
                    )
                )
            );
        }
    }

}
