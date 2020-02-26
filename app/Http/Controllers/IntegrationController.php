<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ApiIntegration;
use App\Models\UserIntegration;
use App\Models\Order;
use App\Models\Funnel;
use App\Models\Profile;
use App\Models\UserSubscription;

use App\Library\CAweber;

use Auth;
use Session;

class IntegrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $data = array();
        $apiIntegration = new ApiIntegration();

        $data['profile'] = Profile::where('user_id', Auth::user()->id)->first();
        $data['integrations'] = $apiIntegration->getIntegrations();
        $data['availableIntegrations'] = $apiIntegration->getAvailableIntegrations();
        $data['userIntegrations'] = UserIntegration::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        //print_r($data['integrations']); die;


        if ( empty(Auth::user()->secret) ) {
            
            $data['subscription'] = UserSubscription::where('user_id', Auth::user()->id)->first();
            
        } else {
            $data['subscription'] = array();
        }

        $sales = Order::where('user_id', Auth::user()->id)->get(); 
        $total_sales = 0.0;

        foreach ( $sales as $sale ) {
            $total_sales += $sale->amount;
        }
        $data['total_sales'] = number_format($total_sales, 2);

        $data['total_funnels'] = Funnel::where('user_id', Auth::user()->id)->get()->count();




        return view("settings.integration.list")->withData($data);
    }


    public function getIntegrationDetails(Request $request) {
        $data = array();
        $apiIntegration = new ApiIntegration();

        $integrations = explode(',', $request->input('integration'));

        $data['integration'] = $apiIntegration->getIntegrations($integrations[1], $integrations[0]);

        //print_r($integrations); die;

        //check list item to get access url

        //echo "====" .  env('MAX_IMAGE_UPLOAD_LIMIT'); die;

        if ( $integrations[0] == 'aweber' ) {
            $aweber = new CAweber();
            $data['auth_url'] = $aweber->connectToAWeberAccount($request);
        }

        Session::put('service', $request->input('integration'));
        Session::save();

        echo view("settings.integration.views." . explode(',', $request->input('integration'))[0])->withData($data); die;
    }

    public function store(Request $request) {

        $userIntegration = UserIntegration::where('user_id', Auth::user()->id)->where('service_type', $request->input('integration'))->first();

        if ( !empty($userIntegration) ) {
            $userIntegration = $userIntegration::find($userIntegration->id);
        } else {
            $userIntegration = new UserIntegration();
        }

        if ( strpos($request->input('choose_service'), ',') !== FALSE )
            $integration_types = explode(',', $request->input('choose_service'));

        $userIntegration->user_id = Auth::user()->id;
        $userIntegration->name = $request->input('integration_title');

        if ( !empty($integration_types) ) {
            $userIntegration->service_type = $integration_types[0];            
            $userIntegration->type = $integration_types[1];
        }

        $userIntegration->details = json_encode($request->input('details'));
        $userIntegration->save();

        return redirect()->route("integration.index");
    }


    public function updateIntegrationDetails(Request $request) {

        $data = array();
        $apiIntegration = new ApiIntegration();

        //$data['availableIntegrations'] = $apiIntegration->getAvailableIntegrations();
        $data['userIntegration'] = UserIntegration::find($request->input('id'));
        $data['info'] = json_decode($data['userIntegration']->details);

        //echo $userIntegration; die;

        echo view("settings.integration.views." . $request->input('type') . '_edit')->withData($data); die;
    }




    public function removeIntegrationDetails(Request $request) {

        //print_r($_POST); die;

        $integration = UserIntegration::find($request->input('id'));

        //if ( !empty($integration) ) {

            if ( $integration->delete() ) {
                die(
                    json_encode(
                        array(
                            'status'    => 'success'
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
        //}
    }



    public function fetchList(Request $request, $integration_id=NULL, $output=TRUE) {

        if ( $integration_id == NULL )
            $userIntegration = UserIntegration::find($request->input('id'));
        else
            $userIntegration = UserIntegration::find($integration_id);

        //echo '<pre>'; print_r($userIntegration); die;

        if ( $request->input('type') == 'mailchimp' ) {

            if ( !$output )
                return app('App\Http\Controllers\IntegrationApiController')->fetchMailChimpLists($userIntegration, $output);
            else
                app('App\Http\Controllers\IntegrationApiController')->fetchMailChimpLists($userIntegration, $output);
        } elseif ( $request->input('type') == 'aweber' ) {

            //echo $userIntegration; die;

            $aweber = new CAweber(); 
            $lists = $aweber->getLists($userIntegration);           

            die(
                json_encode(
                    array(
                        'status'    => 'success',
                        'lists'     => $lists
                    )
                )
            );
        }
    }


    public function processIntegrationData(Request $request, $type) {

        //print_r($_GET);

        if ( $type == 'aweber' ) {
            $aweber = new CAweber();
            if ( !empty($_GET['oauth_token']) )
                redirect($aweber->getAccessTokens($_GET['oauth_token'], $_GET['oauth_verifier']));
        }

        //print_r(Session::all());

        if ( !empty(Session::get('accessToken')) ) {

            //print_r(Session::all()); die;

            //save data to database
            $userIntegration = UserIntegration::where('user_id', Auth::user()->id)->where('service_type', 'shipping')->first();

            if ( !empty($userIntegration) ) {
                $userIntegration = $userIntegration::find($userIntegration->id);
            } else {
                $userIntegration = new UserIntegration();
            }       
                
            $types = explode(',', Session::get('service'));
            //print_r($types); die;
            $userIntegration->user_id = Auth::user()->id;
            $userIntegration->name = ucfirst($types[0]); 
            $userIntegration->service_type = $types[0];            
            $userIntegration->type = $types[1];
            $details = array(
                'accessToken'       => Session::get('accessToken'),
                'accessTokenSecret' => Session::get('accessTokenSecret')
            );
        
            $userIntegration->details = json_encode($details);
            $userIntegration->save();

            $url = Session::get('callbackUrl');

            //clear session data
            Session::forget('accessToken');
            Session::forget('accessTokenSecret');
            Session::forget('service');
            Session::forget('callbackUrl');
            Session::save();

            return redirect()->route('integration.index')->withMessage(ucfirst($types[0]) . " has been integrated successfully.");
        }
    }
}
