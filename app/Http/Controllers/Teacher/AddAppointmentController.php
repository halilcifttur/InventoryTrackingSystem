<?php

namespace App\Http\Controllers\Teacher;

use App\User;
use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DateTime;

class AddAppointmentController extends Controller
{
    public function store(Request $request)
    {        
       
        $app = new Appointment();
        $date = new DateTime($request->date);

        $app->tch_id = Auth::user()->id;
        $app->date = $date->format('Y-m-d');
        $app->start_at = $request->start_time;
        $app->end_at = $request->end_time;
        $app->save();

        return redirect()->to('/teacher/dashboard');
    }
}
