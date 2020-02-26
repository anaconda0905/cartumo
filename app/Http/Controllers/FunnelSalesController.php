<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Funnel;
use App\Models\FunnelStep;
use App\Models\FunnelType;

use Auth;

class FunnelSalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($funnel_id) {

        $funnel = Funnel::find($funnel_id);
        $steps = FunnelStep::where('funnel_id', $funnel->id)->get();
        $funnelTypes = FunnelType::orderBy('name')->get();
        $orders = Order::select('orders.*')
                            ->join('pages', 'pages.id', 'orders.page_id')
                            ->where('pages.funnel_id', $funnel->id)
                            ->orderBy("orders.id", "DESC")
                            ->orderBy('orders.page_id')
                            ->paginate(20);
        //$orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(15);

        //echo '<pre>'; print_r($orders); die;

        return view("funnels.sales.list", ['funnel' => $funnel, 'steps' => $steps, 'funnelTypes' => $funnelTypes, 'orders' => $orders]);
    }
}
