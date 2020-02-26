<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Funnel;
use App\Models\FunnelUpload;
use App\Models\FunnelStep;
use App\Models\FunnelType;

use Validator;
use File;
use Auth;
use Session;
use Storage;

class FunnelUploadController extends Controller
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


    public function index($id)
    {
        //echo ini_get('upload_max_filesize'); die;
        $funnel = Funnel::find($id);
        $funnelUploads = FunnelUpload::where('user_id', Auth::id())
                                      ->where('funnel_id', $id)
                                      ->orderby('id', 'desc')->get();
        $steps   = FunnelStep::where('funnel_id', $id)->orderBy('order_position')->get();
        $funnelTypes = FunnelType::orderBy('name')->get();

        return view('funnels.uploads.show', compact('funnel', 'funnelUploads', 'steps', 'funnelTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $funnel = Funnel::find($id);
        $funnelUploads = FunnelUpload::orderby('id', 'desc')->get();
        $steps   = FunnelStep::where('funnel_id', $id)->orderBy('order_position')->get();
        $funnelTypes = FunnelType::orderBy('name')->get();

        return view('funnels.uploads.create', compact('funnel', 'funnelUploads', 'steps', 'funnelTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $input = $request->all();
        
        $validator = Validator::make($request->all(), [
            'software_file' => 'required|mimes:zip|max:500000',
        ]);

        //echo '<pre>'; print_r($input['image']); die;

        /*foreach ( $input['image'] as $k=>$zip_file ) {

            //print_r($zip_file->getClientOriginalName()); die;

            $uploaded_file = time().'.'.$zip_file->getClientOriginalExtension();
            $zip_file->move(public_path('frontend/funnel/softwares/', $uploaded_file), $uploaded_file);  

            $funnelUpload = new FunnelUpload;
            $funnelUpload->user_id = Auth::user()->id;
            $funnelUpload->funnel_id = $id;
            $funnelUpload->actual_file_name =  $zip_file->getClientOriginalName();
            $funnelUpload->file_path =  $uploaded_file;
            $funnelUpload->download_token =  md5(time() . Session::getId());
            $funnelUpload->status = true;
            $funnelUpload->save();
        }*/

        //print_r($imges); die;

        /*if ($validator->passes()) {
            
            $input = $request->all();
            $input['software_file'] = time().'.'.$request->software_file->getClientOriginalExtension();
            $request->software_file->move(public_path('frontend/funnel/softwares/', $input['software_file']), $input['software_file']);  
            //move_uploaded_file(public_path('frontend/funnel/softwares/', $input['image']));   
            

            $funnelUpload = new FunnelUpload;
            $funnelUpload->user_id = Auth::user()->id;
            $funnelUpload->funnel_id = $id;
            $funnelUpload->actual_file_name =  $request->software_file->getClientOriginalName();
            $funnelUpload->file_path =  $input['software_file'];
            $funnelUpload->download_token =  md5(time() . Session::getId());
            $funnelUpload->status = true;
            $funnelUpload->save();

            die (
                json_encode(
                    array(
                        'status'    =>'success',
                        'url'       => route('funnels.upload.index', $id)
                    )
                )
            );
            
        } else {

            die (
                json_encode(
                    array(
                        'status'    =>'error',
                        'message'       => $validator->messages()
                    )
                )
            );
        }*/
        

        $this->uploadFileToS3($request, $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        /*$funnelUpload = FunnelUpload::find($request->input('upload_id'));

        if ( $funnelUpload->delete() ) {
            die(
                json_encode(
                    array(
                        'status' => 'success'
                    )
                )
            );
        }*/
    }


    public function deleteUpload(Request $request, $id) {

        $funnelUpload = FunnelUpload::find($request->input('upload_id'));

        //echo "==" . $funnelUpload; die;

        //remove file from disk
        $path = public_path('frontend/funnel/softwares/' . $funnelUpload->file_path);

        //echo $path; die;

        if ( File::exists($path) ) {
            File::delete($path);

            if ( $funnelUpload->delete() ) {
                die(
                    json_encode(
                        array(
                            'status' => 'success'
                        )
                    )
                );
            }
        }       
    }



    private function uploadFileToS3(Request $request, $id) {
        
        $validator = Validator::make($request->all(), [
            'software_file' => 'required|mimes:zip|max:500000',
        ]);

        if ($validator->passes()) {

            try {
                $s3 = Storage::disk('s3');
                $image = $request->file('software_file');
                $input = $request->all();
                $imageFileName = time().'.'.$request->software_file->getClientOriginalExtension();
                $filePath = '/bonuses/' . $imageFileName;
                $s3->put($filePath, file_get_contents($image), 'public');

                $funnelUpload = new FunnelUpload;
                $funnelUpload->user_id = Auth::user()->id;
                $funnelUpload->funnel_id = $id;
                $funnelUpload->actual_file_name =  $request->software_file->getClientOriginalName();
                $funnelUpload->file_path =  $imageFileName;
                $funnelUpload->download_token =  md5(time() . Session::getId());
                $funnelUpload->status = true;
                $funnelUpload->save();

                die (
                    json_encode(
                        array(
                            'status'    =>'success',
                            'url'       => route('funnels.upload.index', $id)
                        )
                    )
                );

            } catch (Exception $ex) {
                //die(json_encode(array('status'=>'error', $ex->getMessage())));
                die (
                    json_encode(
                        array(
                            'status'    =>'success',
                            'message'       => $ex->getMessage()
                        )
                    )
                );
            }
        }
    }
}
