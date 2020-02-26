<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

use App\Models\Widgets;

use App\Models\Product;

use App\Models\StepProduct;

use App\Models\UserShop;

use App\Models\UserIntegration;

use App\Models\UserGallery;

use Validator;

use File;

use App\Models\FunnelStep;
use App\Models\FunnelType;

use Storage;

use Auth;

class WidgetController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index( $id = null ) {
        $widgets    = new Widgets;
        $allWidgets = $widgets->getWidgets();
        $step = FunnelStep::find($request->input('step_id'));
        $type = FunnelType::find($step->type);

        echo view( 'editor.widgets.' . $id, array( 'widgets' => $allWidgets, 'type' => $type ) );
        die;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request, $id ) {
        $widgets    = new Widgets;
        $allWidgets = $widgets->getWidget( $id );
        $step = FunnelStep::find($request->input('step_id'));
        $type = FunnelType::find($step->type);
        $stepProduct = StepProduct::where('step_id', $id)->first();

        echo view( 'editor.widgets.' . $id, array( 'widgets' => $allWidgets, 'type' => $type, 'stepProduct' => $stepProduct ) );

        //echo view( 'editor.widgets.' . $id, array( 'widgets' => $allWidgets ) );
        die;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        //
    }


    public function getElement( Request $request, $element_id ) {
        //echo $element_id; die; //section_product_main_image

        //print_r($element_id); die;

        $data = array();

        //$view = str_ireplace('_', '.', $element_id);
        $id = $element_id . time();

        if ( $element_id == 'elements_order_2_step' ) {
            $data['months'] = range( 1, 12 );
            $data['years']  = range( date( 'Y' ), intval( date( 'Y' ) + 20 ) );
        }

        //echo $request->input('step_id'); die;

        if ( ! empty( $request->input( 'step_id' ) ) ) {
            if ( $element_id == 'product-row' ) {

                //get the step product
                $stepProduct = StepProduct::where('step_id', $request->input( 'step_id' ))
                    ->orderBy('id')
                    ->first();
                $stepProductDetails = json_decode($stepProduct->details);
                $step_product_id = $stepProductDetails->product_id;

                $data['product_id'] = $step_product_id;

                $stepProduct = StepProduct::where( 'funnel_id', $request->input( 'funnel_id' ) )
                    ->where( 'funnel_id', $request->input( 'step_id' ) )
                    ->first();

                if ( empty( $stepProduct ) ) {
                    $stepProduct = new StepProduct;
                } else {
                    $stepProduct = StepProduct::find( $stepProduct->id );
                }

                $stepProduct->funnel_id      = $request->input( 'funnel_id' );
                $stepProduct->step_id        = $request->input( 'step_id' );
                $stepProduct->product_id     = $request->input( 'product_id' );
                $stepProduct->payment_getway = "";
                $stepProduct->email_options  = json_encode( array() );
                $stepProduct->created_at     = date( 'Y-m-d h:i:s' );
                $stepProduct->updated_at     = date( 'Y-m-d h:i:s' );
                $stepProduct->save();

            } elseif ( ( $element_id == 'elements_order_2_step' ) || ( $element_id == 'section_product_main_image' ) || ( $element_id == 'section_product_title' ) || ( $element_id == 'section_product_description' ) || ( $element_id == 'section_product_varients' ) || ( $element_id == 'section_product_price' ) || ( $element_id == 'elements_product_cart' ) || ( $element_id == 'section_product_availability' ) ) {

                //echo $element_id; die;
                //print_r($request->all()); die;

                if ( ! empty( $request->input( 'step_id' ) ) ) {
                    $step = FunnelStep::find( $request->input( 'step_id' ) );
                } else {
                    $page = Page::find( $request->input( 'hid_page_id' ) );
                    $step = FunnelStep::find( $page->funnel_step_id );
                }

                //print_r($request->all()); die;

                $results = $this->getProduct( $step->funnel_id, $step );

                //print_r($results[0]); die;

                if ( ! empty( $results ) ) {

                    $data['product']     = $results[0];
                    $data['stepProduct'] = $results[1];
                }

            } elseif ( $element_id == 'section_order_bump' ) {

                $step = FunnelStep::find( $request->input( 'step_id' ) );
                $type = FunnelType::find( $step->type );

                if ( $type == 'Upsell' || $type == 'Downsell' ) {
                    //get the last product as first because last product always be a bump product
                    $stepProduct = StepProduct::where( 'step_id', $step->id )->orderBy( 'id', 'desc' )->first();

                    if ( $stepProduct->count() > 0 ) {
                        $details = json_decode( $stepProduct->details );

                        if ( ! empty( $details->bump ) ) {
                            $data['product_id']   = $details->product_id;
                            $data['product_type'] = $stepProduct->product_type;
                        }
                    }
                } else {
                    $productStep = FunnelStep::where( 'funnel_id', $step->funnel_id )->orderBy( 'order_position', 'asc' )->first();

                    //get the last product as first because last product always be a bump product
                    $stepProduct = StepProduct::where( 'step_id', $productStep->id )->orderBy( 'id', 'desc' )->first();

                    if ( $stepProduct->count() > 0 ) {
                        $details = json_decode( $stepProduct->details );

                        if ( ! empty( $details->bump ) ) {
                            $data['product_id']   = $details->product_id;
                            $data['product_type'] = $stepProduct->product_type;
                        }
                    }
                }
            }
        }

        //print_r($element_id); die;

        echo view( 'editor.widgets.backend.' . $element_id, array( 'id' => $id, 'data' => $data ) );
    }


    public function ajaxImageUpload() {
        echo 'uploading';
    }

    public function ajaxImageUploadPost( Request $request ) {


        //print_r($_POST); die;

        //$this->uploadFileToS3($request);

        $userImages = UserGallery::where( 'user_id', Auth::user()->id )->get();

        if ( ! empty( $userImages ) && $userImages->count() > env( 'MAX_IMAGE_UPLOAD_LIMIT' ) ) {
            //echo response()->json(['error'=>'You can not upload more than']);
            echo json_encode( array( 'status'  => 'error',
                'message' => 'You can not upload more than ' . env( 'MAX_IMAGE_UPLOAD_LIMIT' ) . ' images'
            ) );
            die;
        } else {

            $userGallery = new UserGallery;

            $validator = Validator::make( $request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ] );

            if ( $validator->passes() ) {

                $input          = $request->all();
                $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move( public_path( 'frontend/builder/images/gallery/' . strtolower( $request->input( 'media_tab' ) ) ), $input['image'] );

                //AjaxImage::create($input);

                $userGallery->user_id = Auth::user()->id;
                $userGallery->path    = $input['image'];
                $userGallery->status  = true;
                $userGallery->save();

                echo json_encode( array( 'status' => 'success', 'data' => $request->input( 'media_tab' ) ) );
                die;
                //echo response()->json(['success'=>'done', 'data' => $request->input('media_tab')]);
            }
        }

        //echo response()->json(['error'=>$validator->errors()->all()]);
    }


    private function uploadFileToS3( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:999999',
        ] );

        if ( $validator->passes() ) {

            try {
                $s3            = Storage::disk( 's3' );
                $image         = $request->file( 'image' );
                $input         = $request->all();
                $imageFileName = time() . '.' . $request->image->getClientOriginalExtension();
                $filePath      = '/library/' . $imageFileName;
                $s3->put( $filePath, file_get_contents( $image ), 'public' );

                //save to database
                $userGallery          = new UserGallery;
                $userGallery->user_id = Auth::user()->id;
                $userGallery->path    = $imageFileName;
                $userGallery->status  = true;
                $userGallery->save();

                die( json_encode( array( 'status' => 'success', 'data' => $request->input( 'media_tab' ) ) ) );
            } catch ( Exception $ex ) {
                die( json_encode( array( 'status' => 'error', $ex->getMessage() ) ) );
            }
        }
    }


    public function getGalleryImages( Request $request ) {

        $userImages = UserGallery::where( 'user_id', Auth::user()->id )->orderBy( 'id', 'desc' )->get();

        $files        = File::allFiles( public_path() . '/frontend/builder/images/gallery/' );
        $directories  = glob( public_path() . '/frontend/builder/images/gallery/*', GLOB_ONLYDIR );
        $libraryFiles = array();

        //bucket files
        /*$awsFiles = Storage::disk('s3')->files('library/');
        //echo '<pre>'; print_r($awsFiles); die;
        $libraryFiles = array();

        foreach ( $awsFiles as $sfile ) {

            //echo '<pre>'; print_r($awsFiles); die;
            $afile = explode('library/', $sfile);

            foreach ( $userImages as $userImage ) {

                if ( $userImage->path == $afile[1] ) {
                    $libraryFiles[] = Storage::disk('s3')->url($sfile);
                }
            }
        }*/

        echo view( 'editor.widgets.extra.gallery_images', array( 'userImages'   => $userImages,
            'images'       => $files,
            'directories'  => $directories,
            'tab'          => $request->input( 'media_tab' ),
            'libraryFiles' => $libraryFiles
        ) );

        //print_r($_GET);
    }


    public function getscreenshoot( Request $request ) {

        $image_data = $request->input( 'image_data' );
        //$data = base64_decode($image_data);
        //$img = imagecreatefromstring($data);

        //$filename = public_path() . "/global/img/screenshoots/image_" . time() . ".png";
        //@copy($filename, $img);

        /*$filename = public_path() . "/global/img/screenshoots/image_" . time() . ".png";
        $myfile = fopen($filename, "w") or die("Unable to open file!");
        $txt = $image_data . "\n";
        fwrite($myfile, $txt);
        fclose($myfile);*/

        //echo public_path($filename);

        $filename = public_path() . "/global/img/screenshoots/";
        define( 'UPLOAD_DIR', $filename );
        $img = $image_data;
        //$img = str_replace('data:image/png;base64,', '', $img);
        //$img = str_replace(' ', '+', $img);
        $data    = base64_decode( $img );
        $file    = UPLOAD_DIR . uniqid() . '.png';
        $success = file_put_contents( $file, $data );
        print $success ? $file : 'Unable to save the file.';

        die;
    }


    private function getProductPage( $funnel_id ) {

        $funnelSteps = FunnelStep::where( 'funnel_id', $funnel_id )->orderBy( 'order_position', 'asc' )->get();

        //echo $funnelSteps; die;

        foreach ( $funnelSteps as $step ) {

            $funnelType = FunnelType::find( $step->type );

            //echo $funnelType; die;

            if ( strtolower( $funnelType->name ) == 'product' || strtolower( $funnelType->name ) == 'sales' ) {
                //echo $step; die;
                return $step;
            }
        }

        return null;
    }


    public function getShopifyProduct( $product_id ) {

        $userIntegration = UserIntegration::where( 'user_id', Auth::user()->id )->where( 'service_type', 'shopify' )->first();
        $json            = json_decode( $userIntegration->details );

        $API_KEY      = $json->api_key;
        $API_PASSWORD = $json->password;
        $SECRET       = $json->shared_secret;
        $store_name   = $json->name;

        //https://2eac3486958d276e3a41dd6a6d50456a:4f7087ae3a73c2ebf2f76782ec9260c2@alldayfreeshipping.myshopify.com/admin/orders.json

        //die($url);
        $url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . $product_id . ".json";

        return json_decode( file_get_contents( $url ) );
    }


    /////////////////////// COPIED FROM PAGES CONTROLLER ////////////////////////////////////
    private function getProduct( $funnel_id, $currentFunnelStep = null ) {

        $funnelSteps       = FunnelStep::where( 'funnel_id', $funnel_id )->orderBy( 'order_position', 'asc' )->get();
        $currentFunnelType = FunnelType::find( $currentFunnelStep->type );

        //echo $funnelSteps; die;

        //echo

        if ( ( strtolower( $currentFunnelType->name ) != 'order' ) && ( strtolower( $currentFunnelType->name ) != 'confirmation' ) ) {
            $stepProduct = StepProduct::where( 'step_id', $currentFunnelStep->id )->first();

            if ( ! empty( $stepProduct ) ) {
                if ( $stepProduct->product_type == 'shopify' ) {
                    $product = $this->getShopifyProduct( json_decode( $stepProduct->details )->product_id );
                } else {
                    $product = Product::find( json_decode( $stepProduct->details )->product_id );
                }

                return [ $product, $stepProduct ];
            }
        } else {
            foreach ( $funnelSteps as $step ) {

                $funnelType = FunnelType::find( $step->type );

                if ( strtolower( $funnelType->name ) == 'product' || strtolower( $funnelType->name ) == 'sales' ) {
                    //echo $step; die;
                    //return $step;

                    //echo $step->id; die;
                    $stepProduct = StepProduct::where( 'step_id', $step->id )->first();
                    //echo json_decode($stepProduct->id)->product_id; die;

                    if ( ! empty( $stepProduct ) ) {

                        //echo json_decode($stepProduct->id)->product_id; die;

                        if ( $stepProduct->product_type == 'shopify' ) {
                            $product = $this->getShopifyProduct( json_decode( $stepProduct->details )->product_id );
                        } else {
                            $product = Product::find( json_decode( $stepProduct->details )->product_id );
                        }

                        //$product = Product::find(json_decode($stepProduct->details)->product_id);

                        return [ $product, $stepProduct ];
                    }
                }
            }
        }

        return array();
    }


    public function removeGalleryImages( Request $request ) {

        $path = public_path( 'frontend/builder/images/gallery/library/' . $request->input( 'image' ) );

        //echo $path;

        if ( File::exists( $path ) ) {
            File::delete( $path );
        } else {
            $awsFile = Storage::disk( 's3' )->delete( 'library/', $request->input( 'image_id' ) );
        }

        //delete form database
        if ( strpos( $request->input( 'image_id' ), '.' ) != false ) {
            $userImage = UserGallery::where( 'path', $request->input( 'image_id' ) )->first();
        } else {
            $userImage = UserGallery::find( $request->input( 'image_id' ) );
        }


        if ( $userImage->delete() ) {
            $userImages = UserGallery::where( 'user_id', Auth::user()->id )->get()->count();
            die(
            json_encode(
                [ 'status' => 'success', 'total' => $userImages ]
            )
            );
        } else {
            $userImages = UserGallery::where( 'user_id', Auth::user()->id )->get()->count();
            die(
            json_encode(
                [ 'status' => 'error', 'total' => $userImages ]
            )
            );
        }

        /*} else {

            $awsFile = Storage::disk('s3')->delete('library/', $request->input('image_id'));
            print_r($awsFile);

            $userImages = UserGallery::where('user_id', Auth::user()->id)->get()->count();

            die(
                json_encode(
                    ['status'    => 'error', 'total' => $userImages]
                )
            );
        }*/
    }


    public function getUserGalleryImages( Request $request ) {

        $userImages = UserGallery::where( 'user_id', Auth::user()->id )->orderBy( 'id', 'desc' )->get();

        $files        = File::allFiles( public_path() . '/frontend/builder/images/gallery/' );
        $directories  = glob( public_path() . '/frontend/builder/images/gallery/*', GLOB_ONLYDIR );
        $libraryFiles = array();

        /*//bucket files
        $awsFiles = Storage::disk('s3')->files('library/');
        //echo '<pre>'; print_r($awsFiles); die;
        $libraryFiles = array();

        foreach ( $awsFiles as $sfile ) {

            //echo '<pre>'; print_r($awsFiles); die;
            $afile = explode('library/', $sfile);

            //echo $userImages; die;

            foreach ( $userImages as $userImage ) {

                if ( $userImage->path == $afile[1] ) {
                    $libraryFiles[] = Storage::disk('s3')->url($sfile);
                }
            }
        }*/

        echo view( 'editor.widgets.extra.gallery_images', array( 'userImages'   => $userImages,
            'images'       => $files,
            'directories'  => $directories,
            'tab'          => $request->input( 'media_tab' ),
            'libraryFiles' => $libraryFiles
        ) );
    }
}
