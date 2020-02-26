<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator;

use App\HelpCenterTopic;
use App\HelpCenterCategory;

use URL;

class HelpCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helpTopics = HelpCenterTopic::orderBy('id', 'DESC')->paginate(20);

        return view('admin.help_center.list', compact('helpTopics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = HelpCenterCategory::orderBy('title')->pluck('title', 'id');

        return view('admin.help_center.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( !empty($request->input('action')) && $request->input('action')=='image_upload' ) {

            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    $name = md5(rand(100, 200));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    $destination = public_path('/global/img/help/' . $filename); //change this directory
                    $location = $_FILES["file"]["tmp_name"];
                    move_uploaded_file($location, $destination);
                    echo URL::asset('global/img/help/' . $filename);//change this URL
                } else {
                  echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
            }
        } else {

            $input = Input::only(
                'title',
                'slug',
                'category_id',
                'details',
                'status'
            );

            //Validate the data
            $validation = Validator::make($input, array(

                'title'             => 'required|max:191',
                'slug'              => 'required|unique:help_center_topics',
                'category_id'       => 'required|numeric',
                'details'           => 'required',
                'status'            => 'required'
            ));

            //echo '<pre>'; print_r(Input::all()); die;

            if ( $validation->fails() ) {
                return redirect()->back()->withInput()->withErrors($validation->messages());
            } else {
                $HelpCenterTopic                = new HelpCenterTopic;
                $HelpCenterTopic->title         = $request->input('title');
                $HelpCenterTopic->slug          = $request->input('slug');
                $HelpCenterTopic->category_id   = $request->input('category_id');
                $HelpCenterTopic->details       = $request->input('details');
                $HelpCenterTopic->status        = $request->input('status');
                $HelpCenterTopic->save();

                return redirect()->route('admin.help-center.index')->with('status', 'New topic has been created!');;
            }
        }
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
        $helpTopic = HelpCenterTopic::find($id);
        $categories = HelpCenterCategory::orderBy('title')->pluck('title', 'id');

        return view('admin.help_center.edit', compact('helpTopic', 'categories'));
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
        if ( !empty($request->input('action')) && $request->input('action')=='image_upload' ) {

            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    $name = md5(rand(100, 200));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    $destination = public_path('/global/img/help/' . $filename); //change this directory
                    $location = $_FILES["file"]["tmp_name"];
                    move_uploaded_file($location, $destination);
                    echo URL::asset('global/img/help/' . $filename);//change this URL
                } else {
                  echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
            }
        } else {

            $input = Input::only(
                'title',
                'slug',
                'category_id',
                'details',
                'status'
            );

            //Validate the data
            $validation = Validator::make($input, array(

                'title'             => 'required|max:191',
                'slug'              => 'required|unique:help_center_topics,id',
                'category_id'       => 'required|numeric',
                'details'           => 'required',
                'status'            => 'required'
            ));

            //echo '<pre>'; print_r(Input::all()); die;

            if ( $validation->fails() ) {
                return redirect()->back()->withInput()->withErrors($validation->messages());
            } else {
                $HelpCenterTopic                = HelpCenterTopic::find($id);
                $HelpCenterTopic->title         = $request->input('title');
                $HelpCenterTopic->slug          = $request->input('slug');
                $HelpCenterTopic->category_id   = $request->input('category_id');
                $HelpCenterTopic->details       = $request->input('details');
                $HelpCenterTopic->status        = $request->input('status');
                $HelpCenterTopic->save();

                return redirect()->route('admin.help-center.index')->with('status', 'Topic has been updated!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = HelpCenterTopic::find($id);
        if ( $topic->delete() ) {
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
