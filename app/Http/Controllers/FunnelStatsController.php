<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Funnel;
use App\Models\FunnelStep;
use App\Models\FunnelType;

class FunnelStatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($funnel_id) {

        $funnel = Funnel::find($funnel_id);
        $steps = FunnelStep::where('funnel_id', $funnel->id)->get();
        $funnelTypes = FunnelType::orderBy('name')->get();
        $currentStats = array('test');

        return view("funnels.stats.list", ['funnel' => $funnel, 'steps' => $steps, 'funnelTypes' => $funnelTypes, 'currentStats' => $currentStats]);
    }
}
