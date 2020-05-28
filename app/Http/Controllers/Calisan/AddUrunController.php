<?php

namespace App\Http\Controllers\Calisan;

use App\Urun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddUrunController extends Controller
{
    public function store(Request $request) {

    	$urun = new Urun();

    	$urun->name = $request->isim;
    	$urun->adet = $request->adet;
    	$urun->depo_id = $request->depo;
    	$urun->save();

    	return redirect()->to('/calisan/dashboard');
    }
}
