<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Iller;
use App\Ilceler;
use App\Sirket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

   public function __construct()
   {

         $this->middleware('auth:admin');
   }


    public function index()
    {	
    	$users = DB::table('users')
            ->join('sirket', 'users.sirket_id', '=', 'sirket.id')
            ->join('iller', 'users.il_id','=', 'iller.il_no')
            ->join('ilceler', 'users.ilce_id','=', 'ilceler.ilce_no')
            ->select('users.*','sirket.name as sirket_name', 'iller.isim as il_isim', 'ilceler.isim as ilce_isim','users.email as user_email','users.name as user_name','users.id as user_id')
            ->get();

    	$sirkets = DB::table('sirket')
            ->join('iller', 'sirket.il_id','=', 'iller.il_no')
            ->join('ilceler', 'sirket.ilce_id','=', 'ilceler.ilce_no')
            ->select('sirket.*', 'iller.isim as il_isim', 'ilceler.isim as ilce_isim','sirket.id as sirket_id')
            ->get();

        $iller = Iller::all();

        $ilceler = Ilceler::all();

    	return view('admin.dashboard', compact('users','sirkets','iller','ilceler'));
    }

    public function ajax()
    {   
        return view('admin.liste');
    }

    public function getIlce($id)
    {
        $ilceler = Ilceler::where('il_no',$id)->pluck('isim','ilce_no');
        return json_encode($ilceler);
    }

    public function getSirket($id)
    {
        $sirket=Sirket::find($id);
      
        return json_encode($sirket);
    }

     public function getUser($id)
    {
        $users=User::find($id);
      
        return json_encode($users);
    }

    public function destroy($id)
    {
        $sirket = Sirket::find($id);

        $sirket->delete();
        return redirect('/admin/dashboard')->with('success', 'Sirket Deleted!');
    }

    public function destroy2(Request $r)
    {
        $user = User::find($r['user_id']);

        $user->delete();
        return redirect('/admin/dashboard')->with('success', 'User Deleted!');
    }
 
    public function update(Request $request,$id)
    {   
       
      
      $sirket=Sirket::find($id);

      $sirket->name=$request->input('sname');
      $sirket->il_id=$request->input('il');
      $sirket->ilce_id=$request->input('ilce');
      $sirket->save();

      if($sirket)
      $response = array('status' => 1,'data' => $sirket);
      else
      $response = array('status' => 0,'data' => ''); 
      
      echo json_encode($response);


    }   

     public function update2(Request $request,$id)
    {   
   
      $user=User::find($id);

      $user->name=$request->input('sname');
      $user->email=$request->input('email');
      $user->il_id=$request->input('il');
      $user->ilce_id=$request->input('ilce');
      $user->save();

      echo json_encode($user);
    }   
}
