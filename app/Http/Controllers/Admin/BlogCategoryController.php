<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\BlogCategory;
use Validator;

class BlogCategoryController extends Controller
{
	public function index()
	{
		$blogCategories = BlogCategory::get();

		return view('admin.blogCategories.index', ['blogCategories' => $blogCategories]);
	}

	public function store(Request $request)
	{
		$validator = Validator::make(
				[
					'name' => $request->name
				],

				[
					'name' => 'required|unique:blog_categories,name',
				]	
			);

		if($validator->fails())
		{
			return redirect()->back()->with('error', 'Category Name can not be empty');
		}

		$blogCategory = new BlogCategory;
		$blogCategory->name = $request->name;
		if($blogCategory->save())
		{
			return redirect()->route('admin.blog-categories.index')->with('success', 'Category created successfully');
		}
		else
		{
			return redirect()->route('admin.blog-categories.index')->with('error', 'Category could not be Created due to an unexpected error.');
		}

	}

	public function edit($id)
	{
		$blogCategory = BlogCategory::find($id);

		return view('admin.blogCategories.edit', ['blogCategory' => $blogCategory]);
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make(
				[
					'name' => $request->name
				],

				[
					'name' => 'required|unique:blog_categories,name',
				]	
			);

		if($validator->fails())
		{
			return redirect()->back()->with('error', 'Category Name can not be empty');
		}

		$blogCategory = BlogCategory::find($id);

		if(!$blogCategory)
		{
			return redirect()->route('admin.blog-categories.index')->with('error', 'Category not found');
		}

		$blogCategory->name = $request->name;
		if($blogCategory->save())
		{
			return redirect()->route('admin.blog-categories.index')->with('success', 'Category Edited Successfully');
		}
	}

	public function destroy($id)
	{
		if(BlogCategory::where('id', $id)->delete())
		{
			return redirect()->route('admin.blog-categories.index')->with('success', 'Category Deleted Successfully');
		}
		else
		{
    		return redirect()->route('admin.blog-categories.index')->with('error', 'Some error occurred, please try again later.');    		
    	}
	}


}