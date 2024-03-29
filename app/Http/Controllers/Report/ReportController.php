<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use PDF;
use App\Models\Comment;
use App\Models\ComplaintMedias;
use App\Models\Rating;
use App\Models\Status;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;

class ReportController extends Controller
{
    public function getCategoryReport(){
        $complaint = array();
        $total = Complaint::get()->count();
        // 1 Road
        // 2 Bridge
        // 3 Transport
        // 4 Water Supply
        // 5 Electricity Supply
        // 6 Waste Management
        // 7 Human Rights
        // 8 Law Enforcement
        // 9 Public Health
        // 10 Municipal Administration
        // 11 Social Welfare
        // 12 Economic Development
        $complaint['road']          = (Complaint::where('category_id', 1)->get()->count()*100)/$total;
        $complaint['bridge']        = (Complaint::where('category_id', 2)->get()->count()*100)/$total;
        $complaint['transport']     = (Complaint::where('category_id', 3)->get()->count()*100)/$total;
        $complaint['water']         = (Complaint::where('category_id', 4)->get()->count()*100)/$total;
        $complaint['electricity']   = (Complaint::where('category_id', 5)->get()->count()*100)/$total;
        $complaint['waste']         = (Complaint::where('category_id', 6)->get()->count()*100)/$total;
        $complaint['human']         = (Complaint::where('category_id', 7)->get()->count()*100)/$total;
        $complaint['law']           = (Complaint::where('category_id', 8)->get()->count()*100)/$total;
        $complaint['health']        = (Complaint::where('category_id', 9)->get()->count()*100)/$total;
        $complaint['municipal']     = (Complaint::where('category_id', 10)->get()->count()*100)/$total;
        $complaint['social']        = (Complaint::where('category_id', 11)->get()->count()*100)/$total;
        $complaint['economic']      = (Complaint::where('category_id', 12)->get()->count()*100)/$total;
        $complaint['total']         = $total;
        // 1 Open
        // 2 In Progress
        // 3 On Hold
        // 4 Resolved
        // 5 Closed 
        // 6 Reopened
        $status = array();

        $status['open']         = Complaint::where('status', 1)->get()->count();
        $status['progress']     = Complaint::where('status', 2)->get()->count();
        $status['hold']         = Complaint::where('status', 3)->get()->count();
        $status['resolved']     = Complaint::where('status', 4)->get()->count();
        $status['closed']       = Complaint::where('status', 5)->get()->count();
        $status['reopened']     = Complaint::where('status', 6)->get()->count();

        return view('report.report',compact('complaint','status'));
    }

    public function getPdfReport(){
        
        $catID = Auth::guard('authority')->user()->dept_category;
        $districtID = Auth::guard('authority')->user()->district;
        $complaints = Complaint::with('medias','comments','complaintstatus','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision', 'complaintdistrict','complaintupazila')->where('category_id', $catID)->orderBy('id', 'DESC')->get();
        $statuses = Status::get();

        $pdf = PDF::loadView('legalauthority.complaint.list', compact('complaints','statuses'));

        return $pdf->download('sample1.pdf');
    }
}
