<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depo extends Model
{
    protected $table='depo';

    public function sirket() {

    	return $this->belongsTo('App\Sirket');
    }

    public function urun() {

    	return $this->hasMany('App\Urun');
    }
}
