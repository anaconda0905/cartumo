<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PageTemplate;
use App\Models\Page;
use App\Models\BaseUrl;
use App\Models\Widgets;
use App\Models\Product;
use App\Models\FunnelStep;
use App\Models\FunnelType;
use Session;

use Auth;
use App\StepProduct;

class OtherController extends Controller
{
    public function getScreenshoot(Request $request)
    {
        //return "https://api.url2png.com/v6/$URL2PNG_APIKEY/$TOKEN/png/?$query_string";

        $args['force']     = 'false';      # [false,always,timestamp] Default: false
        $args['fullpage']  = 'false';      # [true,false] Default: false
        $args['thumbnail_max_width'] = 'false';      # scaled image width in pixels; Default no-scaling.
        $args['viewport']  = "1280x1024";  # Max 5000x5000; Default 1280x1024


        $URL2PNG_APIKEY = "P9CDC38DCFCDD5A";
        $URL2PNG_SECRET = "S_1D74819348F59";
        $url = route('pages.edit', $request->input('page_id'));

        //echo $url; die;

        # urlencode request target
        $options['url'] = urlencode($url);

        $options += $args;

        # create the query string based on the options
        foreach($options as $key => $value) { $_parts[] = "$key=$value"; }

        # create a token from the ENTIRE query string
        $query_string = implode("&", $_parts);
        $TOKEN = md5($query_string . $URL2PNG_SECRET);

        die("https://api.url2png.com/v6/$URL2PNG_APIKEY/$TOKEN/png/?$query_string");
    }

    /*public function showPage($id) {
        $data = array();

        //echo $id; die;

        if ($id) {
            $page = Page::find($id);
            $data['funnelStep'] = $funnelStep = FunnelStep::find($page->funnel_step_id);
            $data['$funnelType'] = $funneltype = FunnelType::find($funnelStep->type);

            //echo $funneltype->name; die;

            //echo '<pre>'; print_r(Session::all()); die;

            //echo "===" . print_r(Session::has('credit_card_details'));
            //print_r(Session::get('purchaded_products'));
            if (strtolower($funneltype->name) == 'confirmation') {
                //print_r(Session::get('credit_card_details'));

                Session::forget('token_details');
                Session::forget('shipping_details');
                Session::forget('credit_card_details');

                //echo '<pre>'; print_r(Session::all()); die;

                //echo '<pre>';print_r(Session::get('purchaded_products'));echo '</pre>';
            } elseif (strtolower($funneltype->name) == 'order') {

                //print_r(Session::all());

                if (Session::has('product_cart')) {

                    $pdata = Session::get('product_cart');

                    //echo '<pre>'; print_r($pdata); die;

                    $data['product'] = Product::find($pdata['cart']['products'][0]['product_id']);
                }

                //fetch product details from previous page
                $step = $this->getPreviousStep($page->funnel_id, $page->funnel_step_id);
                //echo $step;
                $stepProduct = StepProduct::where('funnel_id', $page->funnel_id)
                    ->where('step_id', $step->id)
                    ->first();

                //echo $stepProduct; die;
                $data['stepProduct'] = $stepProduct;
            }

            //$widgets = Widgets::getWidgetNames();

            //if( $page )
            //{
            $contents = json_decode($page->content);
            $sty = json_decode($page->content);
            //print_r($contents); die;
            return view("builder.page_template_view", ["contents" => $contents, 'data' => $data, 'page' => $page]);
            //}
        }
    }

    private function getPreviousStep($funnel_id, $current_step_id)
    {

        $steps = FunnelStep::where('funnel_id', $funnel_id)->orderBy('order_position')->get();
        $prestep = array();

        foreach ($steps as $step) {

            if ($step->id == $current_step_id)
                break;

            $prestep = $step;
        }

        return $prestep;
    }*/
}
