<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constituant extends Model
{
    public function cascades(){
        return $this->belongsToMany('App\Cascade');
    }
}
