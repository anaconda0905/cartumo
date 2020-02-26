<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
        //$this->middleware('guest:admin');
    }

    public function index() {        
        return redirect()->route('admin.login');
    }

    public function showLoginForm() {
        return view('auth.admin-login');
    }


    public function login(Request $request) {

        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6'
        ]);



        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if ( Auth::guard('admin')->attempt($credentials, $request->remember)) {

            return redirect()->intended(route('admin.dashboard'));
            die;
        }
        return redirect()->back()->withInput($request->only('email', 'password'));
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
