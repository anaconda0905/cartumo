<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;

use App\Models\User;
use App\Models\Funnel;
use App\Models\FunnelStep;
use App\Models\Page;
use App\Models\PageTemplate;
use App\Models\Product;

use Illuminate\Http\Request;

class TestController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Public Test Controller
    |--------------------------------------------------------------------------
    |
    | This controller tests some code
    |
    */

    public function index(Request $request)
    {
        echo "OK";
        $funnelStep = FunnelStep::find(1);
        echo "<pre>";
        print_r($funnelStep->product);
        echo "</pre>";
    }
}

