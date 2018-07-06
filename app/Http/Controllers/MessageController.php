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

        if($req['to'] == 0){

            $nearBy = User::search('')->aroundLatLng($user->cor_X, $user->cor_y)->get();

            foreach($nearBy as $u){
                broadcast(new messageSent($user, $u['id'], $message))->toOthers();
            }

        }else
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

        $reverse = new Mychats;
        $reverse['to'] = $user->id;
        $reverse['user_id'] = $req['to'];
        $reverse['name'] = $user->name;
        $reverse->save();
        

        return ['status' => 'New Chat Added!'];

    }

    public function Gchat(Request $req){

        $user = Auth::user();

        $nearBy = User::search('')->aroundLatLng($user->cor_X, $user->cor_Y)->get();

        $results = [];
        foreach($nearBy as $res){

            $res = message::where([
                ['from', $res['id']],
                ['to', 0]

            ])->get();
            if(count($res))
            array_push($results, $res);
        }


        return $results;

    }
}
