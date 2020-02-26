<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Faq;
use Validator;

class FaqController extends Controller
{
	public function index()
	{
		$faqs = Faq::get();

		return view('admin.faqs.index', ['faqs' => $faqs]);
	}

	public function create()
	{
		return view('admin.faqs.create');
	}

	public function store(Request $request)
	{
		$inputs = [
					'question' => $request->question,
					'answer'   => $request->answer,
				];

		$rules  = [
					'question' => 'required|max:255',
					'answer'   => 'required',	

				];

		$validator = Validator::make($inputs, $rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors( $validator )->withInput()->with( [ 'error' , 'question' => $request->question, 'answer'=>$request->answer ] );
		}

		$faq = new Faq;
		$faq->question = $request->question;
		$faq->answer   = $request->answer;

		if($faq->save())
		{
			return redirect()->route('admin.faqs.index')->with('success', 'Faq created successfully.');
		}

	}

	public function edit($id = null)
	{
		$faq = Faq::find($id);

		if(!$faq)
		{
			return redirect()->route('admin.faqs.index')->with('error', 'Faq not found.');
		}

		return view('admin.faqs.edit', ['faq' => $faq]);
	}

	public function update(Request $request, $id = null)
	{
		$inputs = [
					'question' => $request->question,
					'answer'   => $request->answer,
				];

		$rules  = [
					'question' => 'required|max:255',
					'answer'   => 'required',	

				];

		$validator = Validator::make($inputs, $rules);

		if($validator->fails())
		{
			return redirect()->back()->withErrors( $validator )->withInput()->with( [ 'error' , 'question' => $request->question, 'answer'=>$request->answer ] );
		}

		$faq = Faq::find($id);

		if(!$faq)
		{
			return redirect()->route('admin.faqs.index')->with('error', 'Faq not found.');
		}

		$faq->question = $request->question;
		$faq->answer = $request->answer;

		if($faq->save())
		{
			return redirect()->route('admin.faqs.index')->with('success', 'Faq Edited successfully.');
		}


	}

	public function destroy($id = null)
	{
		$faq = Faq::find($id)->delete();
		if(!$faq)
		{
			return redirect()->route('admin.faqs.index')->with('error', 'Faq not found.');
		}
		
		return redirect()->route('admin.faqs.index')->with('success', 'Faq deleted successfully.');
	}

}