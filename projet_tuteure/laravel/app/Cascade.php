<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cascade extends Model
{
    protected $fillable = ['id'];
    public function typeFinVie(){
        return $this->belongsTo('App\TypeFinVie'); //Une cascade appartient a un type de fin vie
    }

    public function typeGlace(){
        return $this->belongsTo('App\TypeGlace');
    }

    public function structure(){
        return $this->belongsTo('App\Structure');
    }

    public function supports(){
        return $this->belongsToMany('App\Support');
    }

    public function constituants(){
        return $this->belongsToMany('App\Constituant')->withPivot('poids');
    }

    public function zones(){
        return $this->belongsToMany('App\Zone');
    }

    public function commentaires(){
        return $this->hasMany('App\Commentaire');
    }
}


//quand il y a une table belongstomany