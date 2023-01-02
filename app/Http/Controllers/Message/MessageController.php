<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Authority;
use App\Models\Citizen;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index($type, $id){
        if ($type == "authority") {
            $user = Authority::where('id', $id)->first();
            $sender_id = Auth::guard('citizen')->user()->id;
            $messages = Message::where(function($q) use ($id, $sender_id){
                            $q->where('sender_type', 'citizen')
                            ->where('receiver_type', 'authority')
                            ->where('sender_id', $sender_id)
                            ->where('receiver_id', $id)
                            ->where('sender_type','authority')
                            ->orWhere('receiver_type','citizen')
                            ->orWhere('sender_id',$id)
                            ->orWhere('receiver_id',$sender_id);
                        })->get();
            return view('message.message', compact('user','messages'));
        }
        elseif ($type == "citizen") {
            $user = Citizen::where('id', $id)->first();
            $sender_id = Auth::guard('authority')->user()->id;
            $messages = Message::where(function($q) use ($id, $sender_id){
                             $q->where('sender_type', 'authority')
                            ->where('receiver_type', 'citizen')
                            ->where('sender_id', $sender_id)
                            ->where('receiver_id', $id)
                            ->where('sender_type','citizen')
                            ->orWhere('receiver_type','authority')
                            ->orWhere('sender_id',$id)
                            ->orWhere('receiver_id',$sender_id);
                        })->get();
            return view('message.message', compact('user','messages'));
        }
        else {
            return abort(404);
        }
    }

    public function sendMessage(Request $request){
        // return request("user_type");
        // return  $request->user_type;
        // return request('sender_id');
        if (request('user_type') == "authority") {
            Message::create([
                'sender_type' => 'authority',
                'receiver_type' => 'citizen',
                'sender_id' => request('sender_id'),
                'receiver_id' => request('receiver_id'),
                'message' => request('message'),
                'media' => ""
            ]);
            $receiver_id = request('receiver_id');
            $sender_id = request('sender_id');
            $messages = Message::where(function($q) use ($receiver_id, $sender_id){
                            $q->where('sender_type', 'authority')
                            ->where('receiver_type', 'citizen')
                            ->where('sender_id', $sender_id)
                            ->where('receiver_id', $receiver_id)
                            ->where('sender_type','citizen')
                            ->orWhere('receiver_type','authority')
                            ->orWhere('sender_id',$receiver_id)
                            ->orWhere('receiver_id',$sender_id);
                        })->get();
            return view('message.messagebody', compact('messages'));
        }
        else{
            Message::create([
                'sender_type' => 'citizen',
                'receiver_type' => 'authority',
                'sender_id' => request('sender_id'),
                'receiver_id' => request('receiver_id'),
                'message' => request('message'),
                'media' => ""
            ]);
            $receiver_id = request('receiver_id');
            $sender_id = request('sender_id');
            $messages = Message::where(function($q) use ($receiver_id, $sender_id){
                             $q->where('sender_type', 'citizen')
                            ->where('receiver_type', 'authority')
                            ->where('sender_id', $sender_id)
                            ->where('receiver_id', $receiver_id)
                            ->where('sender_type','authority')
                            ->orWhere('receiver_type','citizen')
                            ->orWhere('sender_id',$receiver_id)
                            ->orWhere('receiver_id',$sender_id);
                        })->get();
            return view('message.messagebody', compact('messages'));
        }
    }
    
    public function viewMessage(Request $request){
        if (request('user_type') == "authority") {
            $receiver_id = request('receiver_id');
            $sender_id = request('sender_id');
            $messages = Message::where(function($q) use ($receiver_id, $sender_id){
                            $q->where('sender_type', 'authority')
                            ->where('receiver_type', 'citizen')
                            ->where('sender_id', $sender_id)
                            ->where('receiver_id', $receiver_id)
                            ->where('sender_type','citizen')
                            ->orWhere('receiver_type','authority')
                            ->orWhere('sender_id',$receiver_id)
                            ->orWhere('receiver_id',$sender_id);
                        })->get();
            return view('message.messagebody', compact('messages'));
        }
        else{
            $receiver_id = request('receiver_id');
            $sender_id = request('sender_id');
            $messages = Message::where(function($q) use ($receiver_id, $sender_id){
                             $q->where('sender_type', 'citizen')
                            ->where('receiver_type', 'authority')
                            ->where('sender_id', $sender_id)
                            ->where('receiver_id', $receiver_id)
                            ->where('sender_type','authority')
                            ->orWhere('receiver_type','citizen')
                            ->orWhere('sender_id',$receiver_id)
                            ->orWhere('receiver_id',$sender_id);
                        })->get();
            return view('message.messagebody', compact('messages'));
        }
    }
}
