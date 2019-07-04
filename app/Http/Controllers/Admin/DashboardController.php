<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Departments;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {

    	$users = DB::table('users')
            ->join('student_dpts', 'users.id', '=', 'student_dpts.std_id')
            ->join('departments', 'student_dpts.dpt_id', '=', 'departments.id')
            ->select('users.*','departments.name as dpt_name')
            ->get();
        $departments = Departments::all();

       
    	return view('admin.dashboard', compact('users','departments'));
    }
}
