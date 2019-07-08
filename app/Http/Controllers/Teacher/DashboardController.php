<?php

namespace App\Http\Controllers\Teacher;

use App\User;
use App\Appointment;
use App\StudentDpt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {

    	$appointments = Appointment::all();

        $apps = DB::table('users')
            ->join('appointments', 'users.id', '=', 'appointments.tch_id')
            ->join('student_dpts', 'users.id', '=', 'student_dpts.std_id')
            ->join('departments', 'student_dpts.dpt_id', '=', 'departments.id')
            ->select('users.*','appointments.*','student_dpts.dpt_id','departments.name as dpt_name')
            ->get();

    	return view('teacher.dashboard', compact('appointments','apps'));
    }

    public function destroy($id)
    {
        $appointments = Appointment::find($id);

        $appointments->delete();
        return redirect('/teacher/dashboard')->with('success', 'Appointment Deleted!');
    }

   
}
