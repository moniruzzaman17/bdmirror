<?php

namespace App\Http\Controllers\Admin\Adminuser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
class NewUserController extends Controller
{
    public function __construct()
    {
    	// check authenticated admin
        $this->middleware('admin.auth');
    }

    public function index()
    {
    	return view('admin.adminuser.newuser');
    }

    public function store(Request $request)
    {
    	// Validation
    	$Messages = [
    		'newuserName.required' => 'New User full name is required',

    		'newuserEmail.required' => 'New User email is required',
    		'newuserEmail.unique' => 'Admin user with requested email already exist',

    		'newuserPass.required' => 'New User password is required',

    		'currentUserPass.required' => 'Current logged user password is required',
    	];

    	$validatedData = $request->validate([
    		'newuserName' => 'required|string',
	        'newuserEmail' => 'required|email|unique:admins,email',
	        'newuserPass' => 'required',
	        'currentUserPass' => 'required',
	    ],$Messages);
        // orders
        $currentUserRegisteredPass = Admin::select('password')->where('id',Auth::guard('admin')->user()->id)->first()->password;
        if (Hash::check(request('currentUserPass'), $currentUserRegisteredPass)) {
	        $adminUsersAdded  =   Admin::create([
			                        'name'            => request('newuserName'),
			                        'email'            => request('newuserEmail'),
			                        'password'   => Hash::make(request('newuserPass')),
			                    ]);

	        if ($adminUsersAdded) {
	        	return redirect()->back()->with('success','Admin user successfully added');
	        }
	        else {
	        	return redirect()->back()->with('error','Something went Wrong! Not Saved');
	        }
	    }
	    else {
	        	return redirect()->back()->with("error','Current logged user's password not matched with the records ! Not Saved");
	    }

    }
}
