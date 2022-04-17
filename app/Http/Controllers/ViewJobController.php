<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TimeKeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewJobController extends Controller
{
    public function index($id)
    {

         $timekeepers = [];
        return view('pages.Admin.viewjob.index', compact('timekeepers'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');

        $timekeepers = TimeKeeper::with('employee')->where('shift_start', '>=', $fromDate)->where('shift_end', '<=', $toDate)->get();

        return view('pages.Admin.viewjob.index', compact('timekeepers'));
    }
}
