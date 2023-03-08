<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('citizen.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dept_categories = Category::get();
        return view('welcome', compact('dept_categories'));
    }

    public function getDistrict(){
        $district = District::where('division_id', request('divisionID'))->get();
        return $district;
    }

    public function getUpazila(){
        $upazila = Upazila::where('district_id', request('districtID'))->get();
        return $upazila;
    }
}
