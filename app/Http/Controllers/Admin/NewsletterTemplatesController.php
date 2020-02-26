<?php 

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\NewsletterTemplate;

class NewsletterTemplatesController extends Controller
{
	public function index()
	{
		$newsletterTemplates = NewsletterTemplate::get();
		
		return view('admin.newsletter_templates.index', ['newsletterTemplates' => $newsletterTemplates]);
	}

	public function update($id = null, Request $request)
	{
		$newsletterTemplate = NewsletterTemplate::find($id);
		
		NewsletterTemplate::where('id', $newsletterTemplate->id)->update(['content' => $request->content]);

		return redirect()->back()->with('success', 'Template edited successfully.');
		
	}

}


