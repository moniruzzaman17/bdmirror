<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Category;
use App\Models\Complaint;

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

    public function filter(){
        if(!empty(request('div')) && empty(request('dis')) && empty(request('upa'))){
            $filtercomplaint = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision','complaintdistrict','complaintupazila')->where('division', request('div'))->where('visibility', 1)->where('is_autopost', 0)->where('is_published', 1)->orderBy('updated_at','DESC')->get();
        }
        elseif(!empty(request('div')) && !empty(request('dis')) && empty(request('upa'))){
            $filtercomplaint = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision','complaintdistrict','complaintupazila')->where('division', request('div'))->where('district', request('dis'))->where('visibility', 1)->where('is_autopost', 0)->where('is_published', 1)->orderBy('updated_at','DESC')->get();
        }
        else{
            $filtercomplaint = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision','complaintdistrict','complaintupazila')->where('division', request('div'))->where('district', request('dis'))->where('upazila', request('upa'))->where('visibility', 1)->where('is_autopost', 0)->where('is_published', 1)->orderBy('updated_at','DESC')->get();
        }
        return view('home.filter.filter', compact('filtercomplaint'));
        // dd(request()->all());
    }
}
