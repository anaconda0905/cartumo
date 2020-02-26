<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Validator;
use Auth;
use Hash;
use Image;
use Exception;

use App\Models\Funnel;
use App\Models\PasswordResetCode;
use App\Models\User;
use App\Models\BaseUrl;

class FrontEndController extends Controller
{
	/**
     *
     *
     * @return Response
     */
	public function getLogin()
	{
		return view('login');
	}

	/**
     *
     *
     * @return Response
     */
	public function postLogin(Request $request)
	{
		$flag = isset($request->remember) ? true : false;
		$loginMessage = "Login Successful.";
		if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password], $flag))
		{
			return redirect()->route('dashboard')->with('success', $loginMessage);
		}
		else
		{
			return redirect()->back()->with('error', 'Invalid login credentials. Please try again with valid information.');
		}
	}

	/**
     *
     *
     * @return Response
     */
	public function logout()
	{
		// Log the user out
        Auth::logout();

        // Redirect to the users page
        return redirect()->route('login')->with('success', 'You have successfully logged out!');
	}

	/**
     *
     *
     * @return Response
     */
	public function getRegister()
	{
		return view('register');
	}

	/**
     *
     *
     * @return Response
     */
	public function postRegister(Request $request)
	{
		// Data Validations
		// ----------------------------------------------------
		$inputs = [
			'email' => $request->email,
			'password' => $request->password,
			'confirm_password' => $request->cPassword
		];

		$rules = [
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6',
			'confirm_password' => 'required|same:password'
		];

		$validator = Validator::make($inputs, $rules);
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}

		// End - Data Validations


		// Creates and saves a new user
		// ----------------------------------------------------
		$user = new User;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		if($user->save())
		{
			// Sending Email Verification mail
			$this->_sendEmailVerificationMail($user);

			return redirect()->back()->with('success', 'Registration Successful. Please check your email to activate your account.');
		}
		else
		{
			return redirect()->route('login')->with('error', 'Could not register user due to some error.');
		}
	}

	public function dashboard()
	{
		$funnels = Funnel::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(5);
		$funnelCount = Funnel::where('user_id', Auth::id())->count();



		//return view('funnels_list', compact('funnels', 'funnelCount'));
		return view('dashboard', compact('funnels', 'funnelCount'));
		//return view('dashboard', compact('users'));
	}

	public function getProfile()
	{
		return view('profile');
	}

	public function postProfile(Request $request, $id=null)
	{
		$data = $request->all();
		$user = Auth::user();

		$inputs = [
					'first_name'  => $request->first_name,
					'last_name'   => $request->last_name,
					'email'       => $request->email,
					// 'image'		  => $request->image,
				];

		$rules  = [

					'first_name'  => 'required|max:255',
					'last_name'   => 'required|max:255',
					'email'       => 'required|email|max:255',
					// 'image' 	  => 'image|dimensions:min_width=200, min_height=100|mimes:jpeg,png,jpg',

				];

		if($request->image)
		{
			$inputs['image'] 			= $request->image;

			$rules['image']  			= 'required|image|dimensions:min_width=200, min_height=100|mimes:jpeg,png,jpg';

			$return['image.required'] 	= 'Minimum height should be 100 and minimum width should be 200.';
			$message['image'] 			= 'Minimum height should be 100 and minimum width should be 200.';

			$validator = Validator::make($inputs, $rules, $return, $message);

		}
		else
		{
			$validator = Validator::make($inputs, $rules);
		}



		/*$message = [
					'image' => 'Minimum height should be 100 and minimum width should be 200.',
				];

		$return = [
					'image.required' => 'Minimum height should be 100 and minimum width should be 200.',
				];

		$validator = Validator::make($inputs, $rules, $return, $message);*/

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput()->with( [ 'error' , 'first_name' => $request->first_name, 'last_name' => $request->last_name,'email' => $request->email, 'image' => $request->image ] );
		}

		if(!empty($_FILES['image']['name']))
		{
            $path_info = pathinfo($_FILES['image']['name']);
            $ext = $path_info['extension'];
            $ext = strtolower($ext);
            $old_image = $user->image;

            if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
            {
                $file_name = time();
                $new_name = $file_name.'.'.$ext;
                $destination = base_path() . '/' . BaseUrl::getProfileImageUrl().'/';

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
                //resize image for profile thumbnails
                $profile_thumbnail = Image::make($destination . $image)->resize(100, 90);

                $profile_thumbnail->save(base_path() . '/' . BaseUrl::getUserProfileThumbnailUrl() . "/100x90/" . $image);
            }
			$user->image = $image;
        }

		$user->first_name = $data['first_name'];
		$user->last_name = $data['last_name'];
		$user->email = $data['email'];

		if($user->save())
		{
			return redirect()->route('user-profile');
		}
		else
		{
			return redirect()->back()->with('error', 'Profile could not be updated due to an unexpected error.');
		}

	}

	public function getForgotPassword()
	{

		return view('forgot-password');
	}

	public function postForgotPassword(Request $request)
	{
		// Data Validations
		// -------------------------------------------------
		$inputs = [
			'email' => $request->email,
		];

		$rules = [
			'email' => 'required|email|max:255',
		];

		$validator = Validator::make($inputs, $rules);
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}
		// End - Data Validations

		$user = User::where('email', $request->email)->first();
		if(!$user)
		{
			return redirect()->back()->with('error', 'User not found.');
		}

		$code = $this->__generateRandomString("abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", 20);

		// Sends email to reset password with a link
		Mail::send('emails.forgot-password', ["user"=>$user, "code"=>$code] , function($message) use ($user){
            $message->from('promatics.kushalarora04@gmail.com', 'Stellar Winds');
            $message->to($user->email, $user->first_name)->subject('Forgot Password');
        });

        PasswordResetCode::where('user_id', $user->id)->forceDelete();
        $password_reset_code = new PasswordResetCode;
        $password_reset_code->user_id = $user->id;
        $password_reset_code->code = $code;
        $password_reset_code->created_at = date('Y-m-d H:i:s');
        $password_reset_code->updated_at = date('Y-m-d H:i:s');
        $password_reset_code->save();

        return redirect()->back()->with('success', 'We have sent you a link to reset your password. Please check your email.');
	}

	public function getResetPassword(Request $request)
	{
		if(!$request->email || !$request->code)
		{
			return redirect()->route('index')->with('error', 'An unexpected error occurred.');
		}

		$email = $request->email;
		$code  = $request->code;
		return view('forgot-password-confirm', compact('email', 'code'));
	}

	public function postResetPassword(Request $request)
	{
		if(!$request->email || !$request->code)
		{
			return redirect()->route('index')->with('error', 'An unexpected error occurred.');
		}

		$user = User::where('email', $request->email)->first();
		if(!$user)
		{
			return redirect()->route('index')->with('error', 'No user exists with email ' . $request->email);
		}

		// Data Validations
		$inputs = [
			'password' => $request->password,
			'confirm_password' => $request->confirmPassword
		];

		$rules = [
			'password' => 'required|min:6',
			'confirm_password' => 'required|same:password'
		];

		$validator = Validator::make($inputs, $rules);
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}
		// End - Data Validations

		$password_reset_code = PasswordResetCode::where('user_id', $user->id)->where('code', $request->code)->first();
		if(!$password_reset_code)
		{
			return redirect()->route('index')->with('error', 'An unexpected error occurred.');
		}

		if($password_reset_code->code !== $request->code)
		{
			return redirect()->route('index')->with('error', 'An unexpected error occurred.');
		}

		$user->Password= Hash::make($request->password);

		if($user->save())
		{
			$password_reset_code->delete();
			return redirect()->route('index');
		}
	}

}
