<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    //
    public function collections()
    {
        return $this->belongsToMany('App\Collection', 'collection_track'); //Secondo parametro è il nome della tabella, da mettere per evitare quello di default
    }
    
}
