<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class AppSearchController extends Controller
{
    //


    public function Search(Request $req){


        $error = ['error' => 'No Results Found'];

        $lat = 0;
        $lng = 0;
        $users = User::search('')->aroundLatLng($lat, $lng)->get();
        return $users;
    }
}
