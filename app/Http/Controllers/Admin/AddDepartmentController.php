<?php

namespace App\Http\Controllers\Admin;

use App\Departments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddDepartmentController extends Controller
{
    public function store(Request $request)
    {        
       
        $app = new Departments();

        $app->name = $request->name;
        $app->save();

        return redirect()->to('/teacher/dashboard');
    }
}
