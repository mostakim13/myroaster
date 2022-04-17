<?php

namespace App\Http\Controllers;

use App\Models\TimeKeeper;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id){
        $timekeepers = [];
        return view('pages.Admin.payment.index',compact('timekeepers'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('start_dates');
        $toDate = $request->input('end_dates');

        $timekeepers =  TimeKeeper::with('employee')->where('shift_start', '>=', $fromDate)->where('shift_end', '<=', $toDate)->get();

        return view('pages.Admin.payment.index', compact('timekeepers'));
    }
}
