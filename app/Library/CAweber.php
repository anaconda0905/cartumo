<?php
namespace App\Library;

require_once 'libs/aweber/aweber_api/aweber_api.php';
/*require_once 'oauth/src/OAuth2/Client.php';
require_once 'oauth/src/OAuth2/AuthorizationCode.php';
require_once 'oauth/src/OAuth2/ClientCredentials.php';
require_once 'oauth/src/OAuth2/IGrantType.php';*/

use AWeberAPI;
use Illuminate\Http\Request;
use Session;

class CAweber 
{
    protected $app_id;
    protected $consumerKey;
    protected $consumerSecret;
    protected $accessToken;
    protected $accessSecret;
    protected $application;

    public function __construct() {

        $app_id = '5e5017e7';
        $this->consumerKey = 'AkjaT4yiKEFb50FO0L11c0k6';
        $this->consumerSecret = '9ycuBSONDH0JiSniBk8Mj7fY4TENmV9lgOXDBE8f';
        $this->accessToken = 'XXX';
        $this->accessSecret = 'XXX';

        $this->application = new AWeberAPI($this->consumerKey, $this->consumerSecret);
        //$this->connectToAWeberAccount();
    }

    public function connectToAWeberAccount(Request $request) {
        $appID = $this->app_id;
        //appID is used to authenticate. To get account data via the api, you
        //must use the consumer key and secret along with the access key and secret
        //associated with the AWeber Account being queried.
        $authorize_url = "https://auth.aweber.com/1.0/oauth/authorize_app/$appID";
        $callback_url = route('integration.process.data', 'aweber');

        list($requestToken, $requestTokenSecret) = $this->application->getRequestToken($callback_url);
        //setcookie('requestTokenSecret', $requestTokenSecret);
        //setcookie('callbackUrl', $callback_url);
        Session::put('requestTokenSecret', $requestTokenSecret);
        Session::put('callbackUrl', $callback_url);        
        Session::save();
        return $this->application->getAuthorizeUrl();
    }

    public function getAccessTokens($request_token, $oauth_verifier) {

        //echo Session::get('requestTokenSecret'); die;
        $this->application->user->tokenSecret = Session::get('requestTokenSecret');
        $this->application->user->requestToken = $request_token;
        $this->application->user->verifier = $oauth_verifier;
        list($accessToken, $accessTokenSecret) = $this->application->getAccessToken();
        Session::put('accessToken', $accessToken);
        Session::put('accessTokenSecret', $accessTokenSecret);
        Session::save();
        //setcookie('accessToken', $accessToken);
        //setcookie('accessTokenSecret', $accessTokenSecret);
        //header('Location: '.$_COOKIE['callbackUrl']);
        //return redirect();
        return Session::get('callbackUrl');
    }


    public function getLists($userIntegration) {
        $details = json_decode($userIntegration->details);
        $account = $this->application->getAccount($details->accessToken, $details->accessTokenSecret);

        //echo '<pre>'; print_r($account->lists);
        $lists = array();

        foreach ( $account->lists as $list ) {
            $lists[] = array(
                'id'    => $list->id,
                'name'  => $list->name
            );
        }

        return $lists;
    }


    public function addNewSubscriber($userIntegration, $data, $details) {

        /*print_r($userIntegration);
        print_r($data);
        print_r($details);
        die;*/

        try {
            $account = $this->application->getAccount($userIntegration->accessToken, $userIntegration->accessTokenSecret);
            $listURL = "/accounts/{$account->id}/lists/{$details->integration->list_id}";
            $list = $account->loadFromUrl($listURL);

            // create a subscriber
            $params = array(
                'email' => $data['email'],
                //'ip_address' => '127.0.0.1',
                //'ad_tracking' => 'client_lib_example',
                //'misc_notes' => 'my cool app',
                'name' => (!empty($data['name'])) ? $data['name'] : '',
                /*'custom_fields' => array(
                    'Car' => 'Ferrari 599 GTB Fiorano',
                    'Color' => 'Red',
                ),*/
                '//tags' => array('cool_app', 'client_lib', 'other_tag'),
            );

            $subscribers = $list->subscribers;
            $new_subscriber = $subscribers->create($params);

        } catch (\AWeberAPIException $exp) {
            //print_r($exp->getMessage());
            return $exp->message;
        }
    }
}