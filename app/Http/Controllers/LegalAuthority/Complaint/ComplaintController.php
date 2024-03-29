<?php

namespace App\Http\Controllers\LegalAuthority\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Comment;
use App\Models\ComplaintMedias;
use App\Models\Rating;
use App\Models\Status;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;


class ComplaintController extends Controller
{
    public function showList(){
        $catID = Auth::guard('authority')->user()->dept_category;
        $districtID = Auth::guard('authority')->user()->working_district;
        $complaints = Complaint::with('medias','comments','complaintstatus','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision', 'complaintdistrict','complaintupazila')->where('visibility', 1)->where('is_autopost', 0)->where('category_id', $catID)->where('district', $districtID)->orderBy('id', 'DESC')->get();
        $statuses = Status::get();
        // dd($complaints[0]->complaintstatus->name);
        return view('legalauthority.complaint.list', compact('complaints','statuses'));
    }
    public function updateStatus(){
        Complaint::where('id',request('complaintID'))->update([
            "status" => request('statusID')
        ]);
        $citizenID = Complaint::where('id',request('complaintID'))->first()->citizen_id;
        $status = Status::where('id', request('statusID'))->first()->name;
        $message = 'Your complaint status has been changed to "'.$status.'"';
        Notification::create([
            'citizen_id' => $citizenID,
            'message' => $message,
            'url' => '/complaint/id/'.request('complaintID')
        ]);
        return true;
    }
}
