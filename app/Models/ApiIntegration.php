<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\UserIntegration;

use Auth;

class ApiIntegration extends Model
{
    private $integrations = array(

        'shop'  => array(
            array(
                'shopify'   => array(
                    'title'     => 'Mail Chimp',
                    'image'     => 'shopify.png'
                ),
            ),            
            'icon'      => 'fa-shopping-cart'  
        ),
        'shipping'  => array(
            array(
                'mailchimp'   => array(                
                    'title'     => 'Mail Chimp',
                    'image'     => 'mailchimp.png'
                ),
                'zoho'   => array(               
                    'title'     => 'Zoho',
                    'image'     => 'zoho.png'
                ),
                'aweber'   => array(               
                    'title'     => 'Aweber',
                    'image'     => 'aweber.png'
                ),
                'kajabi'   => array(               
                    'title'     => 'Kajabi',
                    'image'     => 'kajabi.png'
                ),
                'shipstation'   => array(               
                    'title'     => 'Shipstation',
                    'image'     => 'shipstation.png'
                )
            ),            
            'icon'      => 'fa-envelope'    
        ),
        /*'shipping' => array(
            array(
                'constactcontact' => array(
                    'title'     => 'Constant Contact',
                    'image'     => 'constantcontact.png'
                )
            ),
            'icon'      => 'fa-envelope' 
        )*/
    );

        /*'shopify'   => array(
            array(
                'title'     => 'Mail Chimp',
                'image'     => 'shopify.png',
                'type'      => 'shop'
            ),
        ),
        'mailchimp'   => array(
            array(
                'title'     => 'Mail Chimp',
                'image'     => 'mailchimp.png',
                'type'      => 'mail'
            ),
        ),
        'aweber'   => array(
            array(
                'title'     => 'Aweber',
                'image'     => 'aweber.png',
                'type'      => 'mail'
            ),
        ),
        'kajabi'   => array(
            array(
                'title'     => 'Kajabi',
                'image'     => 'kajabi.png',
                'type'      => 'mail'
            ),
        ),
        'shipstation'   => array(
            array(
                'title'     => 'Shipstation',
                'image'     => 'shipstation.png',
                'type'      => 'mail'
            ),
        ),
    );*/


    public function getIntegrations($type=NULL) {

        if ( $type == NULL ) {

            return $this->integrations;
        } else {

            $this->integrations[$type];
        }
    }

    public function getIntegration($type, $name) {
        
        return $this->integration[$type][0][$name];
    }

    public function getAvailableIntegrations() {

        $available_integrations = array();

        foreach ( $this->integrations as $k=>$integrations ) {
            foreach ( $integrations[0] as $key=>$integration ) {
                $userIntegrations = UserIntegration::where('user_id', Auth::user()->id)->get();
                $flag = FALSE;
    
                foreach ( $userIntegrations as $user_key=>$user_integration ) {
                    if ( $user_integration->service_type == $key ) {
                        $flag = TRUE;
                        break;
                    }
                }

                if ( ! $flag ) {
                    $available_integrations[$k][$key] = $integration;
                }
            }
        }

        //print_r($available_integrations); die;

        return $available_integrations;
    }


    /*public function getIntegrations($integration_name=NULL) {

        $integrations = array();

        if ( $integration_name !== NULL ) {

            //echo $integration_name; die;

            $ints = explode(',', $integration_name);
            
            //print_r($this->integrations[$ints[1]][0][$ints[0]]); die;
            return $this->integrations[$ints[1]][0][$ints[0]];
        }

        foreach ( $this->integrations as $key=>$items ) {           

            //print_r($userIntegrations->count()); die;

            if ( $this->checkMatch($items, $key) ) {

            } else {

            }
        }

        //echo '<pre>'; print_r($integrations); die;

        return $integrations;
    }*/






    /*public function getAvailableIntegrations($gateway_name=NULL) {

        $integrations = array();

        if ( $gateway_name !== NULL ) {
            return $this->integrations[strtolower($gateway_name)];
        }

        foreach ( $this->integrations as $key=>$item ) {
            $userIntegrations = UserIntegration::where('user_id', Auth::user()->id)->get();
            $flag = FALSE;

            foreach ( $userIntegrations as $integration ) {
                if ( $integration->service_type == $key ) {
                    $flag = TRUE;
                    break;
                }
            }

            if ( !$flag ) {
                $integrations[$key] = $item;
            }
        }

        //echo '<pre>'; print_r($gateways); die;

        return $integrations;
    }*/


    public static function isSetup($integration_name) {
        $integrations = UserIntegration::where('service_type', $integration_name)->first();

        return $integrations;
    }


    /*public function getIntegration($title) {

        foreach ( $this->integrations as $integration ) {
            if ( strtolower($integration['title']) == strtolower($title) ) {
                return $integration;
            }
        }

        return FALSE;
    }*/
}
