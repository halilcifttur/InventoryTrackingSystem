<?php

namespace App\Http\Controllers\Sirket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ListeController extends Controller
{
    public function getCustomers() {

        $query = DB::table('depo')
            	->leftJoin('urun', 'urun.depo_id', '=', 'depo.id')
            	->join('iller', 'depo.il_id', '=', 'iller.il_no')
        		->join('ilceler', 'depo.ilce_id', '=', 'ilceler.ilce_no')
        		->select('depo.id','depo.depo_adı as depo_isim','iller.isim as il_isim','ilceler.isim as ilce_isim', DB::raw('count(*) as count','urun.id'))
        		->where('depo.sirket_id', '=', Auth::user()->sirket_id)        		
        		->groupBy('iller.isim','ilceler.isim','depo.id','depo.depo_adı','urun.id')
        		->get();
        return datatables($query)->make(true);
    }
}
