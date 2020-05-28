<?php

namespace App\Http\Controllers\Calisan;

use App\Depo;
use App\Urun;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {

    	$uruns = $uruns = DB::table('depo')
                ->join('sirket','depo.sirket_id', '=', 'sirket.id')
                ->join('urun', 'depo.id', '=', 'urun.depo_id')
                ->select('urun.*','depo.depo_adı','sirket.id as sirket_id')
                ->get();

    	$depos = Depo::all();

    	return view('calisan.dashboard', compact('uruns','depos'));
    }

    public function destroy($id)
    {
        $uruns = Urun::find($id);        

        $uruns->delete();
        return redirect('/calisan/dashboard')->with('success', 'User Deleted!');
    }
}
