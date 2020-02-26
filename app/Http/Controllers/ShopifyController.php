<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserShop;
use App\Models\FunnelStep;
use App\Models\StepProduct;
use App\Models\UserIntegration;

use Auth;

class ShopifyController extends Controller
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


    public function manageStore(Request $request) {


    }


    public function showShop() {

        $data = array();

        $data['userShop'] = UserShop::where('user_id', Auth::user()->id)->first();

        if ( !empty($data['userShop']) )
            $data['info'] = json_decode($data['userShop']->details);

        //print_r($data['info']); die;

        return view('user.shop.show')->withData($data);
    }


    public function saveShopDetails(Request $request) {

        $userShop = UserShop::where('user_id', Auth::user()->id)->first();

        if ( empty($userShop) ) {
            $userShop = new UserShop();
        } else {
            $userShop = UserShop::find($userShop->id);
        }

        $userShop->user_id = Auth::user()->id;
        $userShop->details = json_encode($request->input('details'));
        $userShop->save();

        die(
            json_encode(
                array(
                    'status'    => 'success',
                    'url'       => route('shopify.shop.show')
                )
            )
        );
    }


    public function getProductList($step_id) {

        $data = array();
        $userIntegration = UserIntegration::where('user_id', Auth::user()->id)->where('service_type', 'shopify')->first();


        if ( !empty($userIntegration) ) {

            $json = json_decode($userIntegration->details);
            //$url = "https://" . $json->name . ".shopify.com/admin/products.json";

            $API_KEY = $json->api_key;
            $API_PASSWORD = $json->password;
            $SECRET = $json->shared_secret;
            $store_name = $json->name;
            //$STORE_URL = 'alldayfreeshipping.myshopify.com';
            //$url = 'https://' . $API_KEY . ':' . md5($SECRET . $TOKEN) . '@' . $STORE_URL . '/admin/products.json';
            //$url = 'https://' . $API_KEY . ':' . md5($SECRET . $TOKEN) . '@' . $STORE_URL . '/admin/products.json';
            //$url = 'http://www.google.com/search?q=curl';

            //https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

            //die($url);
            $url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products.json";
            $data['products'] = json_decode(file_get_contents($url));
            $funnelStep = FunnelStep::find($step_id);

            $data['funnel_id'] = $funnelStep->funnel_id;
            $data['step_id'] = $funnelStep->id;
            $data['stepProduct'] = StepProduct::where('step_id', $step_id)->first();

            //print_r($data['stepProduct']); die;

            $productsView = view('shopify.product-list')->withData($data);
            die($productsView);

            /*$cSession = curl_init();
            curl_setopt($cSession,CURLOPT_URL,$url);
            curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
            //curl_setopt($cSession,CURLOPT_HEADER, false);
            //curl_setopt($cSession,CURLOPT_HTTPHEADER,array('apikey: ' . $API_KEY, 'password: ' . md5($SECRET . $TOKEN) . 'shopName: ' . $data->name));

            $result=curl_exec($cSession);

            curl_close($cSession);

            die(file_get_contents($url));


            $ch = curl_init($url);  //note product ID in url

            //$data_string = json_encode(array('fulfillment' => $fulfillment)); //json encode the product array

            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  //add the data string for the request
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //set return as string true
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json')
            ); //set the header as JSON
            $output = curl_exec($ch); //execute and store server output
            curl_close($ch);
            echo $output;
            //close the connection


            // Get cURL resource
            $curl = curl_init();

            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url
            ));

            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            print_r($resp);

            // Close request to clear up some resources
            curl_close($curl);*/
        }
    }


    public function getImageAdditional(Request $request, $product_id) {

        //echo $product_id;

        $userIntegration = UserIntegration::where('user_id', Auth::user()->id)->where('service_type', 'shopify')->first();
        $json = json_decode($userIntegration->details);

        $API_KEY = $json->api_key;
        $API_PASSWORD = $json->password;
        $SECRET = $json->shared_secret;
        $store_name = $json->name;

        //https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

        //die($url);
        $url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . "/images/" . $request->input('image_id') . ".json";
        die (file_get_contents($url));
    }
}
