<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\NewsletterSubscription;
use Illuminate\Support\Facades\Mail;


class NewsletterSubscriptionsController extends Controller
{
	public function store(Request $request)
	{
		$inputs['email'] = $request->email;
		$rules['email']	 = 'required|email|max:255';

		$validator = Validator::make($inputs, $rules);

		if( $validator->fails() )
		{
			return redirect()->back()->withInput()->with(['error' => 'Please enter a valid email address.']);
		}

		$newsletterSubscription = new NewsletterSubscription;
		$newsletterSubscription->email = $request->email;

		$checkEmail = NewsletterSubscription::where('email', $request->email)->first();
		if($checkEmail)
		{
			return redirect()->back()->with('success', 'You are already subscribed to our newsletters.');
		}
		
		if( $newsletterSubscription->save() )
		{
			$id = base64_encode(convert_uuencode($newsletterSubscription->id));
			// $id = $newsletterSubscription->id;

			Mail::send('emails.confirm-newsletter-subscription', ['id' => $id] , function($message) use ($newsletterSubscription){
	            $message->from('promatics.kushalarora04@gmail.com', 'Stellar Winds');
	            $message->to($newsletterSubscription->email, $newsletterSubscription->first_name)->subject('Email Subscription Confirmation');
	        });
			return redirect()->back()->with('success', 'Please check your email and confirm subscription.');
		}
		
	}

	public function confirmationEmail()
	{
		$id = convert_uudecode(base64_decode($_GET['id']));

		if($id)
		{
			NewsletterSubscription::where('id', $id)->update(['status' => 1]);
		}

		return view('emails.newsletter-subscription-thankYou');
	}

}