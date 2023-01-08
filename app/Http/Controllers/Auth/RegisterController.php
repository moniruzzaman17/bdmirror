<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Citizen;
use App\Models\Authority;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        if (request('user_type') == "ctz") {
            $msg = [
                'name.regex' => 'For full name only alphabet, white-space and dot are allowed',
                'email.email' => 'Invalid email address',
                'email.unique' => 'This email associated with another account',

                'mobile.regex' => 'Mobile number must start with 01 and followed by the 9 number',
                'mobile.unique' => 'This mobile number already exist for another account',
            ];
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255','regex:/[a-zA-Z|.]+(\s|[a-zA-Z|.]+)+$/'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:citizens,email'],
                'mobile' => ['required', 'regex:/(01)[0-9]{9}/', 'unique:citizens,mobile'],
                'division' => ['required'],
                'district' => ['required'],
                'upazila' => ['required'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ],$msg);
        }
        else{
            $msg = [
                'name.regex' => 'For full name only alphabet, white-space and dot are allowed',
                'email.email' => 'Invalid email address',
                'email.unique' => 'This email associated with another account',

                'mobile.regex' => 'Mobile number must start with 01 and followed by the 9 number',
                'mobile.unique' => 'This mobile number already exist for another account',
            ];
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255','regex:/[a-zA-Z|.]+(\s|[a-zA-Z|.]+)+$/'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:authorities,email'],
                'mobile' => ['required', 'regex:/(01)[0-9]{9}/', 'unique:authorities,mobile'],
                'division' => ['required'],
                'district' => ['required'],
                'upazila' => ['required'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ],$msg);
        }
        
        if (request('user_type') == "ctz") {
        $success =  Citizen::create([
            'name' => request('name'),
            'email' => request('email'),
            'mobile' => request('mobile'),
            'division' => request('division'),
            'district' => request('district'),
            'upazila' => request('upazila'),
            'password' => Hash::make(request('password')),
        ]);
        }
        else{
        $success =  Authority::create([
            'name' => request('name'),
            'email' => request('email'),
            'mobile' => request('mobile'),
            'working_division' => request('division'),
            'working_district' => request('district'),
            'working_upazila' => request('upazila'),
            'password' => Hash::make(request('password')),
        ]);
        }
	        if ($success) {
	        	return redirect()->back()->with('success','Successfully Registered');
	        }
	        else {
	        	return redirect()->back()->with('error','Something went Wrong! Not Saved');
	        }
    }
}
