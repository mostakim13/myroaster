<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Session;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
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
    public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']), $remember_me)) {
            if (auth()->user()->is_admin == 1) {
                return redirect('/admin/home/{id}');
            } elseif (auth()->user()->super_admin == 1) {
                return redirect()->route('super-admin.home');
            }
            else {
                return redirect()->route('home');
            }
        } else {
            $notification=array(
                'message'=>'Email and Password did not match!',
                'alert-type' =>'error'
            );
            Alert::error('Error', 'Email and Password did not match!');
          return redirect()->route('login')->with($notification);
        }
    }
}
