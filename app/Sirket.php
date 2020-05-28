<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sirket extends Model
{
    protected $table='sirket';

    public function calisan() 
    {
    	return $this->hasMany('App\User');
    }

    public function depo() {

    	return $this->hasMany('App\Depo');
    }
}
