<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ListeController extends Controller
{	
    public function getCustomers() {

        $query = DB::table('sirket')
            ->join('users', 'sirket.id', '=', 'users.sirket_id')
            ->join('iller', 'sirket.il_id','=', 'iller.il_no')
            ->join('ilceler', 'sirket.ilce_id','=', 'ilceler.ilce_no')
            ->select('users.name as calisan_isim', 'users.email as calisan_email','sirket.name as sirket_isim','iller.isim as il_isim', 'ilceler.isim as ilce_isim')
            ->get();

        return datatables($query)->make(true);
    }
}