<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
class Mychats extends Model
{
    //
    public $fillable = ['to', 'name'];
    public function user(){

        return $this->belongsTo(User::Class);
    }


}
