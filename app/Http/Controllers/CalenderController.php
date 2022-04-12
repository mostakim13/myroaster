<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {

        return view('pages.Admin.calender.index');
    }

    public function userIndex($id)
    {
        return view('pages.User.calendar.index');
    }
}