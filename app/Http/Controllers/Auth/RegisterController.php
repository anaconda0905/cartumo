<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;
use App\Models\Profile;
use App\Models\AffiliateProfile;
use App\Mail\RegisterNotification;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'guest' );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator( array $data ) {
        return Validator::make( $data, [
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users',
            'password'         => 'required|string|min:6|confirmed',
            'secret_code_text' => [ Rule::in( [ 'cartumoofthemonth','longlivecartumo','' ] ) ]
            //'secret_code_text' => [Rule::in(['eliteseller,proseller,""'])]
            //'secret_code_text' => ['required', Rule::in(['eliteseller,proseller,default'])]
            //'secret' => 'required|same:eliteseller',
        ] );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\User
     */
    protected function create( array $data ) {

        if ( empty( $data['register_special_code'] ) ) {
            $user = User::create( [
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt( $data['password'] ),
                'secret'   => ( ( $data['secret_code_text'] == env( 'REGISTER_CODE_MONTHLY' ) ) || ( $data['secret_code_text'] == env( 'REGISTER_CODE_YEARLY' ) ) ) ? $data['secret_code_text'] : null,
            ] );
        } else {
            $user = User::create( [
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt( $data['password'] ),
                'secret'   => env( 'REGISTER_CODE_LIFETIME_PROMO' ),
            ] );
        }

        //check if there is secret code
        if ( empty( $data['secret_code_text'] ) ) {

            if ( ! empty( $data['hid_plan_type'] ) ) {
                if ( !empty($data['affiliate_id']) ) {
                    $this->redirectTo = '/subscription?plan=' . $data['hid_plan_type'] . '&affiliate_id=' . $data['affiliate_id'];
                } else {
                    $this->redirectTo = '/subscription?plan=' . $data['hid_plan_type'];
                }
            }
        } else {

            if ( ! empty( $data['register_special_code'] ) ) {
                $this->redirectTo = '/dashboard';
            } elseif ( ($data['secret_code_text'] == env('REGISTER_CODE_MONTHLY')) || ($data['secret_code_text'] == env('REGISTER_CODE_YEARLY')) ) {
                $this->redirectTo = '/dashboard';
            }
        }

        /* ********************* Profile ************************** */
        $profile          = new Profile;
        $profile->user_id = $user->id;
        $profile->save();


        /* ********************* affiliate ************************** */
        $affiliateProfile               = new AffiliateProfile;
        $affiliateProfile->user_id      = $user->id;
        $affiliateProfile->affiliate_id = time();
        $affiliateProfile->save();


        /* *********************** Send email notification ********************** */
        $content         = [
            'title'  => 'Cartumo Registration',
            'name'   => $data['name'],
            'email'  => $data['email'],
            'button' => 'Click Here'
        ];
        $receiverAddress = env( 'PRIMARY_EMAIL_ADDRESS' );
        // Mail::to( $data['email'] )->send( new RegisterNotification( $content ) );


        /* *********************** Mailchimp subscription ********************** */
        // MailChimp API credentials
        $apiKey = env( 'MAILCHIMP_API_KEY' );
        $listID = env( 'MAILCHIMP_LIST_ID' );

        // MailChimp API URL
        $memberID   = md5( strtolower( $data['email'] ) );
        $dataCenter = substr( $apiKey, strpos( $apiKey, '-' ) + 1 );
        $url        = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
        $names      = explode( ' ', $data['name'] );

        // member information
        $json = json_encode( [
            'email_address' => $data['email'],
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME' => $names[0],
                'LNAME' => ( ! empty( $names[1] ) ) ? $names[1] : ''
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


        return $user;
    }
}
