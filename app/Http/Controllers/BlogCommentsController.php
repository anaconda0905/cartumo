<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BlogComment;
use Validator;
use Auth;

class BlogCommentsController extends Controller
{
	public function store(Request $request, $id = null)
	{
		$inputs = [
					'message' => $request->message,
				];
		
		$rules = [
					'message' => 'required',
				];

		if(isset($request->name) && isset($request->email))
		{
			$inputs['name']  = $request->name;
			$inputs['email'] = $request->email;

			$rules['name'] = 'required|max:255';
			$rules['email'] = 'required|max:255|email';
		}

		$validator = Validator::make($inputs, $rules);

		if($validator -> fails())
		{
			return redirect()->back()->withErrors($validator);
		}
		
		$blogComment = new BlogComment;
		if(Auth::check())
		{
			$blogComment->user_id    = Auth::user()->id;
		}
		$blogComment->blog_id    = $request->blog_id;
		if(isset($request->name) && isset($request->email))
		{
			$blogComment->sender_name    = $request->name;
			$blogComment->email   = $request->email;
		}


		$blogComment->message = $request->message;

		if($blogComment->save())
		{
			return redirect()->back()->with('success', 'Message sent successfully.');
		}

	}


}