<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
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
        // $this->middleware(['citizen.auth','authority.auth']);
    }

    public function index($type, $id){
        if ($type == "authority") {
            $user = Authority::where('id', $id)->first();
            $messages = Message::where('sender_type', 'authority')->where('receiver_type', 'citizen')->where('receiver_id', $id)->get();
            return view('message.message', compact('user','messages'));
        }
        elseif ($type == "citizen") {
            $user = Citizen::where('id', $id)->first();
            $messages = Message::where('sender_type', 'citizen')->where('receiver_type', 'authority')->where('receiver_id', $id)->get();
            return view('message.message', compact('user','messages'));
        }
        else {
            return abort(404);
        }
    }

    public function sendMessage(){
        if (request('utype') == "authority") {
            $messages = Message::where('sender_type', 'authority')->where('receiver_type', 'authority')->where('id', $id)->get();
            Message::create([
                'sender_type' => 'authority',
                'receiver_type' => 'citizen',
                'sender_id' => 'sender_id',
                'receiver_id' => 'receiver_id',
                'message' => 'message'
            ]);
            return view('message.messagebody', compact('message'));
        }
        else{
            Message::create([
                'sender_type' => 'citizen',
                'receiver_type' => 'authority',
                'sender_id' => 'sender_id',
                'receiver_id' => 'receiver_id',
                'message' => 'message'
            ]);
        }
    }
}
