<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.User.index');
    }
    public function adminHome()
    {

        //dd($id);
        // $admin = User::where('Status', '=', 1)->get();
        if (Auth::user()->company->status == 1 && Auth::user()->is_admin == 1) {
            return view('pages.Admin.index');
        } else if (Auth::user()->company->status == 2) {
            $notification = array(
                'message' => 'This is inactive !!!',
                'alert-type' => 'warning'
            );
            Auth::logout();
            Alert::warning('Sorry!', 'Your account is inactive. Please contact with admin.');
            return Redirect()->route('login');
        }
    }
    public function SuperadminHome()
    {
        return view('pages.SuperAdmin.index');
    }
    public function adminHomeall($id)
    {
        //dd($id);
        // $admin = User::where('Status', '=', 1)->get();
        if (Auth::user()->Status == 1) {
        return view('pages.Admin.index');
        } elseif(Auth::user()->Status == 2) {
            $notification = array(
                'message' => 'This is inactive !!!',
                'alert-type' => 'warning'
            );
            return Redirect()->route('login')->with($notification);
        }
    }

    // public function adminsHome(Request $request)
    // {
    //     $user = DB::table('users')
    //         ->where('id', $request->userid)
    //         ->first();
    //     $request->session()->put('super_admin', 1);
    //     $request->session()->put('id', Auth::id());
    //     if (Auth::loginUsingId($user->id)) {
    //         return redirect('/');
    //     }
    // }
}
