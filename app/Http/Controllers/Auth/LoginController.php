<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Seesion;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request){

        if (Auth::attempt(['email' => $request->email, 'password' =>$request->password])) {
         
           
            return redirect()->route('home');
            
           
        }else{
            if($request->email == 'admin' && $request->password == 'admin'){
                $user=$request->email ;
                return redirect()->route('homead');
            }else{
                $note = "User account or password incorrect";
                return redirect()->route('login')->with("note",$note);
            }
           
        }
    }
    public function indexad()
    {
        return view('admin/home');
    }
}
