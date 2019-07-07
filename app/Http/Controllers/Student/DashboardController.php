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

		$appointments =Appointment::all();
		
    	return view('student.dashboard', compact('appointments'));
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
