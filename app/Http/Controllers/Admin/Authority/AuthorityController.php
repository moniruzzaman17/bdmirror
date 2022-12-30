<?php

namespace App\Http\Controllers\Admin\Authority;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authority;

class AuthorityController extends Controller
{
    public function __construct()
    {
    	// check authenticated admin
        $this->middleware('admin.auth');
    }

    public function index()
    {
    	$authorities = Authority::get();
        // dd($authorities[0]->hasCustomRole->roleCustom->name);
        // dd($authorities);
    	return view('admin.authority.authoritygrid',['authorities'=>$authorities]);
    }
	public function details()
	{
		$authority = Authority::where('id', request('user_id'))->first();
		$authorityCount = Authority::count();

		return view('admin.authority.details',compact('authority','authorityCount'));
	}

	public function deleteUser()
	{
		$user=Authority::find(request('user_id'));
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
		// $currentUserRegisteredPass = Admin::select('password')->where('id',Auth::guard('admin')->user()->id)->first()->password;
		// $adminUser = Admin::find(request('user_id'));

		// if (Hash::check(request('currentUserPass'), $currentUserRegisteredPass)) {
		// 	if (!empty(request('userPass'))) {
		// 		$adminUsersUpdated  =   $adminUser->update([
		// 			'name'            => request('userName'),
		// 			'email'            => request('userEmail'),
		// 			'password'   => Hash::make(request('userPass')),
		// 		]);
		// 	}
		// 	else{
		// 		$adminUsersUpdated  =   $adminUser->update([
		// 			'name'            => request('userName'),
		// 			'email'            => request('userEmail'),
		// 		]);
		// 	}

		// 	if ($adminUsersUpdated) {

		// 		return redirect()->back()->with('success','Admin user successfully updated');
		// 	}
		// 	else {
		// 		return redirect()->back()->with('failed','Something went Wrong! Not Saved');
		// 	}
		// }
		// else {
		// 	return redirect()->back()->with('failed','Current logged user password not matched with the records ! Not Updated');
		// }
	}
    public function approveUser(){
		$authority = Authority::where('id', request('user_id'))->update([
            'is_approved' => 1
        ]);
        if ($authority) {
            return redirect()->back()->with('success','Legal authority has been approved!');
        }
    }
    public function refuseUser(){
		$authority = Authority::where('id', request('user_id'))->update([
            'is_approved' => 0
        ]);
        if ($authority) {
            return redirect()->back()->with('success','Approval has been removed');
        }
    }
}
