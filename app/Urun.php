<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urun extends Model
{	
	protected $table = 'urun';

    public function depo() {

    	return $this->belongsTo('App\Depo');
    }
}
