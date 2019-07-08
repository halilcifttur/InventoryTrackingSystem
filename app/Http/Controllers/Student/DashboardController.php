<?php

namespace App\Http\Controllers\Student;


use App\User;
use App\StudentDpt;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function index() {

        $apps = DB::table('users')
            ->join('appointments', 'users.id', '=', 'appointments.tch_id')
            ->join('student_dpts', 'users.id', '=', 'student_dpts.std_id')
            ->join('departments', 'student_dpts.dpt_id', '=', 'departments.id')
            ->select('users.*','appointments.*','student_dpts.dpt_id','departments.name as dpt_name')
            ->get();
		
    	return view('student.dashboard', compact('apps'));
    }

    public function update(Request $request, $id)
    {
        
        $app = Appointment::find($id);
        $app->status = true;
        $app->std_id = Auth::user()->id;
        $app->save();

        return redirect('/student/dashboard')->with('success', 'Mesaj Düzenlendi');
    }
}
