<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function commentaire(){
        return $this->belongsTo('App\Commentaire');
    }
}
