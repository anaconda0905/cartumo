<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CMSPage;

class CMSController extends Controller {

	public function index( Request $request, $slug ) {

		$cmsPage = CMSPage::where('slug', $slug)->first();

		return view('cms.pages.show', compact('cmsPage'));
	}
}