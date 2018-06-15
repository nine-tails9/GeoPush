<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\message;
use Auth;
use App\User;
use App\messages;
use App\Mychats;
use App\Events\messageSent;
class MessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('my-chats');
    }

    public function chat(Request $req){

        $user = Auth::user();
        
        $data = message::where([
            ['from', $user->id],
            ['to', $req['with']]
        ])->orWhere([
            ['to', $user->id],
            ['from', $req['with']]
        ])->
        get();
        
        return $data;
    }

    public function sendMessage(Request $req)
    {
        # code...
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $req['message'],
            'to' => $req['to']
        ]);
        broadcast(new messageSent($user, $req['to'], $message))->toOthers();
        return ['status' => 'Message Sent!'];

    }

    public function newChat(Request $req){

        $user = Auth::user();
        $data = $user->mychats()->where('to', $req['to'])->get();

        if($data->count())return;
        $chat = $user->mychats()->create([
            'to' => $req['to'],
            'name' => $req['name']
        ]);

        return ['status' => 'New Chat Added!'];

    }
}
