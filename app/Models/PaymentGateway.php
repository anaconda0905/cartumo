<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\UserPaymentGateway;
use App\Models\AdminPaymentGateway;

use Auth;

class PaymentGateway extends Model
{
    private $gateways = array(

        'PayPal'   => array(
            array(
                'title'     => 'Title',
                'client_id' => 'Your client ID here',
                'secret'    => 'Your client secret here',
                'email'     => 'Your business email here',
                'mode'      => ['Sandbox', 'Live'],
                'icon'      => 'fa fa-paypal'
            ),
        ),
        'Stripe'   => array(
            array(
                'title'     => 'Title',
                'secret_key'        => 'Your secret key here',
                'publishable_key'   => 'Your publishable key here',
                'icon'              => 'fa fa-cc-stripe'
            ),
        )
    );


    public function getPaymentGateway($gateway_name=NULL) {

        $gateways = array();

        if ( $gateway_name !== NULL ) {
            return $this->gateways[strtolower($gateway_name)];
        }

        foreach ( $this->gateways as $key=>$item ) {
            $userPaymentGateway = UserPaymentGateway::where('user_id', Auth::user()->id)->get();
            $flag = FALSE;

            foreach ( $userPaymentGateway as $gateway ) {
                if ( strtolower($gateway->type) == strtolower($key) ) {
                    $flag = TRUE;
                    break;
                }
            }

            if ( $flag ) {
                $gateways[$key] = $item;
            }
        }

        //echo '<pre>'; print_r($gateways); die;

        return $gateways;
    }



    public function getAvailablePaymentGateway($gateway_name=NULL) {

        $gateways = array();

        if ( $gateway_name !== NULL ) {
            return $this->gateways[strtolower($gateway_name)];
        }

        foreach ( $this->gateways as $key=>$item ) {
            $userPaymentGateway = UserPaymentGateway::where('user_id', Auth::user()->id)->get();
            $flag = FALSE;

            foreach ( $userPaymentGateway as $gateway ) {
                if ( strtolower($gateway->type) == strtolower($key) ) {
                    $flag = TRUE;
                    break;
                }
            }

            if ( !$flag ) {
                $gateways[$key] = $item;
            }
        }

        //echo '<pre>'; print_r($gateways); die;

        return $gateways;
    }


    public function getAvailablePaymentGatewayAdmin($gateway_name=NULL) {

                $gateways = array();

                if ( $gateway_name !== NULL ) {
                    return $this->gateways[strtolower($gateway_name)];
                }

                foreach ( $this->gateways as $key=>$item ) {
                    $adminPaymentGateway = AdminPaymentGateway::where('admin_id', Auth::user()->id)->get();
                    $flag = FALSE;

                    foreach ( $adminPaymentGateway as $gateway ) {
                        if ( $gateway->type == $key ) {
                            $flag = TRUE;
                            break;
                        }
                    }

                    if ( !$flag ) {
                        $gateways[$key] = $item;
                    }
                }

                //echo '<pre>'; print_r($gateways); die;

                return $gateways;
    }


    public static function isSetup($gateway_name) {
        $gateways = UserPaymentGateway::where('type', $gateway_name)->first();

        return $gateways;
    }
}
