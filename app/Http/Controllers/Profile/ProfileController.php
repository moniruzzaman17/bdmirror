<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\Authority;
use App\Models\Complaint;
use Auth;

class ProfileController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('citizen')->check()) {
            $id = Auth::guard('citizen')->user()->id;
            $citizen = Citizen::with('complaints','citizenDivision','citizenDistrict','citizenUpazila')->where('id',$id)->first();
            
            $mycomplaints = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision','complaintdistrict','complaintupazila')->orderBy('updated_at','DESC')->where('citizen_id',$id)->get();
            return view('profile.profile', compact('citizen','mycomplaints'));
        }
        if (Auth::guard('authority')->check()) {
            $id = Auth::guard('authority')->user()->id;
            $authority = Authority::with('authorityDivision','authorityDistrict','authorityUpazila')->where('id',$id)->first();
            
            $mycomplaints = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision','complaintdistrict','complaintupazila')->orderBy('updated_at','DESC')->where('division', Auth::guard('authority')->user()->working_division)->where('district',Auth::guard('authority')->user()->working_district)->where('upazila',Auth::guard('authority')->user()->working_upazila)->get();

            return view('profile.profile', compact('authority','mycomplaints'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
