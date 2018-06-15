<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class message extends Model
{
    //
    protected $fillable = [
        'message', 'to', 'from',
    ];
    public function user(){

        return $this->belongsTo(User::Class, 'from');
    }
}
