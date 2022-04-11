<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use App\Models\TimeKeeper;
use App\Models\Payment;
use App\Models\RoasterType;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class TimeKeeperController extends Controller
{
    public function index($id)
    {
        $employees = Employee::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        $clients = Client::where('user_id', Auth::id())->get();
        // $companies = User::where('user_id', Auth::id())->get();
        $timekeepers = TimeKeeper::where('user_id', Auth::id())->get();
        $roaster_types = RoasterType::all();
        return view('pages.Admin.timekeeper.index', compact('employees', 'projects', 'clients', 'timekeepers', 'roaster_types'));
    }


    //=============================Timekeeper Store=============================//
    public function storeTimeKeeper(Request $request)
    {

        $timekeeper = new TimeKeeper();
        $timekeeper->user_id = Auth::id();
        $timekeeper->employee_id = $request->employee_id;
        $timekeeper->client_id = $request->client_id;
        $timekeeper->project_id = $request->project_id;
        $timekeeper->employee_id = Auth::user()->employee->id;
        $timekeeper->company_id = Auth::id();
        $timekeeper->roaster_date = $request->roaster_date;
        $timekeeper->shift_start = $request->shift_start;
        $timekeeper->shift_end = $request->shift_end;
        $timekeeper->company_code = 'mim';
        $timekeeper->duration = $request->duration;
        $timekeeper->ratePerHour = $request->ratePerHour;
        $timekeeper->amount = $request->amount;
        $timekeeper->job_type = $request->job_type;
        $timekeeper->roaster_id = Auth::id();
        $timekeeper->roaster_status = $request->roaster_status;
        $timekeeper->roaster_type = $request->roaster_type;
        $timekeeper->remarks = $request->remarks;
        $timekeeper->created_at = Carbon::now();
        $timekeeper->save();

        //=============Payment Store=============//
        $payment = new Payment;
        $payment->roaster_id = $timekeeper->id;
        $payment->save();

        //=============Roaster Type Store=========//
        $roaster = new RoasterType;
        $roaster->roaster_id = $timekeeper->id;
        $roaster->save();

        $notification = array(
            'message' => 'Roaster Successfully Added !!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', 'Roaster Successfully Added !!!');
        return Redirect()->back()->with($notification);
    }

    // =============================Timekeeper Update=============================//
    public function update(Request $request)
    {
        dd($request->duration);
        $timekeeper = TimeKeeper::find($request->id);
        // $timekeeper->user_id = Auth::id();
        $timekeeper->employee_id = $request->employee_id;
        $timekeeper->client_id = $request->client_id;
        $timekeeper->project_id = $request->project_id;
        // $timekeeper->employee_id = Auth::user()->employee->id;
        // $timekeeper->company_id = Auth::id();
        $timekeeper->roaster_date = $request->roaster_date;
        $timekeeper->shift_start = $request->shift_start;
        $timekeeper->shift_end = $request->shift_end;
        // $timekeeper->company_code = 'mim';
        $timekeeper->duration = $request->duration;
        $timekeeper->ratePerHour = $request->ratePerHour;
        $timekeeper->amount = $request->amount;
        $timekeeper->job_type = $request->job_type;
        // $timekeeper->roaster_id = Auth::id();
        $timekeeper->roaster_status = $request->roaster_status;
        $timekeeper->roaster_type = $request->roaster_type;
        $timekeeper->remarks = $request->remarks;
        $timekeeper->updated_at = Carbon::now();
        $timekeeper->save();

        $notification = array(
            'message' => 'Scheduler Updated Successfully Added !!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', 'Scheduler Updated Successfully !!!');
        return Redirect()->back()->with($notification);
    }

    //Timekeeper delete
    public function delete($id)
    {
        //dd($id);
        $timekeeper = TimeKeeper::find($id);
        //dd($timekeeper);
        $timekeeper->delete();
        $notification = array(
            'message' => 'Timekeeper record has been deleted successfully!!!',
            'alert-type' => 'error'
        );
        Alert::success('Success', 'Timekeeper record has been deleted successfully!!!');
        return Redirect()->back()->with($notification);
    }

    //timekepper search
    public function search(Request $request)
    {
        $fromDate = $request->input('start_date2');
        $toDate = $request->input('end_date2');

        $employees = Employee::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        $clients = Client::where('user_id', Auth::id())->get();
        $timekeepers = TimeKeeper::where('shift_start', '>=', $fromDate)->where('Shift_end', '<=', $toDate)->get();


        return view('pages.Admin.timekeeper.index', compact('timekeepers', 'employees', 'projects', 'clients'));
    }
}