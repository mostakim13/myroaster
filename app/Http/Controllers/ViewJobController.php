<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\JobType;
use App\Models\Project;
use App\Models\RoasterStatus;
use App\Models\RoasterType;
use App\Models\TimeKeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ViewJobController extends Controller
{
    public function index($id)
    {

        $timekeepers = [];
        // $timekeepers = TimeKeeper::where('user_id', Auth::id())->get();
        //$employees = Employee::where('user_id', Auth::id())->where('status', '1')->get();
        return view('pages.Admin.viewjob.index', compact('timekeepers'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');


        $timekeepers = DB::table('time_keepers')
            ->select(DB::raw(
                'e.* ,
                sum(time_keepers.duration) as total_hours,
                sum(time_keepers.amount) as total_amount ,
                count(time_keepers.id) as record'

            ))
            ->leftJoin('employees as e', 'e.id', 'time_keepers.employee_id')
            // ->join('employees', 'employees.user_id', '=', 'time_keepers.id')
            ->where('e.user_id', Auth::id())
            ->groupBy("e.id")
            ->whereBetween('roaster_date', [$fromDate, $toDate])
            ->get();
        // dd($timekeepers);

        // $timekeepers =  DB::table('time_keepers')
        //     ->select('time_keepers.*,sum(time_keepers.duration) as total_hours,
        //     sum(time_keepers.amount) as total_amount ,
        //     count(time_keepers.id) as record', 'employees.*')
        //     ->join('employees', 'employees.user_id', '=', 'time_keepers.id')
        //     ->whereBetween('roaster_date', [$fromDate, $toDate])
        //     ->get();

        $employees = Employee::where('user_id', Auth::id())->where('status', '1')->get();
        //dd($employees);
        $projects = Project::where('user_id', Auth::id())->where('Status', '1')->get();
        $clients = Client::where('user_id', Auth::id())->where('status', '1')->get();
        // $companies = User::where('user_id', Auth::id())->get();
        // $timekeeper = TimeKeeper::where('user_id', Auth::id())->get();
        $job_types = JobType::where('user_id', Auth::id())->get();
        $roaster_types = RoasterType::all();

        $roaster_status = RoasterStatus::where('user_id', Auth::id())->get();

        // dd($timekeepers);
        return view('pages.Admin.viewjob.index', compact('timekeepers', 'employees', 'projects', 'clients', 'job_types', 'roaster_types', 'roaster_status'));
    }
}