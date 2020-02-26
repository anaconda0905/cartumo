<?php

namespace App\Http\Controllers\Developers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeveloperLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:developer', ['except' => 'logout']);
        //$this->middleware('guest:admin');
    }

    public function index() {        
        return redirect()->route('developer.login');
    }

    public function showLoginForm() {
        return view('developer.developer-login');
    }


    public function login(Request $request) {

        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6'
        ]);

        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
            'status'    => true
        );

        if ( Auth::guard('developer')->attempt($credentials, $request->remember)) {
            return redirect()->intended(route('developer.dashboard'));
            die;
        }

        return redirect()->back()->withInput($request->only('email', 'password'));
    }

    public function logout() {
        Auth::guard('developer')->logout();
        return redirect(route('developer.login'));
    }
}
