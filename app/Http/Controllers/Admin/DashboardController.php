<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Departments;
use App\Appointment;
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

        $appointments = Appointment::all();

        $c = User::select('role_id', DB::raw('count(*) as count'))->groupBy('role_id')->orderBy('role_id','asc')->get();

        $a = Appointment::select('status', DB::raw('count(*) as count'))->groupBy('status')->orderBy('status','asc')->get();
       
    	return view('admin.dashboard', compact('users','departments','c','appointments','a'));
    }

    public function destroy($id)
    {
        $users = User::find($id);

        $users->delete();
        return redirect('/admin/dashboard')->with('success', 'User Deleted!');
    }
}
