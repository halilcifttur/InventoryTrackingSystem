<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        if (Auth::check() && Auth::user()->role->id == 1) {
            
            $this->redirectTo = route('sirket.dashboard');
        } else {
            
            $this->redirectTo = route('calisan.dashboard');
        }

        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()

    { 

      if (Auth::guard('admin')->check()) {

        return redirect()->intended(route('admin.dashboard'));
      } 
      
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request,[

           'email'   =>'required|email',
           'password'=>'required|min:6'

        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email,'password'=> $request->password ],$request->remember) && Auth::check() && Auth::user()->role->id == 1) {
            
            return redirect()->intended(route('sirket.dashboard'));
        } elseif (Auth::guard('web')->attempt(['email' => $request->email,'password'=> $request->password ],$request->remember) && Auth::check() && Auth::user()->role->id == 2) {
            
            return redirect()->intended(route('calisan.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email','remember'));

    }
}
