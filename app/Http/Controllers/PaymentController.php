<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TimeKeeper;
use Illuminate\Http\Request;
use DB;

class PaymentController extends Controller
{
    public function index($id)
    {
        $timekeepers = [];
        return view('pages.Admin.payment.index', compact('timekeepers'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('start_dates');
        $toDate = $request->input('end_dates');

        $timekeepers =  TimeKeeper::with('employee')->where('shift_start', '>=', $fromDate)->where('shift_end', '<=', $toDate)->get();

        return view('pages.Admin.payment.index', compact('timekeepers'));
    }

    public function payDetails($employee_id)
    {
        // $employees = Employee::where('id', $employee_id)->get();
        $timekeepers = TimeKeeper::where('employee_id', $employee_id)->get();

        // $companies =  DB::table('time_keepers')
        //     ->select('time_keepers.*', 'employees.*')
        //     ->join('employees', 'employees.id', '=', 'time_keepers.employee_id')
        //     ->where(['time_keepers.is_admin' => '1'])
        //     ->get();
        $employees = Employee::all();
        return view('pages.Admin.payment.paymentDetails', compact('timekeepers', 'employees'));
    }
}