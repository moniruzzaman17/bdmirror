<?php

namespace App\Http\Controllers\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Comment;
use App\Models\ComplaintMedias;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;

class ComplaintController extends Controller
{
    public function createComplaint(Request $request){
        $validatedData = $request->validate([
            'complaint' => 'required',
            'image' => 'nullable',
            'video' => 'nullable',
            'document' => 'nullable',
            'is_anonymous' => 'nullable',
            'complaint_schedule' => 'nullable'
        ]);
        if (empty(request('is_anonymous'))) {
            if (empty(request('complaint_schedule'))) {
                $complaint = Complaint::create([
                    'citizen_id' => Auth::guard('citizen')->user()->id,
                    'is_anonymous' => request('is_anonymous'),
                    'details' => request('complaint'),
                    'division' => Auth::guard('citizen')->user()->division,
                    'district' => Auth::guard('citizen')->user()->district,
                    'upazila' => Auth::guard('citizen')->user()->upazila,
                    'is_anonymous' => 0
                ]);
            }
            else{
                $complaint = Complaint::create([
                    'citizen_id' => Auth::guard('citizen')->user()->id,
                    'is_anonymous' => request('is_anonymous'),
                    'details' => request('complaint'),
                    'division' => Auth::guard('citizen')->user()->division,
                    'district' => Auth::guard('citizen')->user()->district,
                    'upazila' => Auth::guard('citizen')->user()->upazila,
                    'is_anonymous' => 0,
                    'is_published' => 0,
                    'publish_datetime' => request('complaint_schedule')
                ]);
            }
        }
        else{
            if (empty(request('complaint_schedule'))) {
                $complaint = Complaint::create([
                    'citizen_id' => Auth::guard('citizen')->user()->id,
                    'is_anonymous' => request('is_anonymous'),
                    'details' => request('complaint'),
                    'division' => Auth::guard('citizen')->user()->division,
                    'district' => Auth::guard('citizen')->user()->district,
                    'upazila' => Auth::guard('citizen')->user()->upazila,
                    'is_anonymous' => 1
                ]);
            }
            else{
                $complaint = Complaint::create([
                    'citizen_id' => Auth::guard('citizen')->user()->id,
                    'is_anonymous' => request('is_anonymous'),
                    'details' => request('complaint'),
                    'division' => Auth::guard('citizen')->user()->division,
                    'district' => Auth::guard('citizen')->user()->district,
                    'upazila' => Auth::guard('citizen')->user()->upazila,
                    'is_anonymous' => 1,
                    'is_published' => 0,
                    'publish_datetime' => request('complaint_schedule')
                ]);
            }
        }
        $complaint_id = $complaint->id;

        if($request->hasFile('image')){
            foreach ($request->file('image') as $key => $image) {
                $image_name=explode('.',$image->getClientOriginalName())[0];
                $new_image_name = Carbon::now('Asia/Dhaka')->format('YmdHu').'.' .$image->getClientOriginalExtension();
                $media = ComplaintMedias::create([
                    'complaint_id' => $complaint_id,
                    'type' => 'image',
                    'medias' => $new_image_name,
                ]);
                if ($media) {
                    $image->move(public_path('/medias/images'), $new_image_name);
                }
            }
        }

        if($request->hasFile('video')){
            foreach ($request->file('video') as $key => $video) {
                $video_name=explode('.',$video->getClientOriginalName())[0];
                $new_video_name = Carbon::now('Asia/Dhaka')->format('YmdHu').'.' .$video->getClientOriginalExtension();
                $media = ComplaintMedias::create([
                    'complaint_id' => $complaint_id,
                    'type' => 'video',
                    'medias' => $new_video_name,
                ]);
                if ($media) {
                    $video->move(public_path('/medias/videos'), $new_video_name);
                }
            }
        }
        if($request->hasFile('document')){
            foreach ($request->file('document') as $key => $document) {
                $document_name=explode('.',$document->getClientOriginalName())[0];
                $new_document_name = Carbon::now('Asia/Dhaka')->format('YmdHu').'.' .$document->getClientOriginalExtension();
                $media = ComplaintMedias::create([
                    'complaint_id' => $complaint_id,
                    'type' => 'document',
                    'medias' => $new_document_name,
                ]);
                if ($media) {
                    $document->move(public_path('/medias/documents'), $new_document_name);
                }
            }
        }
        return redirect()->back();
    }

    public function like(){
        $complaint_id = request('complaint_id');
        $logged_citizen_id = request('citizen_id');
            $rated = Rating::where('complaint_id', $complaint_id)->where('citizen_id', $logged_citizen_id)->count();
            if ($rated > 0) {
                Rating::where('complaint_id', $complaint_id)->where('citizen_id', $logged_citizen_id)->delete();
            }
            else{
                Rating::create([
                    'complaint_id' => $complaint_id,
                    'citizen_id' => $logged_citizen_id,
                    'like' => 1,
                ]);
            }
            
        $complaint = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings')->where('id', $complaint_id)->first();
        return view('home.likeNcomment', compact('complaint'));
        // return $complaint_id." workign ".$logged_citizen_id;
    }

    public function addComment(){
        Comment::create([
            'complaint_id' => request('complaint_id'),
            'citizen_id' => request('citizen_id'),
            'details' => request('commentText')
        ]);
        $complaint = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings')->where('id', request('complaint_id'))->first();
        return view('home.comment', compact('complaint'));
        // return "working";
    }

    public function deleteComment(){
        Comment::where('id',request('comment_id'))->delete();
        $complaint = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings')->where('id', request('complaint_id'))->first();
        return view('home.comment', compact('complaint'));
    }

    public function publishComplaint(){
        $updated = Complaint::where('id', request('complaint_id'))->update([
            'is_published' => 1
        ]);
        return $updated;
    }
    public function hideComplaint(){
        $updated = Complaint::where('id', request('complaint_id'))->update([
            'is_published' => 0
        ]);
        return $updated;
    }
    public function complaintDetails($id){
        $singlecomplaints = Complaint::with('medias','comments','complaintstatus','comments.citizen','ratings','citizen','citizen.ratings')->where('id', $id)->limit(1)->get();
        // dd($singlecomplaints);
        return view('complaint.individualcomplaint', compact('singlecomplaints'));
    }
}
