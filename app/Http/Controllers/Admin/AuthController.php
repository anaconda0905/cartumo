<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User,App\PasswordResetCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use Hash;


class AuthController extends Controller
{
	public function getLogin()
	{  
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
    	// echo "<pre>"; print_r($request->all()); die;
    	$flag = isset($request->remember) ? true : false;
    	if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password], $flag))
    	{
    		return redirect()->route('admin.dashboard')->with('success', "Login Successful.");
    	}
    	else
    	{
    		return redirect()->back()->with('error', 'Invalid login credentials. Please try again with valid information.');
    	}
    }

    public function logout()
    {
    	// Log the user out
    	Auth::logout();

    	// Redirect to the users page
    	return redirect()->route('admin.login')->with('success', 'You have successfully logged out!');
    }

    public function ajax_validateForgotPassword(Request $request)
    {
    	$inputs = [
			'email' => $request->email, 
    	];

    	$rules = [
    		'email' => 'required|email|max:255',
    	];

    	$validator = Validator::make($inputs, $rules);

    	if($validator->fails())
    	{
    		return "0";
    	}

    	return "1";

    }

    public function postForgotPassword(Request $request)
    {
    	$inputs = [
			'email' => $request->email, 
    	];

    	$rules = [
    		'email' => 'required|email|max:255',
    	];

    	$validator = Validator::make($inputs, $rules);

    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator);
    	}

    	$user = User::where('email', $request->email)->first();

    	if(!$user)
		{
			return redirect()->back()->with('error', 'Email does not exists.');
		}
		// echo "<pre>"; print_r($request->email);die;
		$code = $this->__generateRandomString("abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", 20);

		Mail::send('emails.admin-forgot-password', ["user"=>$user, "code"=>$code] , function($message) use ($user){
            $message->from('promatics.kushalarora04@gmail.com', 'Stellar Winds');
            $message->to($user->email, $user->first_name)->subject('Forgot Password');
        });

        PasswordResetCode::where('user_id', $user->id)->forceDelete();
        $password_reset_code = new PasswordResetCode;
        $password_reset_code->user_id = $user->id;
        $password_reset_code->code = $code;
        $password_reset_code->created_at = date('Y-m-d H:i:s');
        $password_reset_code->updated_at = date('Y-m-d H:i:s');
        $password_reset_code->save();

        return redirect()->back()->with('success', 'We have sent you a link to reset your password. Please check your email.');

    }


    public function getResetPassword(Request $request)
    {
    	if(!$request->email || !$request->code)
		{
			return redirect()->route('admin.dashboard')->with('error', 'An unexpected error occurred.');
		}

		$email = $request->email;
		$code  = $request->code;

    	return view('admin.resetPassword', compact('email', 'code'));
    }

    public function postResetPassword(Request $request)
    {
    	// echo "<pre>"; print_r($request->all()); die;
    	if(!$request->email || !$request->code)
		{
			return redirect()->route('admin.dashboard')->with('error', 'An unexpected error occurred.');
		}

		$user = User::where('email', $request->email)->first();
		if(!$user)
		{
			return redirect()->route('admin.dashboard')->with('error', 'No user exists with email ' . $request->email);
		}

		$inputs = [
			'password' => $request->password,
			'confirm_password' => $request->confirmPassword
		];

		$rules = [
			'password' => 'required|min:6',
			'confirm_password' => 'required|same:password'
		];

		$validator = Validator::make($inputs, $rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}

		$password_reset_code = PasswordResetCode::where('user_id', $user->id)->where('code', $request->code)->first();

		if(!$password_reset_code)
		{
			return redirect()->route('admin.dashboard')->with('error', 'An unexpected error occurred.');
		}
		
		if($password_reset_code->code !== $request->code)
		{
			return redirect()->route('admin.dashboard')->with('error', 'An unexpected error occurred.');
		}

		$user->Password= Hash::make($request->password);

		if($user->save())
		{
			$password_reset_code->delete();
			return redirect()->route('admin.dashboard');
		}
    }

}
