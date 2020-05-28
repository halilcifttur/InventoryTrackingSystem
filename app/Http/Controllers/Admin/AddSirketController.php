<?php

namespace App\Http\Controllers\Admin;

use App\Sirket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddSirketController extends Controller
{
     public function store(Request $request)
    {        
       
        $app = new Sirket();

        $app->name = $request->sname;
        $app->il_id = $request->il;
        $app->ilce_id = $request->ilce;
        $app->save();

        return redirect()->to('/admin/dashboard');
    }}
