<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\Authority;
use App\Models\Complaint;
use App\Models\Help;
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

            $em_contacts = Help::where('citizen_id', $id)->get();

            return view('profile.profile', compact('citizen','mycomplaints','em_contacts'));
        }
        elseif (Auth::guard('authority')->check()) {
            $id = Auth::guard('authority')->user()->id;
            $authority = Authority::with('authorityDivision','authorityDistrict','authorityUpazila')->where('id',$id)->first();
            
            $mycomplaints = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision','complaintdistrict','complaintupazila')->orderBy('updated_at','DESC')->where('visibility', 1)->where('is_autopost', 0)->where('division', Auth::guard('authority')->user()->working_division)->where('district',Auth::guard('authority')->user()->working_district)->where('upazila',Auth::guard('authority')->user()->working_upazila)->get();

            return view('profile.profile', compact('authority','mycomplaints'));
        }
        else {
            return redirect()->route('home')->with('failed', 'Not Authorized');
        }
    }
    public function getHelpInfo(){
        $helpinfo = Help::where('id',request('helpID'))->first();
        return $helpinfo;
    }
    public function createORupdate(Request $request){
        // return $request->all();
        $help = Help::find(request('helpID'));
        if ($help) {
            $help->update([
                'email' => request('email'),
                'mobile' => request('mobile'),
                'relation' => request('relation')
            ]);
        }
        else{
            Help::create([
                'citizen_id' => request('citizen_id'),
                'email' => request('email'),
                'mobile' => request('mobile'),
                'relation' => request('relation')
            ]);
        }
        return redirect()->back();
    }
    
}
