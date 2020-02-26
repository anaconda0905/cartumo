<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Developer;
use Validator;
use Hash;
use Auth;
use App\BaseUrl;
use Image;

class DeveloperController extends Controller
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
        $data['developers'] = Developer::orderBy('id', 'desc')->paginate(20);
		
        //return view('admin.developer.list')->withData($data);
        return view('admin.developer.list')->withData($data);       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.developer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = [
            'name' 		=> $request->name,
            'email' 			=> $request->email,
            'password' 			=> $request->password,
            'confirm_password' 	=> $request->confirm_password
        ];

        $rules = [
                    'name' 		=> 'required|max:255',
                    'email' 			=> 'required|email|max:255',
                    'password' 			=> 'required|min:6',
                    'confirm_password' 	=> 'required|same:password'
                ];

        $validator = Validator::make($inputs, $rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput()->with( [ 'error' , 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email ] );
        }

        $user = new Developer;
        $user->name  = $request->name;
        $user->email 	   = $request->email;
        $user->password    = Hash::make($request->password);
        $user->status      = $request->status;

        if($user->save())
        {
            return redirect()->route('admin.developer.index')->with('success', 'New developer created successfully.');
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
        $data['developer'] = Developer::find($id);

		if(!$data['developer'])
		{
			return redirect()->route('admin.developer.index')->with('error', 'Developer not found.');
		}

        //return view('admin.developer.show', ['developer' => $developer]);
        return view('admin.developer.show')->withData($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['developer'] = Developer::find($id);
		return view('admin.developer.edit')->withData($data);
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
        $inputs = [
            'name' 		=> $request->name,
            'email' 			=> $request->email,
        ];

        $rules = [
                    'name' 		=> 'required|max:255',
                    'email' 			=> 'required|email|max:255',
                ];

        $validator = Validator::make($inputs, $rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput()->with( [ 'error' , 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email ] );
        }

        $developer = Developer::find($id);

        $developer->name  = $request->name;
        $developer->email  	   = $request->email;
        $developer->status      = $request->status;

        if($developer->save())
        {
            return redirect()->back()->with('success', 'Developer edited successfully.');
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
        $developer = Developer::find($id);

        if($developer->delete())
		{
			die(
                json_encode(
                    array(
                        'status'    => 'success',
                        'url'   => route('admin.developer.index')
                    )
                )
            );
		}
		else
		{
    		die(
                json_encode(
                    array(
                        'status'    => 'error',
                        'message'   => "Please try again later"
                    )
                )
            );
    	}
    }
}
