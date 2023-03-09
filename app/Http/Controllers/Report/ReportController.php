<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;

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
        
        return view('report.reprot',compact('complaint'));
    }
}
