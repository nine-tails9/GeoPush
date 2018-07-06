<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Events\areaMessage;
use Auth;
class AppSearchController extends Controller
{
    //


    public function nearBy(){

        $error = ['error' => 'No Results Found'];
        $user = Auth::user();
        $lat = $user->cor_X;
        $lng = $user->cor_Y;
        $users = User::search('')->aroundLatLng($lat, $lng)->get();
        return $users;
    }

    public function SendareaMessage(Request $req){

        $users = $this->nearBy();
        $user = Auth::user();
        $message = $req['message'];
        foreach($users as $u){
            broadcast(new areaMessage($user, $u['id'], $message));
        }
        
        return $users;

    }

}
