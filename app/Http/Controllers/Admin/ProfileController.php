<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Auth;
use Hash;
use App\BaseUrl;
use Image;

class ProfileController extends Controller
{
	public function show()
	{
		return view('admin.profile.view');
	}

	public function edit()
	{
		return view('admin.profile.edit');
	}

	public function update(Request $request)
	{
		$inputs = [
					'first_name' => $request->first_name,
					'last_name'  => $request->last_name,
					'email'	  	 => $request->email,
				];

		$rules  = [
					'first_name' => 'required|max:255',
					'last_name'  => 'required',	
					'email'	   	 => 'required|email|max:255',

				];

		$validator = Validator::make($inputs, $rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput()->with( [ 'error' , 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email ]);
		}

		$user = User::find(Auth::id());		

		$image = $user->image;

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

            			if( file_exists($destination . '/thumbnails/100x90/' . $old_image) )
            			{
            				unlink($destination . '/thumbnails/100x90/' . $old_image);
            			}
            		}
            		$image = $new_name;

            		//resize image for profile thumbnails
                $profile_thumbnail = Image::make($destination . $image)->resize(100, 90);

                $profile_thumbnail->save(base_path() . '/' . BaseUrl::getUserProfileThumbnailUrl() . "/100x90/" . $image);

            	}
            }
		}
		$user->first_name = $request->first_name;
		$user->last_name  = $request->last_name ;
		$user->email 	  = $request->email;
		$user->image 	  = $image;
		if($user->save())
		{
			return redirect()->route('admin.profile.edit')->with('success', 'User Profile has been Edited Successfully');
		}
	}

	public function changePassword(Request $request)
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
		$user = User::find(Auth::id());
		// echo "<pre>"; print_r($user->password); die;
		$oldPassword  = password_verify($request->oldPassword, $user->password);
		
		if($oldPassword == 0)
		{
			return redirect()->back()->with('error', 'Enter Your Old Password.');
		}



		$user->password = Hash::make($request->password);

		if($user->save())
		{
			return redirect()->route('admin.profile.show')->with('success', 'Password changed successfully.');
		}


	}

}