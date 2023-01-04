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
        // if (Auth::guard('citizen')->check() == false && Auth::guard('authority')->check() == false) {
        //     return abort (401);
        // }
    }

    public function index($type, $id){
        if ($type == "authority") {
            $user = Authority::where('id', $id)->first();
            if (empty($user)) {
                return redirect()->route('home');
            }
            $sender_id = Auth::guard('citizen')->user()->id;
            $messages = Message::where(function($q) use ($id, $sender_id){
                            $q->where('sender_type', 'citizen')
                            ->where('receiver_type', 'authority')
                            ->where('sender_id', $sender_id)
                            ->where('receiver_id', $id)
                            ->orWhere('sender_type','authority')
                            ->where('receiver_type','citizen')
                            ->where('sender_id',$id)
                            ->where('receiver_id',$sender_id);
                        })->get();
            if (empty($messages)) {
                return redirect()->route('home');
            }
            else{
                return view('message.message', compact('user','messages'));
            }
        }
        elseif ($type == "citizen") {
            $user = Citizen::where('id', $id)->first();
            $sender_id = Auth::guard('authority')->user()->id;
            $messages = Message::where(function($q) use ($id, $sender_id){
                             $q->where('sender_type', 'authority')
                            ->where('receiver_type', 'citizen')
                            ->where('sender_id', $sender_id)
                            ->where('receiver_id', $id)
                            ->orWhere('sender_type','citizen')
                            ->where('receiver_type','authority')
                            ->where('sender_id',$id)
                            ->where('receiver_id',$sender_id);
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
                            ->orWhere('sender_type','citizen')
                            ->where('receiver_type','authority')
                            ->where('sender_id',$receiver_id)
                            ->where('receiver_id',$sender_id);
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
                            ->orWhere('sender_type','authority')
                            ->where('receiver_type','citizen')
                            ->where('sender_id',$receiver_id)
                            ->where('receiver_id',$sender_id);
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
                            ->orWhere('sender_type','citizen')
                            ->where('receiver_type','authority')
                            ->where('sender_id',$receiver_id)
                            ->where('receiver_id',$sender_id);
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
                            ->orWhere('sender_type','authority')
                            ->where('receiver_type','citizen')
                            ->where('sender_id',$receiver_id)
                            ->where('receiver_id',$sender_id);
                        })->get();
            return view('message.messagebody', compact('messages'));
        }
    }

    public function viewMessageNotification(){
        if (Auth::guard('citizen')->check()) {
            $id = Auth::guard('citizen')->user()->id;
            $msgNotifications = Message::distinct()->select('sender_id','sender_type')->where('receiver_id', $id)->where('receiver_type','citizen')->orderBy('id', 'DESC')->get();
            $senders = array();
            $sentMessages = array();
            $i = 0;
            $j = 0;
            foreach ($msgNotifications as $key => $msgNotification) {
                $senders[$i++] = Authority::select('name','id')->where('id',$msgNotification->sender_id)->first();

                $sentMessages[$j++] = Message::where('sender_id', $msgNotification->sender_id)->where('receiver_id', $id)->where('sender_type', 'authority')->where('receiver_id', $id)->where('receiver_type','citizen')->orderBy('id', 'DESC')->first();
            }
            $totalmsg =  count($msgNotifications);
            return view('includes.chat', compact('senders','sentMessages','totalmsg'));
        }
        if (Auth::guard('authority')->check()) {
            $id = Auth::guard('authority')->user()->id;
            $msgNotifications = Message::distinct()->select('sender_id','sender_type')->where('receiver_id', $id)->where('receiver_type','authority')->orderBy('id', 'DESC')->get();
            $senders = array();
            $sentMessages = array();
            $i = 0;
            $j = 0;
            foreach ($msgNotifications as $key => $msgNotification) {
                $senders[$i++] = Citizen::select('id','name')->where('id', $msgNotification->sender_id)->first();

                $sentMessages[$j++] = Message::where('sender_id', $msgNotification->sender_id)->where('receiver_id', $id)->where('sender_type', 'citizen')->where('receiver_id', $id)->where('receiver_type','authority')->orderBy('id', 'DESC')->first();
            }
            
            $totalmsg =  count($msgNotifications);
            return view('includes.chat', compact('senders','sentMessages','totalmsg'));
        }
    }
}
