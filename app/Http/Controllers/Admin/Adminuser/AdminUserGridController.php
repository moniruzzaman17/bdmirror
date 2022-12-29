<?php

namespace App\Http\Controllers\Admin\Adminuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminUserGridController extends Controller
{
    public function __construct()
    {
    	// check authenticated admin
        $this->middleware('admin.auth');
    }

    public function index()
    {
    	$adminusers = Admin::get();
        // dd($adminusers[0]->hasCustomRole->roleCustom->name);
        // dd($adminusers);
    	return view('admin.adminuser.adminusergrid',['adminusers'=>$adminusers]);
    }
}
