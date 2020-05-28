<?php

namespace App\Http\Controllers\Sirket;

use App\User;
use App\Depo;
use App\Urun;
use App\Iller;
use App\Ilceler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {

        $users = DB::table('users')
                ->join('sirket', 'users.sirket_id', '=', 'sirket.id')
                ->join('iller', 'users.il_id','=', 'iller.il_no')
                ->join('ilceler', 'users.ilce_id','=', 'ilceler.ilce_no')
                ->select('users.*','sirket.name as sirket_name', 'iller.isim as il_isim', 'ilceler.isim as ilce_isim')
                ->get();
        $depos = DB::table('depo')
                ->join('sirket', 'depo.sirket_id', '=', 'sirket.id')
                ->join('iller', 'depo.il_id','=', 'iller.il_no')
                ->join('ilceler', 'depo.ilce_id','=', 'ilceler.ilce_no')
                ->select('depo.*','sirket.name as sirket_name', 'iller.isim as il_isim', 'ilceler.isim as ilce_isim')
                ->get();
        $uruns = DB::table('depo')
                ->join('sirket','depo.sirket_id', '=', 'sirket.id')
                ->join('urun', 'depo.id', '=', 'urun.depo_id')
                ->select('urun.*','depo.depo_adı','sirket.id as sirket_id')
                ->get();
        $iller = Iller::all();
        $ilceler = Ilceler::all();

    	return view('sirket.dashboard', compact('users','depos','uruns','iller','ilceler'));
    }

    public function ajax()
    {   
        return view('sirket.liste');
    }

    public function getIlce($id)
        {
            $ilceler = Ilceler::where('il_no',$id)->pluck('isim','ilce_no');
            return json_encode($ilceler);
        }

    public function destroy($id)
    {
        $users = User::find($id);        

        $users->delete();
        return redirect('/sirket/dashboard')->with('success', 'User Deleted!');
    }

    public function destroy2(Request $r)
    {
        $depo = Depo::find($r['depo_id']);       

        $depo->delete();
        return redirect('/sirket/dashboard')->with('success', 'Depo Deleted!');
    }

    public function destroy3(Request $r)
    {
        $urun = Urun::find($r['urun_id']);       

        $urun->delete();
        return redirect('/sirket/dashboard')->with('success', 'Urun Deleted!');
    }
}
