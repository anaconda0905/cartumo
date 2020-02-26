<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;


class FaqController extends Controller
{
	public function index()
	{
		$faqs = Faq::get();
		return view('faq', ['faqs' => $faqs]);
	}
}