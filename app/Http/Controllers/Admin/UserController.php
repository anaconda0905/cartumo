<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\User;
use App\Profile;
use View;

use Auth;

class UserController extends Controller
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
    	//get all users but not pending ones
        $data['users'] = User::where('status', '<', 2)
                             ->orderBy('id', 'desc')
                             ->paginate(25);

        return view('admin.user.list')->withData($data);
    }

    public function pending()
    {
    	//get all users of pending ones
        $data['users'] = User::where('status', 2)
                             ->orderBy('id', 'desc')
                             ->paginate(25);

        return view('admin.user.pending')->withData($data);
    }

    public function activateAccount(Request $request)
    {
    	//get all users of pending ones
        $user = User::find($request->input('user_id'));
	    $user->status = true;

	    if ( $user->save() ) {

		    die(
		    json_encode(
			    array(
				    'status'    => 'success',
				    'url'       => route('admin.user.index')
			    )
		    )
		    );
	    } else {
		    die(
		    json_encode(
			    array(
				    'status'    => 'error',
				    'message'   => 'Something wrong! Please try after some time.'
			    )
		    )
		    );
	    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
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
            'name',
            'email',
            'password'
        );

        //Validate the data
        $validation = Validator::make($input, array(

            'name'          => 'required|max:191',
            'email'         => 'required|unique:users',
            'password'      => 'required'
        ));

        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->withErrors($validation->messages());
        } else {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));

            if ( !empty($request->input('secret_code_text')) ) {
                $user->secret = $request->input('secret_code_text');
            }
            
            $user->status = $request->input('status');
            $user->save();
            
            //Profile
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->save();

            return redirect()->route('admin.user.index')->with('status', 'New user has been created!');;
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
        $data['user'] = User::find($id);                
        return view('admin.user.show')->withData($data);        
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
        $data['user'] = User::find($id);

        //echo $data['user']; die;
        
        return view('admin.user.edit')->withData($data);
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
            'email'
        );

        //Validate the data
        $validation = Validator::make($input, array(

            'name'          => 'required|max:191',
            'email'         => 'required|unique:users,email,' . $id
        ));

        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->withErrors($validation->messages());
        } else {
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            //$user->password = Hash::make($request->input('password'));

            if ( !empty($request->input('secret')) ) {
                $user->secret = $request->input('secret');
            }
            
            $user->status = $request->input('status');

            $user->save();

            return redirect()->route('admin.user.index')->with('status', 'User has been updated!');
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
        $user = User::find($id);

        if ( $user->delete() ) {

            die(
                json_encode(
                    array(
                        'status'    => 'success'
                    )
                )
            );
        } else {
            die(
                json_encode(
                    array(
                        'status'    => 'error',
                        'message'   => 'Error occurred'
                    )
                )
            );
        }
    }


    public function getUserList(Request $request) {

        //die($request->input('keyword'));

        $data['users'] = User::where('name', 'like', '%' . $request->input('keyword') . '%')->get();
        $data['keyword'] = $request->input('keyword');

        die(
            json_encode(
                array(
                    'status'    => 'success',
                    'html'      => View::make('admin.user.upgrade_list', array('data' => $data))->render()
                )
            )
        );
    }
}
