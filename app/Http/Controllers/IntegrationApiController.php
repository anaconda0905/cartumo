<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntegrationApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetchMailChimpLists($data, $output = TRUE) {

        $info = json_decode($data->details);
        //print_r($info); die;
        $exp_data = (explode('-', $info->apikey));
        $api_prefix = end($exp_data);

        //$auth = "key d4dcecbad1fe6d26f1efab03428d3b69-us9";
        $auth = "key " . $data->apikey;
        $url = "http://" . $api_prefix . ".api.mailchimp.com/3.0/lists/";

        $lists = $this->makeGetRequest($url, $info, $auth);

        if ( $output )
            die($lists);
        else {
            echo $lists; die;
            return $lists;
        }
    }





    private function makeGetRequest($url, $data=NULL, $auth=NULL) {

        try {
            $ch = curl_init($url);
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Basic '.base64_encode( 'user:'. $data->apikey )
            );

            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            //echo $data->username . ':' . $data->apikey; die;

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Authorization: ' . $auth, 'Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

            $output = curl_exec($ch);



            if (FALSE === $output)
                throw new Exception(curl_error($ch), curl_errno($ch));
            else {
                return $output;
            }

            // ...process $output now
        } catch(Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);
        }

        return FALSE;
    }




    private function makePostRequest($url, $data = NULL, $auth=NULL, $card=NULL) {

        try {
            $ch = curl_init($url);
            //$data_string = json_encode($data);

            $data_string = "";

            if ( !empty($card) ) {
                foreach ( $data['card'] as $key=>$val ) {
                    $data_string .= "card[".$key."]=".$val."&";
                }
            } else {
                foreach ( $data as $key=>$val ) {
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
            if ( $auth !== NULL )
                curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Authorization: ' . $auth, 'Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($data_string)));
            else
                curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($data_string)));
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
        } catch(Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);
        }

        return FALSE;
    }
}
