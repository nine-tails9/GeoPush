<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\message;
use App\Mychats;
class User extends Authenticatable
{
    use Notifiable;
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id',  'cor_X', 'cor_Y'
       ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function toSearchableArray()
    {
        $record = $this->toArray();

        $record['_geoloc'] = [
            'lat' => $record['cor_X'],
            'lng' => $record['cor_Y'],
        ];

        unset($record['created_at'], $record['updated_at']); // Remove unrelevant data
        unset($record['cor_Y'], $record['cor_X']);

        return $record;
    }
    public function messages(){

        return  $this->hasMany(message::Class, 'from');
    }
    
    public function mychats(){

        return $this->hasMany(Mychats::Class);
    }

}
