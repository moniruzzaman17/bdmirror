<?php

namespace App\Http\Controllers\Admin\Adminuser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class AdminUserController extends Controller
{
	public function __construct()
	{
    	// check authenticated admin
		$this->middleware('admin.auth');
	}

	public function index()
	{
		$user = Admin::where('id', request('user_id'))->first();
		$userCount = Admin::count();

		return view('admin.adminuser.adminuserdetails',compact('user','userCount'));
	}

	public function deleteUser()
	{
		$user=Admin::find(request('user_id'));
		if($user->delete()){
			return redirect()->route('admin.user.grid')->with('success', 'User has been removed');
		}
	}

	public function updateUser(Request $request){

    	// Validation
		$Messages = [
			'userName.required' => 'User full name is required',

			'userEmail.required' => 'User email is required',
			'userEmail.unique' => 'Admin user with requested email already exist',

			'currentUserPass.required' => 'Current logged user password is required',
		];

		$validatedData = $request->validate([
			'userName' => 'required|string',
			'userEmail' => 'required|email|unique:admins,email,'.request('user_id').',id',
			'userPass' => 'nullable',
			'currentUserPass' => 'required',
		],$Messages);
        // orders
		$currentUserRegisteredPass = Admin::select('password')->where('id',Auth::guard('admin')->user()->id)->first()->password;
		$adminUser = Admin::find(request('user_id'));

		if (Hash::check(request('currentUserPass'), $currentUserRegisteredPass)) {
			if (!empty(request('userPass'))) {
				$adminUsersUpdated  =   $adminUser->update([
					'name'            => request('userName'),
					'email'            => request('userEmail'),
					'password'   => Hash::make(request('userPass')),
				]);
			}
			else{
				$adminUsersUpdated  =   $adminUser->update([
					'name'            => request('userName'),
					'email'            => request('userEmail'),
				]);
			}

			if ($adminUsersUpdated) {

				return redirect()->back()->with('success','Admin user successfully updated');
			}
			else {
				return redirect()->back()->with('failed','Something went Wrong! Not Saved');
			}
		}
		else {
			return redirect()->back()->with('failed','Current logged user password not matched with the records ! Not Updated');
		}
	}
}
