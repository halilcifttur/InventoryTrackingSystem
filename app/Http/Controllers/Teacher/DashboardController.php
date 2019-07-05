<?php

namespace App\Http\Controllers\Teacher;

use App\User;
use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {

    	$appointments =Appointment::all();

    	return view('teacher.dashboard', compact('appointments'));
    }

    public function destroy($id)
    {
        $appointments = Appointment::find($id);

        $appointments->delete();
        return redirect('/teacher/dashboard')->with('success', 'Appointment Deleted!');
    }

   
}
