<?php

namespace App\Http\Controllers\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\ComplaintMedias;
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
            'is_anonymous' => 'nullable'
        ]);
        
        if (empty(request('is_anonymous'))) {
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
                'is_anonymous' => 1
            ]);
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
}
