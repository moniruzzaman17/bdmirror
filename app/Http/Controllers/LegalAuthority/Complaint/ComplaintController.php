<?php

namespace App\Http\Controllers\LegalAuthority\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Comment;
use App\Models\ComplaintMedias;
use App\Models\Rating;
use App\Models\Status;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;


class ComplaintController extends Controller
{
    public function showList(){
        $complaints = Complaint::with('medias','comments','complaintstatus','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision', 'complaintdistrict','complaintupazila')->orderBy('id', 'DESC')->get();
        $statuses = Status::get();
        // dd($complaints[0]->complaintstatus->name);
        return view('legalauthority.complaint.list', compact('complaints','statuses'));
    }
    public function updateStatus(){
        Complaint::where('id',request('complaintID'))->update([
            "status" => request('statusID')
        ]);
        return true;
    }
}