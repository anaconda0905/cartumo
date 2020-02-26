<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\Mail\SiteContact;
use DB;
use Auth;
use Mail;
use Session;

class HomeController extends Controller {
    /**
     *
     *
     * @return Response
     */
    public function index(Request $request) {
        if ( Auth::check() ) {
            return redirect()->route( 'funnels.index' );
            die;
        }

        $ip_address = $this->getUserIP();
        //$ip_address = "0.0.0.0";
        //die($ip_address);

        if ( !empty($request->input('affiliate_id')) ) {
            $affiliate_id = $request->input('affiliate_id');
        } else {
            $affiliate_id = '';
        }

        return view( 'index', array( 'ip_address' => $ip_address, 'affiliate_id' => $affiliate_id ) );
    }


    public function siteSubscription( Request $request ) {

        //env('MAX_IMAGE_UPLOAD_LIMIT')
        //Mailchimp subscription
        // MailChimp API credentials
        $apiKey = env( 'MAILCHIMP_API_KEY' );
        $listID = env( 'MAILCHIMP_LIST_ID' );

        // MailChimp API URL
        $memberID   = md5( strtolower( $request->input( 'subscribe_email' ) ) );
        $dataCenter = substr( $apiKey, strpos( $apiKey, '-' ) + 1 );
        $url        = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
        //$names = explode(' ', $data['name']);

        // member information
        $json = json_encode( [
            'email_address' => $request->input( 'subscribe_email' ),
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME' => 'User',
                'LNAME' => ''
            ]
        ] );

        // send a HTTP POST request with curl
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_USERPWD, 'user:' . $apiKey );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ] );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );
        $result   = curl_exec( $ch );
        $httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );

        //echo $result;
        die(
        json_encode(
            array(
                'status'  => 'success',
                'message' => 'Thank you for subscribing'
            )
        )
        );
    }


    private function getUserIP() {
        if ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $_SERVER ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            if ( strpos( $_SERVER['HTTP_X_FORWARDED_FOR'], ',' ) > 0 ) {
                $addr = explode( ",", $_SERVER['HTTP_X_FORWARDED_FOR'] );

                return trim( $addr[0] );
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }


    public function siteContactUs( Request $request ) {

        $content = [
            'title'  => 'Cartumo Cntact',
            'name'   => $request->input( 'name' ),
            'email'  => $request->input( 'email' ),
            'phone'  => $request->input( 'phone' ),
            'body'   => $request->input( 'message' ),
            'button' => 'Click Here'
        ];

        //print_r($_POST); die;

        $receiverAddress = env( 'PRIMARY_EMAIL_ADDRESS' );

        Mail::to( $receiverAddress )->send( new SiteContact( $content ) );
    }



    public function getPlans(Request $request) {

        //return view('plans');
        $ip_address = $this->getUserIP();
        //$ip_address = "0.0.0.0";
        //die($ip_address);

        if ( !empty($request->input('affiliate_id')) ) {
            $affiliate_id = $request->input('affiliate_id');

            Session::put('affiliate_id', $affiliate_id);
            Session::save();
        } else {
            $affiliate_id = '';
        }

        return view( 'plans', array( 'ip_address' => $ip_address, 'affiliate_id' => $affiliate_id ) );
    }

    public function avatarUpload(Request $request){
        
        $request->validate([
            'image' => 'required|image',
        ]);
        // open an image file
        $img = Image::make($request->file('image'));

        // now you are able to resize the instance
        $img->resize(100, 100);

        $imgName = time().rand(0000000000,9999999999).$_FILES['image']['name'];
        // and insert a watermark for example
        // $img->insert('public/watermark.png');

        // finally we save the image as a new file
        $img->save(public_path('images/users/'.$imgName));

        DB::table('profiles')->where('user_id',\Auth::id())->update(['avatar'=>$imgName]);

        return back()->with('success','Image Uploaded Successfully');
    }
}
