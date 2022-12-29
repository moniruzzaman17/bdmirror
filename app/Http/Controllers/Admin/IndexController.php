<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function __construct()
	{
    	// check authenticated admin
        $this->middleware('admin.auth');
	}

	public function index()
	{
    	return view('admin.index');
	}
}
