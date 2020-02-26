<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//se Laravel\Cashier\Contracts\Billable as BillableContract;
use Laravel\Cashier\Billable;

use App\Notifications\PasswordReset; // Or the location that you store your notifications (this is default).

use App\Models\UserPaymentGateway;
use App\Models\UserSubscription;
use App\Models\Subscription;

use Auth;


class User extends Authenticatable
{
    // use Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    
    use Notifiable, Billable;
    protected $dates = ['trial_ends_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'secret', 'stripe_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function paymentGateway() {
        return $this->hasMany('App\Models\UserPaymentGateway');
    }

    public static function getUserName($user_id) {
        
        return User::find($user_id);
    }

    public function getPaymentGateways() {

        $userPaymentGateway = UserPaymentGateway::where('user_id', Auth::user()->id)->get();

        return $userPaymentGateway;
    }


    public function getPaymentGateway($gateway_type) {

        $userPaymentGateways = UserPaymentGateway::where('user_id', Auth::user()->id)->get();

        foreach ( $userPaymentGateways as $paymentGateway ) {
            if ( $paymentGateway->type == $gateway_type ) {
                return $paymentGateway;
            }
        }

        return FALSE;
    }


    public function shop() {
        return $this->hasOne("App\Models\UserShop");
    }


    public function userSubscription() {
        return $this->hasOne('App\Models\UserSubscription');
    }


    public function getPlan($user_id) {
    	//echo $user_id;
        $subscription = Subscription::where('user_id', $user_id)->first();
        //print_r($subscription);
	    return $subscription;
    }

    public function upgrades() {
        return $this->hasMany('App\Models\UserUpgrade');
    }



    //////////////////////////////////////////////////
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

}
