<?php

namespace App\Http\Controllers\Developers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class DeveloperController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:developer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('developer.dashboard');
    }
}
