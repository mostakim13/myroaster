<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use App\Models\TimeKeeper;
use App\Models\Payment;
use App\Models\RoasterType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeKeeperController extends Controller
{
    public function index($id)
    {
        $employees = Employee::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        $clients = Client::where('user_id', Auth::id())->get();
        $timekeepers = TimeKeeper::where('user_id', Auth::id())->get();
        return view('pages.Admin.timekeeper.index', compact('employees', 'projects', 'clients', 'timekeepers'));
    }



    public function storeTimeKeeper(Request $request)
    {
        //roaster store
        $request->validate([
            'employeeID' => 'required',
            'clientID' => 'required',
            'projectID' => 'required',
            'projectStartDate' => 'required',
            'projectEndDate' => 'required',
            'roasterStartDate' => 'required',
            'roasterEndDate' => 'required',
            'duration' => 'required',
            'ratePerHour' => 'required',
            'amount' => 'required',
        ],[
            'employeeID.required' => 'Please select employee.',
            'clientID.required' => 'Please select client.',
            'projectID.required' => 'Please select project.',
            'projectStartDate.required' => 'Please select project start date.',
            'projectEndDate.required' => 'Please select project end date.',
            'roasterStartDate.required' => 'Please select roaster start date.',
            'roasterEndDate.required' => 'Please select roaster end date.',
            'duration.required' => 'Please calculate duration.',
            'ratePerHour.required' => 'Rate per hour required.',
            'amount.required' => 'Please calculate amount.',
        ]);
        $timekeeper = new TimeKeeper();
        $timekeeper->user_id = Auth::id();
        $timekeeper->employeeID = $request->employeeID;
        $timekeeper->clientID = $request->clientID;
        $timekeeper->projectID = $request->projectID;
        $timekeeper->projectStartDate = $request->projectStartDate;
        $timekeeper->projectEndDate = $request->projectEndDate;
        $timekeeper->roasterStartDate = $request->roasterStartDate;
        $timekeeper->roasterEndDate = $request->roasterEndDate;
        $timekeeper->duration = $request->duration;
        $timekeeper->ratePerHour = $request->ratePerHour;
        $timekeeper->amount = $request->amount;
        $timekeeper->remarks = $request->remarks;
        $timekeeper->created_at = Carbon::now();
        //$timekeeper = $request->query('id');

        $timekeeper->save();

        $payment = new Payment;
        $payment->roaster_id = $timekeeper->id;
        $payment->save();

        $roaster = new RoasterType;
        $roaster->roaster_id = $timekeeper->id;
        $roaster->save();

        $notification = array(
            'message' => 'Roaster Successfully Added !!!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function update(Request $request)
    {

        $request->validate([
            'employeeID' => 'required',
            'clientID' => 'required',
            'projectID' => 'required',
            'projectStartDate' => 'required',
            'projectEndDate' => 'required',
            'roasterStartDate' => 'required',
            'roasterEndDate' => 'required',
            'duration' => 'required',
            'ratePerHour' => 'required',
            'amount' => 'required',
        ],[
            'employeeID.required' => 'Please select employee.',
            'clientID.required' => 'Please select client.',
            'projectID.required' => 'Please select project.',
            'projectStartDate.required' => 'Please select project start date.',
            'projectEndDate.required' => 'Please select project end date.',
            'roasterStartDate.required' => 'Please select roaster start date.',
            'roasterEndDate.required' => 'Please select roaster end date.',
            'duration.required' => 'Please calculate duration.',
            'ratePerHour.required' => 'Rate per hour required.',
            'amount.required' => 'Please calculate amount.',
        ]);

        $timekeeper = TimeKeeper::find($request->id);
        $timekeeper->employeeID = $request->employeeID;
        $timekeeper->clientID = $request->clientID;
        $timekeeper->projectID = $request->projectID;
        $timekeeper->projectStartDate = $request->projectStartDate;
        $timekeeper->projectEndDate = $request->projectEndDate;
        $timekeeper->roasterStartDate = $request->roasterStartDate;
        $timekeeper->roasterEndDate = $request->roasterEndDate;
        $timekeeper->duration = $request->duration;
        $timekeeper->ratePerHour = $request->ratePerHour;
        $timekeeper->amount = $request->amount;
        $timekeeper->remarks = $request->remarks;
        $timekeeper->updated_at = Carbon::now();

        $timekeeper->save();


        $notification = array(
            'message' => 'Scheduler Updated Successfully Added !!!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
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

    public function search(Request $request)
    {
        $fromDate = $request->input('start_date2');
        $toDate = $request->input('end_date2');

        $employees = Employee::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        $clients = Client::where('user_id', Auth::id())->get();
        $timekeepers = TimeKeeper::where('roasterStartDate', '>=', $fromDate)->where('roasterEndDate', '<=', $toDate)->get();


        return view('pages.Admin.timekeeper.index', compact('timekeepers','employees','projects','clients'));
    }
}
