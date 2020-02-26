<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Profile;
use App\Models\UserUpgrade;
use App\Models\UserPayment;
use App\Models\FeatureUpgrad;
use App\Models\AdminPaymentGateway;

use Auth;
use Session;
use Exception;

class FeatureUpgradeController extends Controller
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
        $data['userUpgrades'] = UserUpgrade::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('upgrade.list')->withData($data);
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
        //$payment

        $userUpgrade = UserUpgrade::find($request->input('hid_upgrade_id'));
        $adminPaymentGateway = AdminPaymentGateway::find($userUpgrade->payment_id);
        $featureUpgrad = FeatureUpgrad::find($userUpgrade->upgrade_id);
        $itemType = Item::find($featureUpgrad->type);

        if ( $adminPaymentGateway->type == 'stripe' ) {

            $product = array(
                'name'      => $featureUpgrad->name,
                'type'      => $itemType->name,
                'amount'    => $request->input('purchase_plan')
            );

            $payment = $this->makeStripePayment($request, json_decode($adminPaymentGateway->details), $product);

        } elseif ( $adminPaymentGateway->type == 'paypal' ) {


        }



        // update status that it's paid
        if ( $payment->status ) {

            $userUpgrade->payment_status = true;
            $userUpgrade->save();

            die(
                json_encode(
                    array(
                        'status'    => 'success',
                    )
                )
            );
        } else {
            die(
                json_encode(
                    array(
                        'status'    => 'error',
                    )
                )
            );
        }       
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








    //////////////////////////////////////////////////////////////////////////////////////////////


    /////////////////////////////////////////////// STRIPE ////////////////////////////////////////
    private function makeStripePayment(Request $request, $payment_details, $product)
    {        
        //save card details and get a token
        $url = "https://api.stripe.com/v1/tokens";
        $post_data['card'] = array(
            'number' => $request->input('number'),
            'exp_month' => $request->input('exp-month'),
            'exp_year' => $request->input('exp-year'),
            'cvc' => $request->input('cvc')
        );
        $auth = "Bearer $payment_details->secret_key"; // . $payment_details->secret_key;
        $card_token = json_decode($this->makeStripePostRequest($url, $post_data, $auth, 'card'));
        

        //create a customer with the card token
        $url = "https://api.stripe.com/v1/customers";
        $post_data = array(
            'email' => $request->input('email'),
            'source' => $card_token->id
        );

        $customer = json_decode($this->makeStripePostRequest($url, $post_data, $auth));
        $customer_id = $customer->id;

        // ------------------ MAKE PAYMENT -----------------------
        //Charge the Customer instead of the card
        $url = "https://api.stripe.com/v1/charges";
        $amount = floatVal($product['amount']) * 100;
        $post_data = array(
            'amount' =>  $amount, //($amount < 50) ? $amount*5 : $amount,
            'currency' => 'usd',
            'customer' => $customer_id
        );

        //echo '<pre>'; print_r($post_data); die;
        $charge = json_decode($this->makeStripePostRequest($url, $post_data, $auth));
        //echo '<pre>'; print_r($post_data); print_r($charge); 
        
        $names = Auth::user()->name;

        if ( stripos($names, ' ') !== FALSE ) {
            $names = explode(' ', $names);
        } else {
            $names[] = $names;
            $names[] = '';
        }


        //order
        $orderDetails = array(
            'charge_id' => $charge->id,
            'customer' => array(
                'id' => $charge->customer,
                'email' => Auth::user()->email,
                'first_name' => $names[0],
                'last_name' => $names[1]
            ),
            'product' => [                
                'title' => $product['name'],                
            ],
            'amount' => $charge->amount,
            'total_amount'  => $amount,
            'balance_transaction' => $charge->balance_transaction,                        
            'currency' => $charge->currency,
            'source' => $charge->source->id,
            'status' => $charge->status,
        );
        

        $manualDetails['payment_details'] = $orderDetails;

        //save the order
        $order = new UserPayment;
        $order->user_id = Auth::id(); //
        $order->upgrade_id = $request->input('hid_upgrade_id');
        $order->details = json_encode($manualDetails);
        $order->status = true;
        $order->save();
        
        //echo '<pre>'; print_r($charge); die; 
        return $order;       
    }



    ///////////////////////////// PAYPAL PAYMENT /////////////////////////////////
    public function makePaypalPayment($request,  $payment_details, $product) {       
       
        //Get an access token 
        $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
        $clientId = $payment_details->client_id;
        $secret = $payment_details->secret;
        $email = $payment_details->email;
        $title = $payment_details->title;
        $data_string = 'grant_type=client_credentials';
        $access_token = '';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $result = curl_exec($ch);

        if(empty($result))die("Error: No response.");
        else
        {
            $json = json_decode($result);
            //echo '<pre>'; print_r($json);

            $access_token = $json->access_token; 

            $names = Auth::user()->name;            
            if ( stripos($names, ' ') !== FALSE ) {
                $names = explode(' ', $names);
            } else {
                $names[] = $names;
                $names[] = '';
            }



            //Get details from user profile
            $profile = Profile::where('user_id', Auth::id())->first();

            $billing_address = array(                    
                "line1" => (!empty($profile->street_address)) ? $profile->street_address : "test",                
                "city" => (!empty($profile->city)) ? $profile->city : "test",
                "state" => (!empty($profile->state)) ? $profile->state : "test",
                "postal_code" => (!empty($profile->zip)) ? $profile->zip : "test",
                "country_code" => 'US' //$request->input('billing_country')
            );
            
            $funding_instruments = array(
                        array(
                            'credit_card'   => array(
                                'number'        => $request->input('number'),
                                'type'          => "visa",
                                'expire_month'  => $request->input('exp-month'),
                                'expire_year'   => $request->input('exp-year'),
                                'cvv2'          => $request->input('cvc'),
                                'first_name'    => $names[0],
                                'last_name'     => $names[1],
                                'billing_address'   => $billing_address
                            )
                        )                        
            );
                     
            $payment_data = array(
                'intent'    => 'sale',
                'payer'     => array(
                    'payment_method'        => 'credit_card',
                    'funding_instruments'   => $funding_instruments
                ),
                'transactions'  => array(
                    array(
                        'amount'    => array(
                            'total' =>  number_format($product['amount'], 2),
                            'currency'  => 'USD',
                            'details'   => array(
                                'subtotal'  => number_format(floatVal($product['amount']), 2),
                                'tax'   => number_format(floatVal(0.00), 2),
                                //'shipping'  => $shipping
                            )
                        ),
                        "description" => "The payment transaction description."                        
                    )
                ),
                
            );

            //echo json_encode($payment_data); die;

            //convert to json to request
            $payment_data = json_encode($payment_data);

            //echo $payment_data; die;

            //make payment
            curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payment_data); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$access_token));

            $result = curl_exec($ch);

            if(empty($result))
                die("Error: No response.");
            else
            {
                $result = json_decode($result);
                //print_r($result);                

                


                ////////////////////
                foreach ( $result->transactions as $transactions ) {
                    break;
                }
        
                
                $orderDetails = array(
                    'id' => $result->id,
                    'customer' => array(                        
                        'email' => Auth::user()->email,
                        'first_name' => $names[0],
                        'last_name' => $names[1]
                    ),
                    'product' => [                        
                        'title' => $product['name']
                    ],
                    'amount' => $transactions->amount->total,
                    'total_amount'  => number_format($product['amount'], 2),                    
                    'currency' => $transactions->amount->currency,
                    'status' => $result->state,
                );

                

                $manualDetails['order']['paypal'] = $orderDetails;

                //save the order
                $manualDetails['payment_details'] = $orderDetails;
                    
                //save the order
                $order = new UserPayment;
                $order->user_id = Auth::id(); //
                $order->upgrade_id = $request->input('hid_upgrade_id');
                $order->details = json_encode($manualDetails);
                $order->status = true;
                $order->save();
                //echo '<pre>'; print_r($charge); die;
               

                return $order;
            }            
        }

        curl_close($ch);

        
        return FALSE;
    }


    /////////////////////////////////////////////////////////////////////////////////////////////





    private function makeStripePostRequest($url, $data = NULL, $auth = NULL, $card = NULL)
    {

        try {
            $ch = curl_init($url);
            //$data_string = json_encode($data);

            $data_string = "";

            if (!empty($card)) {
                foreach ($data['card'] as $key => $val) {
                    $data_string .= "card[" . $key . "]=" . $val . "&";
                }
            } else {
                foreach ($data as $key => $val) {
                    $data_string .= $key . "=" . $val . "&";
                }

                //print_r($data_string); die;
            }

            $data_string = trim($data_string, '&');


            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            if ($auth !== NULL)
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $auth, 'Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($data_string)));
            else
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($data_string)));
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

            $output = curl_exec($ch);

            if (FALSE === $output)
                throw new Exception(curl_error($ch), curl_errno($ch));
            else {
                return $output;
                //$this->data = $output;
            }

            // ...process $output now
        } catch (Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);
        }

        return FALSE;
    }


    public function updateStatus(Request $request) {

        $userUpgrade = UserUpgrade::find($request->input('upgrade_id'));
        $userUpgrade->status = !$userUpgrade->status;  
        
        if ( $userUpgrade->save() ) {

            die(
                json_encode(
                    array(
                        'status'    => 'success',
                    )
                )
            );
        } else {
            die(
                json_encode(
                    array(
                        'status'    => 'error',
                    )
                )
            );
        }
    }
    
    
    public function cancelUpgrade(Request $request) {

        $userUpgrade = UserUpgrade::find($request->input('upgrade_id'));
        $userPayments = UserPayment::where('user_id', $userUpgrade->user_id)->get();

        //delete all payment of the user
        foreach ( $userPayments as $payment ) {
            $payment->delete();
        }        

        if ( $userUpgrade->delete() ) {

            die(
                json_encode(
                    array(
                        'status'    => 'success',
                    )
                )
            );
        } else {
            die(
                json_encode(
                    array(
                        'status'    => 'error',
                    )
                )
            );
        }
        
    }
}
