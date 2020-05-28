<?php

namespace App\Http\Controllers\Sirket;

use App\Depo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AddDepoController extends Controller
{
     public function store(Request $request)
    {    
       	$user = new Depo();
        $user->depo_adı = $request->sname;
        $user->sirket_id = Auth::user()->sirket_id;
        $user->il_id = $request->il; 
        $user->ilce_id = $request->ilce;
        $user->save();

        return redirect()->to('/sirket/dashboard');
    }}
