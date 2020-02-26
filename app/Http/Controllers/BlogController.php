<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogHasCategory;
use Validator;
use App\Models\BlogComment;
use Auth;
use Carbon\Carbon;

class BlogController extends Controller
{
	public function index()
	{
		$query = Blog::where('status', 1);

		if(isset($_GET['category']))
		{
			$blogCategory = BlogCategory::find($_GET['category']); 
			$blogCategory->blogHasCategory;
			foreach ($blogCategory->blogHasCategory as $blogid) 
			{
				$blogIDs[] = $blogid->blog_id;
			}

			if(empty($blogIDs))
			{
				return redirect()->route('blogs.index')->with('error', 'No blog found of this category.');
			}

			$query->whereIn('id', $blogIDs);
			
		}

		$blogCategories = BlogCategory::get();
		$blogs = $query->get();
		return view('blog', ['blogs' => $blogs,'blogCategories' => $blogCategories]);
	}

	public function show($id = null)
	{
		$blog = Blog::find($id);
		$blogCategories = BlogCategory::get();
		$blogHasCategories = BlogHasCategory::where('blog_id', $blog->id)->pluck('blog_category_id');
		$blogHasCategories = json_decode(json_encode($blogHasCategories));
		// echo "<pre>"; print_r($blogHasCategories); die;
		return view('blog-detail', ['blog' => $blog, 'blogCategories' => $blogCategories ,'blogHasCategories' => $blogHasCategories]);
	}

	

	
}