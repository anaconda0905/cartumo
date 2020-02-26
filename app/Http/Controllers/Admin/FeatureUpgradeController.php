<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\FeatureUpgrad;

class FeatureUpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth:admin');
     }
 
     public function index()
     {
         $data['feature_upgrades'] = FeatureUpgrad::orderBy('id', 'desc')->paginate(25);
 
         return view('admin.upgrade.list')->withData($data);
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
        //
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
        $data['feature_upgrade'] = FeatureUpgrad::find($id);
        
        return view('admin.upgrade.edit')->withData($data);
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
            'name',
            'type',
            'details'
        );

        //Validate the data
        $validation = Validator::make($input, array(

            'name'      => 'required|max:191',
            'type'      => 'required',
            'details'   => 'required'
        ));

        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->withErrors($validation->messages());
        } else {
            $featureUpgrad = FeatureUpgrad::find($id);
            $featureUpgrad->name = $request->input('name');
            $featureUpgrad->description = $request->input('description');
            $featureUpgrad->type = $request->input('type');
            $featureUpgrad->details = json_encode($request->input('details'));
            $featureUpgrad->status = $request->input('status');
            $featureUpgrad->save();

            return redirect()->route('admin.feature-upgrade.index')->with('status', 'Upgrade has been saved!');
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
        //
    }
}
