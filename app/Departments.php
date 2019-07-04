<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{

    public function std_dpt() {

    	return $this->hasMany('App\StudentDpt');
    }

    public function tch_dpt() {

    	return $this->hasMany('App\TeacherDpt');
    }
}
