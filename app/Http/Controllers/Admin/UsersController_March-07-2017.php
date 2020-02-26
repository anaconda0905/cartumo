<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Hash;
use Auth;

class UsersController extends Controller
{
	public function index()
	{
		$users = User::where( 'id', '!=', Auth::id() )->get();
		
		return view('admin.users.index', ['users' => $users]);
	}

	public function ajax_switch(Request $request)
    {
    	$response = [
    		'success' => null
    	];

	    if ($request->ajax()) 
	    {
	        $user = User::find($request->id);

	        if ( $user->status == 1 )
	        {
	        	$user->status = 0;
	        }
	        else
	        {
	        	$user->status = 1;
	        }

	        if ( $user->save() )
	        {
	        	$response['success'] = 1;

	        }
	    }

	    return json_encode($response);
    }

	public function create()
	{
		return view('admin.users.create');
	}
	
	public function store(Request $request)
	{
		$inputs = [
					'first_name' 		=> $request->first_name,
					'last_name' 		=> $request->last_name,
					'email' 			=> $request->email,
					'password' 			=> $request->password,
					'confirmPassword' 	=> $request->confirmPassword
				];
		
		$rules = [
					'first_name' 		=> 'required|max:255',
					'last_name' 		=> 'required|max:255',
					'email' 			=> 'required|email|max:255',
					'password' 			=> 'required|min:6',
					'confirmPassword' 	=> 'required|same:password'
				];

		$validator = Validator::make($inputs, $rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput()->with( [ 'error' , 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email ] );
		}

		$user = new User;
		$user->first_name  = $request->first_name;
		$user->last_name   = $request->last_name;
		$user->email 	   = $request->email;
		$user->password    = Hash::make($request->password);

		if($user->save())
		{
			return redirect()->route('admin.users.index')->with('success', 'New User created successfully.');
		}


	}

	public function show($id = null)
	{
		$user = User::find($id);

		if(!$user)
		{
			return redirect()->route('admin.users.index')->with('error', 'User not found.');
		}

		return view('admin.users.view', ['user' => $user]);

	}

	public function edit($id = null)
	{
		$user = User::find($id);
		return view('admin.users.edit', ['user' => $user]);
	}

	public function update(Request $request,$id = null)
	{
		$inputs = [
					'first_name' 		=> $request->first_name,
					'last_name' 		=> $request->last_name,
					'email' 			=> $request->email,
				];
		
		$rules = [
					'first_name' 		=> 'required|max:255',
					'last_name' 		=> 'required|max:255',
					'email' 			=> 'required|email|max:255',
				];

		$validator = Validator::make($inputs, $rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput()->with( [ 'error' , 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email ] );
		}

		$image = '';

		if(!empty($_FILES['image']['name']))
		{
			$path_info = pathinfo($_FILES['image']['name']);
            $ext = $path_info['extension'];
            $ext = strtolower($ext);
            $old_image = $image;

            if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
            {
            	$file_name = time();
            	$new_name = $file_name . '.' . $ext;
            	$destination = base_path() . '/' . BaseUrl::getProfileImageUrl() . '/';

            	if(move_uploaded_file($_FILES['image']['tmp_name'], $destination.$new_name))
            	{
            		if(!empty($old_image))
            		{
            			if(file_exists($destination.$old_image))
            			{
            				unlink($destination.$old_image);
            			}
            		}
            		$image = $new_name;
            	}
            }
		}

		$user = User::find($id);

		if(!$user)
		{
			return redirect()->route('admin.users.index')->with('error', 'User not found.');
		}

		$user->first_name  = $request->first_name;
		$user->last_name   = $request->last_name;
		$user->email  	   = $request->email;
		$user->image  	   = $image;

		if($user->save())
		{
			return redirect()->back()->with('success', 'User edited successfully.');
		}

	}

	public function changePassword(Request $request,$id = null)
	{
		$inputs = [
					'oldPassword'     => $request->oldPassword,
					'password'        => $request->password,
					'confirmPassword' => $request->confirmPassword
				];
		$rules = [
					'oldPassword'     => 'required|min:6',
					'password'        => 'required|min:6',
					'confirmPassword' => 'required|same:password'
				];
		$validator = Validator::make($inputs, $rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}
		$user = User::find($id);
		// echo "<pre>"; print_r($user->password); die;
		$oldPassword  = password_verify($request->oldPassword, $user->password);
		
		if($oldPassword == 0)
		{
			return redirect()->back()->with('error', 'Enter Your Old Password.');
		}



		$user->password = Hash::make($request->password);

		if($user->save())
		{
			return redirect()->back()->with('success', 'Password changed successfully.');
		}


	}

	public function destroy($id = null)
	{
		$user = User::find($id);

		if(!$user)
		{
			return redirect()->route('admin.users.index')->with('error', 'User not found.');
		}

		if($user->delete())
		{
			return redirect()->route('admin.users.index')->with('success', 'User destroy successfully.');
		}
		else
		{
    		return redirect()->route('admin.users.index')->with('error', 'Some error occurred, please try again later.');    		
    	}
	}
}