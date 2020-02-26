<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator;

use App\HelpCenterTopic;
use App\HelpCenterCategory;

class HelpCenterCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helpCategories = HelpCenterCategory::orderBy('id', 'DESC')->paginate(20);

        return view('admin.help_center.category.list', compact('helpCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.help_center.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::only(
            'title',
            'slug',
            'position',
            'status'
        );

        //Validate the data
        $validation = Validator::make($input, array(

            'title'             => 'required|max:191',
            'slug'              => 'required|unique:help_center_categories',
            'position'          => 'required',
            'status'            => 'required'
        ));

        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->withErrors($validation->messages());
        } else {
            $helpCenterCategory           = new HelpCenterCategory;
            $helpCenterCategory->title    = $request->input('title');
            $helpCenterCategory->slug     = $request->input('slug');
            $helpCenterCategory->position = $request->input('position');
            $helpCenterCategory->status   = $request->input('status');
            $helpCenterCategory->save();

            return redirect()->route('admin.help-center.categories.index')->with('status', 'New category has been created!');;
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
        $helpCategory = HelpCenterCategory::find($id);

        return view('admin.help_center.category.edit', compact('helpCategory'));
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
        $input = Input::only(
            'title',
            'slug',
            'position',
            'status'
        );

        //Validate the data
        $validation = Validator::make($input, array(

            'title'             => 'required|max:191',
            'slug'              => 'required|unique:help_center_categories,id',
            'position'          => 'required',
            'status'            => 'required'
        ));

        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->withErrors($validation->messages());
        } else {
            $helpCenterCategory           = HelpCenterCategory::find($id);
            $helpCenterCategory->title    = $request->input('title');
            $helpCenterCategory->slug     = $request->input('slug');
            $helpCenterCategory->position = $request->input('position');
            $helpCenterCategory->status   = $request->input('status');
            $helpCenterCategory->save();

            return redirect()->route('admin.help-center.categories.index')->with('status', 'Category has been updated!');;
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
        //check if the category has any topic present in the db
        $helpTopics = HelpCenterTopic::where('category_id', $id)
                                     ->get();

        if ( $helpTopics->count() > 0 ) {
            foreach ( $helpTopics as $helpTopic ) {
                $topic = HelpCenterTopic::find($helpTopic->id);
                $topic->delete();
            }
        }

        //remove the category
        $helpCategory = HelpCenterCategory::find($id);
        if ( $helpCategory->delete() ) {
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
