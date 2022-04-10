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

class TimeKeeperController extends Controller
{
    public function index($id)
    {
        $employees = Employee::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        $clients = Client::where('user_id', Auth::id())->get();
        // $companies = User::where('user_id', Auth::id())->get();
        $timekeepers = TimeKeeper::where('user_id', Auth::id())->get();
        return view('pages.Admin.timekeeper.index', compact('employees', 'projects', 'clients', 'timekeepers'));
    }


    //roaster store
    public function storeTimeKeeper(Request $request)
    {
        // dd($request);
        $request->validate([
            'client_id' => 'required',
            'project_id' => 'required',
            'employee_id' => 'required',
            'roaster_date' => 'required',
            'shift_start' => 'required',
            'shift_end' => 'required',
            'duration' => 'required',
            'ratePerHour' => 'required',
            'amount' => 'required',
            'job_type_id' => 'required',
            'roaster_status_id' => 'required',

        ]);

        //==========================================================================
        //=============================Timekeeper Store=============================
        $timekeeper = new TimeKeeper();
        $timekeeper->user_id = Auth::id();
        $timekeeper->employee_id = $request->employee_id;
        $timekeeper->client_id = $request->client_id;
        $timekeeper->project_id = $request->project_id;
        $timekeeper->company_id = Auth::id();
        $timekeeper->roaster_date = $request->roaster_date;
        $timekeeper->shift_start = $request->shift_start;
        $timekeeper->shift_end = $request->shift_end;
        $timekeeper->sign_in = $request->sign_in;
        $timekeeper->sign_out = $request->sign_out;
        $timekeeper->duration = $request->duration;
        $timekeeper->ratePerHour = $request->ratePerHour;
        $timekeeper->amount = $request->amount;
        $timekeeper->job_type_id = $request->job_type_id;
        $timekeeper->roaster_status_id = $request->roaster_status_id;
        // $timekeeper->roaster_type = $request->roaster_type;
        $timekeeper->remarks = $request->remarks;
        $timekeeper->created_at = Carbon::now();
        $timekeeper->save();

        //==========================================================================
        //=============================Payment Store================================
        $payment = new Payment;
        $payment->roaster_id = $timekeeper->id;
        $payment->save();

        //============================================================================
        //=============================Roaster Type Store=============================
        $roaster = new RoasterType;
        $roaster->roaster_id = $timekeeper->id;
        $roaster->save();

        $notification = array(
            'message' => 'Roaster Successfully Added !!!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    //update timekeeper
    public function update(Request $request)
    {

        $request->validate([
            'client_id' => 'required',
            'project_id' => 'required',
            'employee_id' => 'required',
            'roaster_date' => 'required',
            'shift_start' => 'required',
            'shift_end' => 'required',
            'duration' => 'required',
            'ratePerHour' => 'required',
            'amount' => 'required',
            'job_type_id' => 'required|numeric',
            'roaster_status_id' => 'required',

        ]);

        $timekeeper = TimeKeeper::find($request->id);
        $timekeeper->employee_id = $request->employee_id;
        $timekeeper->client_id = $request->client_id;
        $timekeeper->project_id = $request->project_id;
        $timekeeper->company_id = Auth::id();
        $timekeeper->roaster_date = $request->roaster_date;
        $timekeeper->shift_start = $request->shift_start;
        $timekeeper->shift_end = $request->shift_end;
        $timekeeper->sign_in = $request->sign_in;
        $timekeeper->sign_out = $request->sign_out;
        $timekeeper->duration = $request->duration;
        $timekeeper->ratePerHour = $request->ratePerHour;
        $timekeeper->amount = $request->amount;
        $timekeeper->job_type_id = $request->job_type_id;
        $timekeeper->roaster_status_id = $request->roaster_status_id;
        $timekeeper->company_code = Auth::user()->company->company_code;
        // $timekeeper->roaster_type = $request->roaster_type;
        $timekeeper->remarks = $request->remarks;
        $timekeeper->updated_at = Carbon::now();
        $timekeeper->save();

        $notification = array(
            'message' => 'Scheduler Updated Successfully Added !!!',
            'alert-type' => 'success'
        );
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
        $timekeepers = TimeKeeper::where('Shiftstart', '>=', $fromDate)->where('Shiftend', '<=', $toDate)->get();


        return view('pages.Admin.timekeeper.index', compact('timekeepers', 'employees', 'projects', 'clients'));
    }
}
