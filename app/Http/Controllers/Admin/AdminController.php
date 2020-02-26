<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Funnel;
use App\Models\User;
use App\Models\Developer;
use App\Models\Order;

use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_funnels = Funnel::count();
        $total_users = User::count();
        $total_developers = Developer::count();
        $total_sales = Order::count();

		return view('admin.dashboard', compact('total_funnels', 'total_users', 'total_developers', 'total_sales'));
    }
}
