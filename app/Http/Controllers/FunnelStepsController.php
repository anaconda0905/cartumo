<?php

namespace App\Http\Controllers;

use App\Product;
use App\StepProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Image;
use App\Models\Funnel;
use App\Models\FunnelType;
use App\Models\FunnelStep;
use App\Models\PageTemplate;
use App\Models\Page;
use App\Models\BaseUrl;
use App\Models\UserIntegration;
use App\Models\FunnelStepAutomation;
use App\Models\ProductEmailIntegration;

use Auth;
use View;

class FunnelStepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($funnel_id)
    {
        $step = FunnelStep::where('funnel_id', $funnel_id)->orderBy('order_position')->first();

        return redirect()->route("steps.show",[$funnel_id, $step->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if($request->step_name && $request->funnel_id)
        //{
            $funnel = Funnel::find($request->funnel_id);
            if(!$funnel)
            {
                return redirect()->back()->with('error', 'Funnel not found.');
            }

            $funnelType = FunnelType::find($request->step_name);
            $stepsCount = FunnelStep::where('funnel_id', $funnel->id)->count();

            $funnelStep = new FunnelStep;
            $funnelStep->funnel_id = $funnel->id;
            $funnelStep->name = $funnelType->name;
            $funnelStep->display_name = $request->input('display_name');
            $funnelStep->slug = strtolower(str_ireplace(' ', '-', $request->input('display_name'))) . time();
            $funnelStep->type = $funnelType->id;
            $funnelStep->order_position = $stepsCount + 1;
            //$funnelStep->created_at = date('Y-m-d h:i:s');
            //$funnelStep->updated_at = date('Y-m-d h:i:s');

            if($funnelStep->save())
            {
                //update the funnel modificaton time
                $funnel = Funnel::find($funnel->id);
                $funnel->updated_at = date('Y-m-d h:i:s');
                $funnel->save();

                //return redirect()->back()->with('success', 'Funnel step created successfully.');
                echo json_encode(
                    array(
                        'status' => '200',
                        'route' => route('steps.show', array($funnel->id, $funnelStep->id), TRUE)
                        //'route' => url('steps.show', array($funnel->id, $funnelStep->id))
                        //'route' => 'steps.show'
                    )
                );
            }
            else
            {
                //return redirect()->back()->with('error', 'Funnel step could not be added due to an unexpected error.');
                echo json_encode(
                    array(
                        'status' => '500',
                        'message' => 'Something is wrong! Please try again later'
                    )
                );
            }
        //}

        //echo "Arrived";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($funnel_id=null, $step_id=null)
    {
        //die ($funnel_id . ', ' . $step_id);

        $funnel = Funnel::find($funnel_id);
        $steps   = FunnelStep::where('funnel_id', $funnel_id)->orderBy('order_position')->get();
        $currentStep = FunnelStep::find($step_id);


        /*if(!$funnel || !$steps || !$currentStep)
        {
            return redirect()->route('funnels.index');
            die;
        }*/

        if ( empty($currentStep) ) {
            return redirect()->route('funnels.edit', $funnel->id);
            die;
        }

        $currentType = FunnelType::find($currentStep->type);

        //echo $step_id; die;

        $page = Page::where('funnel_id', $funnel->id)->where('funnel_step_id', $currentStep->id)->first();
        $funnelTypes = FunnelType::orderBy('name')->get();

        //print_r($page); die;

        if ( empty($page) ) {
            $templates = array();

            //echo $currentStep->templates; die;

            /*if ( !empty($currentStep->templates) ) {
                foreach ( $currentStep->templates as $template ) {
                    if ( ($currentStep->type == $template->type) || ($template->type == 0) ) {
                        $templates[] = $template;
                    }
                }
            }*/

            $templates = $pageTemplates = PageTemplate::where('type', $currentStep->type)
                                                        ->where('status', true)
                                                        ->orderBy('id', 'desc')
                                                        ->get();

            $blankTemplate = PageTemplate::where('status', true)
                                                        ->orderBy('id', 'desc')
                                                        ->where('type', '0')
                                                        ->first();                                                        

            //echo '<pre>'; print_r($templates); die;

            if ( !empty($templates) ) {
                //$url = $this->url2png_v6(route('step.show', $funnel->id, $steps->id));

                foreach ( $templates as $template ) {

                    $image_path = public_path(env('DEVELOPER_IMAGE_UPLOAD_PATH') . $template->image);
                    //$template->image = Image::make($image_path)->resize(300, 200);
                    //echo $image_path; die;
                    //echo Image::make($image_path)->resize(300, 200); die;

                    //echo $image_path; die;
                    //echo $image_path . ', ';
                    //echo is_readable($image_path);

	                //echo $image_path . ' , '; die;

                    if ( !empty($template->image) ) {

	                    if ( is_readable( $image_path ) ) {                            
                            
		                    /*$img        = Image::make( $image_path )->crop( 1280, 1024, 0, 0 );
		                    $image_name = $template->image;
		                    $img->save( public_path( env( 'DEVELOPER_IMAGE_UPLOAD_PATH' ) . $image_name ) );
		                    //echo asset('frontend/images/page_templates/thumbnails/' . $image_name); die;*/

		                    //$template->image = asset('asset/Timthumb.php?src=') . asset( env( 'DEVELOPER_IMAGE_UPLOAD_PATH' ) . $template->image . env('TEMPLATE_IMAGE_SIZE') );
		                    $template->image = asset('asset/Timthumb.php?src=') . asset( env( 'DEVELOPER_IMAGE_UPLOAD_PATH' ) . $template->image . env('TEMPLATE_IMAGE_SIZE') );
	                    } else {

                            // echo $image_path; die;

                            // echo $image_path; die;
		                    //if ( !empty($template->image) ) {
		                    //env(AWS_IMAGE_BUCKET_PATH); die;
                            // $template->image = env( 'AWS_IMAGE_BUCKET_PATH' ) . $template->image;
                            
                            $template->image = asset('asset/Timthumb.php?src=') . asset( 'images/noimg.jpg' . env('TEMPLATE_IMAGE_SIZE') );

	                    }
                    } else {

                        $template->image = asset('asset/Timthumb.php?src=') . asset( 'images/noimg.jpg' . env('TEMPLATE_IMAGE_SIZE') );
                    }

                    //echo $template->image . ', ';
                    //}
                }

                return view('funnels.steps.show', ['funnel' => $funnel, 'steps' => $steps, 'blankTemplate' => $blankTemplate, 'templates' => $templates, 'currentStep' => $currentStep, 'funnelTypes' => $funnelTypes, '', 'currentType' => $currentType]);
                die;
            }
            else {
                return view('funnels.steps.show', ['funnel' => $funnel, 'steps' => $steps, 'blankTemplate' => $blankTemplate, 'templates' => $templates, 'currentStep' => $currentStep, 'funnelTypes' => $funnelTypes, 'page' => $page, 'currentType' => $currentType]);
                die;
            }
        }

        $content = json_decode($page->content);
        return view('funnels.steps.show', ['funnel' => $funnel, 'steps' => $steps, 'page' => $page, 'currentStep' => $currentStep, 'content' => $content, 'funnelTypes' => $funnelTypes, 'templates' => array(), 'currentType' => $currentType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $funnel_id, $step_id)
    {
        //die("Hello");

        //print_r($_POST); die;

        //if($request->step_name && $request->funnel_id)
        //{
        $funnel = Funnel::find($funnel_id);
        if(!$funnel)
        {
            return redirect()->back()->with('error', 'Funnel not found.');
        }

        $oldFunnelStep = FunnelStep::find($step_id);
        $funnelType = FunnelType::find($oldFunnelStep->type);
        //$stepsCount = FunnelStep::where('funnel_id', $funnel->id)->count();

        $funnelStep = FunnelStep::find($step_id);
        $funnelStep->funnel_id = $funnel->id;
        $funnelStep->name = $funnelType->name;
        $funnelStep->display_name = $request->input('display_name');
        $funnelStep->slug = $oldFunnelStep->slug;
        $funnelStep->type = $funnelType->id;
        $funnelStep->updated_at = date('Y-m-d h:i:s');

        $funnelStep->save();

        //update the funnel modificaton time
        $funnel->updated_at = date('Y-m-d h:i:s');
        $funnel->save();

        return redirect()->route('steps.show', array($funnel->id, $step_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($funnel_id=null, $step_id=null)
    {
        $funnelStep = FunnelStep::find($step_id);

        if ( !empty($funnelStep) ) {
            $funnel = Funnel::find($funnelStep->funnel_id);
            $step = FunnelStep::where('funnel_id', $funnel->id)->first();
            $funnelStep->delete();

            //update the funnel modificaton time
            $funnel->updated_at = date('Y-m-d h:i:s');
            $funnel->save();

            echo json_encode(
                array(
                    'status'    => 200,
                    'route'     => route('steps.show', array($funnel->id, $step->id))
                )
            );
        } else {
            echo json_encode(
                array(
                    'status'    => 500,
                    'message'     => 'Something wrong! please try again later'
                )
            );
        }

        die;
    }

    /**
     * change the type of specified resource in storage.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function changeType(Request $request)
    {
        $response = [
            'success' => null
        ];
        if($request->ajax())
        {
            $supportedTypes = ['squeeze', 'sales', 'payment', 'upsell', 'downsell', 'confirmation'];
            $funnel = Funnel::find($request->funnel_id);
            $step   = FunnelStep::where('id', $request->step_id)->where('funnel_id', $request->funnel_id)->first();
            if(!$funnel || !$step || !in_array($request->step_type, $supportedTypes))
            {
                return json_encode($response);
            }

            $step->name = ucfirst($request->step_type);
            $step->type = $request->step_type;
            if($step->save())
            {
                $response['success'] = 1;
            }

            return json_encode($response);
        }
    }

    public function selectTemplate(Request $request)
    {
        $response = [
            'success' => null
        ];

        if($request->ajax())
        {
            if($request->funnel_id && $request->step_id && $request->template_id)
            {
                $funnel     = Funnel::find($request->funnel_id);
                $funnelStep = FunnelStep::where('id', $request->step_id)->where('funnel_id', $request->funnel_id)->first();
                $template   = PageTemplate::find($request->template_id);

                if($funnel && $funnelStep && $template)
                {
                    $page = Page::where('funnel_step_id', $funnelStep->id)->first();
                    if($page)
                    {
                        $response['success'] = 1;
                    }
                    else
                    {
                        $page = new Page;
                        $page->funnel_step_id = $funnelStep->id;
                        $content = $template->content;
                        /*if($funnelStep->product)
                        {
                            $content = $funnelStep->setContent($template->content);
                        }*/
                        $page->content = $content;
                        if($page->save())
                        {
                            $src_path = base_path() . "/" . BaseUrl::getPageTemplateThumbnailUrl() . "/" . $template->image;
                            if(file_exists($src_path))
                            {
                                $dest_path = base_path() . "/" . BaseUrl::getPageThumbnailUrl() . "/" . $page->id . ".png";
                                copy($src_path, $dest_path);
                            }

                            $response['success'] = 1;

                            //update the funnel modificaton time
                            $funnel->updated_at = date('Y-m-d h:i:s');
                            $funnel->save();
                        }
                    }
                }
            }
        }

        return json_encode($response);
    }


    public function cloneStep($funnel_id, $step_id) {

        $funnel = Funnel::find($funnel_id);
        $funnelStep = FunnelStep::find($step_id);

        //create new step
        $newStep = new FunnelStep();
        $newStep->funnel_id = $funnelStep->funnel_id;
        $newStep->name = $funnelStep->name;
        $newStep->display_name = $funnelStep->display_name;
        $newStep->slug = strtolower(str_ireplace(' ', '-', $funnelStep->display_name)) . time();
        $newStep->type = $funnelStep->type;
        $newStep->details = $funnelStep->details;
        $newStep->order_position = $funnelStep->order_position;
        $newStep->save();

        //update the funnel modificaton time
        $funnel->updated_at = date('Y-m-d h:i:s');
        $funnel->save();

        //create page for the step
        /*$page = new Page();
        $page->funnel_id = $funnelStep->funnel_id;
        $page->funnel_step_id = $step_id;
        $page->content = $funnelStep->page->content;
        $page->funnel_id = $funnelStep->page->image;
        $page->save();*/

        die(json_encode(
            array(
                'status'    => 'success',
                'message'   => 'Step cloned successfully',
                'url'       => route('steps.show', array($funnel_id, $newStep->id))
            )
        ));
    }


    public function removeTemplate($funnel_id, $step_id) {

        $page = Page::where('funnel_id', $funnel_id)->where('funnel_step_id', $step_id)->first();

        if ( !empty($page) ) {

            $page = Page::find($page->id);
            $page->delete();

            $funnel = Funnel::find($funnel_id);
            $funnel->updated_at = date('Y-m-d h:i:s');
            $funnel->save();

            die(json_encode(
                array(
                    'status'    => 'success',
                    'message'   => 'Template has been removed',
                    'url'       => route('steps.show', [$funnel_id, $step_id])
                )
            ));
        } else {
            die(json_encode(
                array(
                    'status'    => 'error',
                    'message'   => 'Oops! something wrong'
                )
            ));
        }
    }



    private function url2png_v6($url, $args) {



    }




    //Automation

    public function getFunnelAutomation($funnel_id, $step_id) {

        $funnel = Funnel::find($funnel_id);
        if (!$funnel) {
            return redirect()->route('funnels.index')->with('error', 'Funnel not found.');
        }

        $funnelStepAutomations = FunnelStepAutomation::where('funnel_id', $funnel_id)->where('step_id', $step_id)->get();

        $steps = FunnelStep::where('funnel_id', $funnel->id)->get();
        $funnelStep = FunnelStep::where('funnel_id', $funnel->id)->first();
        $funnelTypes = FunnelType::orderBy('name')->get();
        $currentStep = FunnelStep::find($step_id);
        $currentType = FunnelType::find($currentStep->type);

        return view('funnels.automation', compact('funnel', 'funnelStep', 'funnelTypes', 'steps', 'currentStep', 'funnelStepAutomations', 'currentType'));
    }


    public function saveFunnelAutomation(Request $request, $funnel_id, $step_id) {

        $funnelStepAutomation = new FunnelStepAutomation();
        $funnelStepAutomation->funnel_id = $funnel_id;
        $funnelStepAutomation->step_id = $step_id;
        $funnelStepAutomation->type = 'email';
        $funnelStepAutomation->from_name = $request->input('from_name');
        $funnelStepAutomation->subject = $request->input('subject');
        $funnelStepAutomation->automation_condition = $request->input('condition');
        $funnelStepAutomation->details = json_encode($request->input('html_body'));
        $funnelStepAutomation->save();

        return redirect()->route('funnel.automation', [$funnel_id, $step_id]);
    }


    public function removeFunnelAutomation(Request $request, $funnel_id, $step_id) {

        $funnelStepAutomation = FunnelStepAutomation::find($request->input("id"));

        $funnelStepAutomation->delete();

        die(json_encode(
            array(
                'status'    => 'success',
                'message'   => 'Automation has been removed',
                'url'       => route('funnel.automation', [$funnel_id, $step_id])
            )
        ));
    }


    public function updateEmailSettings(Request $request) {

        $step = FunnelStep::find($request->input('step_id'));
        //$stepProduct = StepProduct::where('step_id', $step->id)->first();

        //echo '<pre>'; print_r($_POST); die;

        //echo htmlentities($request->input('html_body')); die;

        $email_settings['fulfillment'] = array(
            'subject'   => $request->input('email_subject'),
            'body'      => $request->input('html')
        );
        $email_settings['integration'] = array(
            'integration_method'   => $request->input('integration_method'),
            'list_id'      => $request->input('list_lead')
        );

        //echo '<pre>'; print_r($email_settings); die;

        $productEmailIntegration = ProductEmailIntegration::where('step_id', $step->id)->first();

        if ( empty($productEmailIntegration) || $productEmailIntegration->count() ==0 ) {
            $productEmailIntegration = new ProductEmailIntegration();
        } else {
            $productEmailIntegration = ProductEmailIntegration::find($productEmailIntegration->id);
        }

        $productEmailIntegration->step_id = $step->id;
        $productEmailIntegration->details = json_encode($email_settings);

        if ( $productEmailIntegration->save() ) {
            die(json_encode(
                array(
                    'status'    => 'success',
                    'message'   => 'Email settings has been saved',
                    'url'       => route('product.index', [$step->funnel_id, $step->id])
                )
            ));
        } else {
            die(json_encode(
                array(
                    'status'    => 'error',
                    'message'   => 'ERROR! please try after sometime'
                )
            ));
        }
    }



    public function removeEmailSettings($step_id) {

        $step = FunnelStep::find($step_id);

        $step->details = NULL;


        if ( $step->save() ) {

            die(json_encode(
                array(
                    'status'    => 'success',
                    'message'   => 'Email settings has been removed'
                )
            ));

        } else {

            die(json_encode(
                array(
                    'status'    => 'error',
                    'message'   => 'ERROR! please try after sometime'
                )
            ));
        }
    }



    //////////////////////////////////////
    public function replaceEditorContent(Request $request) {

    	//print_r($request->all()); die;

        $step = FunnelStep::find($request->input('step_id'));
        $results = $this->getProduct($step->funnel_id, $step);
        //$id = $element_id . time();

        //print_r($results); die;

        if ( !empty($results) ) {

            $data['product'] = $results[0];
            $data['stepProduct'] = $results[1];

            //get bump product
            $bump_product = $this->getBumpProduct($data['stepProduct']);
            //print_r($bump_product); die;

	        if ( $data['stepProduct']->product_type == "manual" ) {
		        if ( $bump_product != false ) {
			        $data['bumpProduct'] = Product::find( $bump_product );
		        } else {
			        $data['bumpProduct'] = array();
		        }
	        } else {
		        if ( $bump_product != false ) {
			        $data['bumpProduct'] = $bump_product;
		        } else {
			        $data['bumpProduct'] = array();
		        }
	        }
        } else {
            $data = array();
        }

	    //print_r($data); die;

        if ( (!empty($request->input('type'))) ) {
            if ( $request->input('type') == 'cart' ) {

                $html['cart'] = View::make('editor.widgets.backend.elements_product_cart_replace', array('id' => 'section_product_cart' . time(), 'data' => $data))->render();
                $html['bump'] = View::make('editor.widgets.backend.section_order_bump_replace', array('id' => 'section_order_bump' . time(), 'data' => $data))->render();
                $html['shipping_method'] = View::make('editor.widgets.backend.elements_shipping_method_replace', array('id' => 'section_order_bump' . time(), 'data' => $data))->render();
            } else {
                $html['image'] = View::make('editor.widgets.backend.section_product_main_image_replace', array('id' => 'section_product_main_image' . time(), 'data' => $data))->render();

                $html['title'] = View::make('editor.widgets.backend.section_product_title_replace', array('id' => 'section_product_title' . time(), 'data' => $data))->render();

                $html['description'] = View::make('editor.widgets.backend.section_product_description_replace', array('id' => 'section_product_description' . time(), 'data' => $data))->render();

                $html['variants'] = View::make('editor.widgets.backend.section_product_varients_replace', array('id' => 'section_product_varients' . time(), 'data' => $data))->render();

                $html['price'] = View::make('editor.widgets.backend.section_product_price_replace', array('id' => 'section_product_price', 'data' => $data))->render();

                $html['availability'] = View::make('editor.widgets.backend.section_product_availability_replace', array('id' => 'section_product_availability' . time(), 'data' => $data))->render();

                //$html['bump'] = View::make('editor.widgets.backend.section_order_bump.blade', array('id' => 'section_order_bump' . time(), 'data' => $data))->render();
            }
        } else {
	        $html['image'] = View::make('editor.widgets.backend.section_product_main_image_replace', array('id' => 'section_product_main_image' . time(), 'data' => $data))->render();

	        $html['title'] = View::make('editor.widgets.backend.section_product_title_replace', array('id' => 'section_product_title' . time(), 'data' => $data))->render();

	        $html['description'] = View::make('editor.widgets.backend.section_product_description_replace', array('id' => 'section_product_description' . time(), 'data' => $data))->render();

	        $html['variants'] = View::make('editor.widgets.backend.section_product_varients_replace', array('id' => 'section_product_varients' . time(), 'data' => $data))->render();

	        $html['price'] = View::make('editor.widgets.backend.section_product_price_replace', array('id' => 'section_product_price', 'data' => $data))->render();

	        $html['availability'] = View::make('editor.widgets.backend.section_product_availability_replace', array('id' => 'section_product_availability' . time(), 'data' => $data))->render();

                //$html['bump'] = View::make('editor.widgets.backend.section_order_bump.blade', array('id' => 'section_order_bump' . time(), 'data' => $data))->render();
        }


        if ( !empty($results[0]) )
            $html['product_id'] = $results[0];

        //$html['image'] = View::make('editor.widgets.backend.section_product_price', array('id' => $id, 'data' => $data))->render();

        die(json_encode($html));
    }



    private function getBumpProduct($stepProduct) {

        $stepProducts = StepProduct::where('step_id', $stepProduct->step_id)->get();

        if ( $stepProducts->count() > 0 ) {

            foreach ( $stepProducts as $stepProduct ) {

                $details = json_decode($stepProduct->details);

                if ( $details->bump == true )
                  return $details->product_id;
            }
        }

        return false;
    }



    /*public function replaceEditorContent(Request $request) {

        $step = FunnelStep::find($request->input('step_id'));
        $stepProduct = StepProduct::where('step_id', $step->id)->first();
        $data = array();

        if ( $stepProduct->product_type == 'manual' ) {

            $product = Product::find(json_decode($stepProduct->details)->product_id);

            $data['product']['images'] = json_decode($product->images);
            $data['product']['title'] = $product->name;
            $data['product']['description'] = $product->description;
            $data['product']['price'] = $product->price;
            $data['product']['variants'] = $product->options;

        } else {

            //fetch product details
            $userIntegration = UserIntegration::where('user_id', Auth::user()->id)->where('service_type', 'shopify')->first();
            $json = json_decode($userIntegration->details);

            $API_KEY = $json->api_key;
            $API_PASSWORD = $json->password;
            $SECRET = $json->shared_secret;
            $store_name = $json->name;

            //https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

            //die($url);
            $url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . ".json";

            $data = json_decode(file_get_contents($url));

        }

        die(json_encode($data));
    }*/









    /////////////////////// COPIED FROM PAGES CONTROLLER ////////////////////////////////////
    private function getProduct($funnel_id, $currentFunnelStep = NULL)
    {

        $funnelSteps = FunnelStep::where('funnel_id', $funnel_id)->orderBy('order_position', 'asc')->get();
        $currentFunnelType = FunnelType::find($currentFunnelStep->type);

        //echo $funnelSteps; die;

        //echo

        if ((strtolower($currentFunnelType->name) != 'order') && (strtolower($currentFunnelType->name) != 'confirmation')) {
            $stepProduct = StepProduct::where('step_id', $currentFunnelStep->id)->first();

            if ( !empty($stepProduct) ) {
                if ( $stepProduct->product_type == 'shopify' ) {
                    $product = $this->getShopifyProduct(json_decode($stepProduct->details)->product_id);
                } else {
                    $product = Product::find(json_decode($stepProduct->details)->product_id);
                }

                return [$product, $stepProduct];
            }
        } else {
            foreach ($funnelSteps as $step) {

                $funnelType = FunnelType::find($step->type);

                if (strtolower($funnelType->name) == 'product' || strtolower($funnelType->name) == 'sales') {
                    //echo $step; die;
                    //return $step;

                    //echo $step->id; die;
                    $stepProduct = StepProduct::where('step_id', $step->id)->first();

                    if ( !empty($stepProduct) ) {

                        //echo json_decode($stepProduct->id)->product_id; die;

                        if ( $stepProduct->product_type == 'shopify' ) {
                            $product = $this->getShopifyProduct(json_decode($stepProduct->details)->product_id);
                        } else {
                            $product = Product::find(json_decode($stepProduct->details)->product_id);
                        }

                        //$product = Product::find(json_decode($stepProduct->details)->product_id);

                        return [$product, $stepProduct];
                    }
                }
            }
        }

        return array();
    }



    public function getShopifyProduct($product_id) {

        $userIntegration = UserIntegration::where('user_id', Auth::user()->id)->where('service_type', 'shopify')->first();
        $json = json_decode($userIntegration->details);

        $API_KEY = $json->api_key;
        $API_PASSWORD = $json->password;
        $SECRET = $json->shared_secret;
        $store_name = $json->name;

        $url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . ".json";
        return json_decode(file_get_contents($url));
    }



    public function showStepIntegrationPage($funnel_id, $step_id) {

        $funnel = Funnel::find($funnel_id);
        $steps   = FunnelStep::where('funnel_id', $funnel_id)->orderBy('order_position')->get();
        $currentStep = FunnelStep::find($step_id);

        if ( empty($currentStep) ) {
            return redirect()->route('funnels.edit', $funnel->id);
            die;
        }

        $currentType = FunnelType::find($currentStep->type);
        $page = Page::where('funnel_id', $funnel->id)->where('funnel_step_id', $currentStep->id)->first();
        $funnelTypes = FunnelType::orderBy('name')->get();
        $integrations = UserIntegration::where('user_id', Auth::id())->where('service_type', '!=', 'shopify')->orderBy('name')->get();

        $stepDetails = json_decode($currentStep->details);

        return view('funnels.steps.integration.show', compact('funnel', 'funnelTypes', 'steps', 'currentStep', 'currentType', 'stepDetails', 'integrations'));
    }


    public function saveStepIntegration(Request $request, $funnel_id, $step_id) {

        $funnelStep = FunnelStep::find($step_id);
        $stepDetails = json_decode($funnelStep->details, TRUE);

        if ( !empty($stepDetails['integration']) ) {
            $stepDetails['integration']['integration_id'] = $request->input('integration_method');
            $stepDetails['integration']['list_id'] = $request->input('integration_list_id');
            $stepDetails['integration']['type'] = UserIntegration::find($request->input('integration_method'))->service_type;
            $stepDetails['integration']['name'] = UserIntegration::find($request->input('integration_method'))->name;
        } else {
            $stepDetails['integration']['integration_id'] = $request->input('integration_method');
            $stepDetails['integration']['list_id'] = $request->input('integration_list_id');
            $stepDetails['integration']['type'] = UserIntegration::find($request->input('integration_method'))->service_type;
            $stepDetails['integration']['name'] = UserIntegration::find($request->input('integration_method'))->name;
        }

        $funnelStep->details = json_encode($stepDetails);

        if ( $funnelStep->save() ) {

            $funnel = Funnel::find($funnel_id);
            $funnel->updated_at = date('Y-m-d h:i:s');
            $funnel->save();

            die(json_encode(
                array(
                    'status'    => 'success',
                    'message'   => 'Integration settings has been saved',
                    'url'       => route('funnel.step.integration.show', [$funnel_id, $step_id])
                )
            ));
        } else {
            die(json_encode(
                array(
                    'status'    => 'error',
                    'message'   => 'Error! please try again later'
                )
            ));
        }
    }


    public function removeStepIntegration(Request $request, $funnel_id, $step_id) {

        $funnelStep = FunnelStep::find($step_id);
        $stepDetails = json_decode($funnelStep->details);

        unset($stepDetails->integration);

        $funnelStep->details = json_encode($stepDetails);

        if ( $funnelStep->save() ) {

            $funnel = Funnel::find($funnel_id);
            $funnel->updated_at = date('Y-m-d h:i:s');
            $funnel->save();

            die(json_encode(
                array(
                    'status'    => 'success',
                    'message'   => 'Integration settings has been removed',
                    'url'       => route('funnel.step.integration.show', [$funnel_id, $step_id])
                )
            ));
        } else {
            die(json_encode(
                array(
                    'status'    => 'error',
                    'message'   => 'Error! please try again later'
                )
            ));
        }
    }


    /**
     * search products to add on funnel step
     */

     public function searchProducts(Request $request, $funnel_id, $step_id) {

        $data 				= array();		
        $step				= FunnelStep::find( $step_id );
        
        $data['type'] 		= $request->input( 'type' );
        $data['funnel_id']  = $step['funnel_id'];
        $data['step_id'] 	= $step['id'];
        $data['products']   = get_products( $step->funnel_id, $request->input( 'keyword' ) );
        
        return view('product.bump-product-list', compact('data'));
     }
}
