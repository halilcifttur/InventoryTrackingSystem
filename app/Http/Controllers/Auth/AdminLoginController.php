<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{ 

  

    public function showLoginForm()

    { 

      if (Auth::guard('admin')->check()) {

        return redirect()->intended(route('admin.dashboard'));
      } elseif(Auth::guard('web')->check()) {

          if (Auth::user()->role->id == 1) {

              return redirect()->route('sirket.dashboard');
          } elseif (Auth::user()->role->id == 2) {

              return redirect()->route('calisan.dashboard');
          }
      }
      
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {

		$this->validate($request,[

           'email'   =>'required|email',
           'password'=>'required|min:6'

		]);



        if (Auth::guard('admin')->attempt(['email' => $request->email,'password'=> $request->password ],$request->remember)) {
        	
        	return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email','remember'));

    }

}
