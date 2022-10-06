<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    // public function collection_track()
    // {
    //     return $this->hasMany("App\Content", 'id_collection');
    // }
    public function tracks()
    {
        return $this->belongsToMany('App\Track', 'collection_track');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'id_utente');
    }
}
