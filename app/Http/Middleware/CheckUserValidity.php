<?php

namespace App\Http\Middleware;

use Closure;

use App\User;
use App\UserSubscription;


use Auth;
use DateTime;

class CheckUserValidity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo '====' . Auth::user()->secret; die;

        /*if ( empty(Auth::user()->secret) ) {

            if ( Auth::user()->subscription ) {

                //check the validity of the subscription
                //return redirect('/dashboard');

            } else {
                return redirect('/subscription');
            }

            die;
        } else {

            //check the validity of 1 year registration

            //return redirect('/dashboard');
        }*/


        /*if ( empty(Auth::user()->secret) ) {

            $user = User::find(Auth::id());

            if ($user->subscribed('main')) {
                return redirect('/dashboard');
            } else {
                return redirect('/subscription');
            }

            die;
        } else {

            //check the validity of 1 year registration

            //return redirect('/dashboard');
        }*/
        
        //print_r($request->user()->subscribed('main')); die;      
        if ( empty(Auth::user()->secret) ) {  
            if ($request->user() && ! $request->user()->subscribed('main')) {
                // This user is not a paying customer...
                return redirect('subscription');
                die;
            }
        } else {

	        $earlier = new DateTime(date('Y-m-d', strtotime(Auth::user()->created_at)));
	        $later = new DateTime(date('Y-m-d'));
	        $diff = $later->diff($earlier);

        	if ( Auth::user()->secret == env('REGISTER_CODE_YEARLY') ) {
		        if ( intval($diff->y) > 0 ) {
			        return redirect('subscription');
			        die;
		        }
	        } elseif ( Auth::user()->secret == env('REGISTER_CODE_MONTHLY') ) {

		        if ( intval($diff->m) > 0 ) {
			        return redirect('subscription');
			        die;
		        }
	        } elseif ( Auth::user()->secret == env('REGISTER_CODE_LIFETIME_PROMO') ) {

		        if ( intval($diff->d) >= 7 ) {
			        return redirect()->route('user.account.activate');
			        die;
		        }
	        } else {

        		//if user in pending mode
        		if ( Auth::user()->status == 2 ) {
			        return redirect()->route('user.account.success');
			        die;
		        }
	        }
        }

        return $next($request);
    }
}
