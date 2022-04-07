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
            'Clientid' => 'required',
            'Projectid' => 'required',
            'Empid' => 'required',
            'Roasterdate' => 'required',
            'Shiftstart' => 'required',
            'Shiftend' => 'required',
            'Duration' => 'required',
            'Rate' => 'required',
            'Amount' => 'required',
            'Jobtypeid' => 'required',
            'RoasterstatusID' => 'required',
            'Roastertypeid' => 'required'
        ]);
        $timekeeper = new TimeKeeper();
        $timekeeper->user_id = Auth::id();

        $timekeeper->Clientid = $request->Clientid;
        $timekeeper->Projectid = $request->Projectid;
        $timekeeper->Empid = $request->Empid;
        $timekeeper->Companyid = Auth::id();
        $timekeeper->Roasterdate = $request->Roasterdate;
        $timekeeper->Shiftstart = $request->Shiftstart;
        $timekeeper->Shiftend = $request->Shiftend;
        $timekeeper->Signon = $request->Signon;
        $timekeeper->Signoff = $request->Signoff;
        $timekeeper->Duration = $request->Duration;
        $timekeeper->Rate = $request->Rate;
        $timekeeper->Amount = $request->Amount;
        $timekeeper->Jobtypeid = $request->Jobtypeid;
        $timekeeper->RoasterstatusID = $request->RoasterstatusID;
        $timekeeper->Roastertypeid = $request->Roastertypeid;
        $timekeeper->Remarks = $request->Remarks;
        $timekeeper->created_at = Carbon::now();
        //$timekeeper = $request->query('id');
        $timekeeper->save();

        //Payment
        $payment = new Payment;
        $payment->roaster_id = $timekeeper->id;
        $payment->save();

        //RoasterType
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
            'Clientid' => 'required',
            'Projectid' => 'required',
            'Empid' => 'required',
            'Roasterdate' => 'required',
            'Shiftstart' => 'required',
            'Shiftend' => 'required',
            'Duration' => 'required',
            'Rate' => 'required',
            'Amount' => 'required',
            'Jobtypeid' => 'required|numeric|max:10',
            'RoasterstatusID' => 'required|numeric|max:10',
            'Roastertypeid' => 'required|numeric|max:10'
        ]);

        $timekeeper = TimeKeeper::find($request->id);
        $timekeeper->Clientid = $request->Clientid;
        $timekeeper->Projectid = $request->Projectid;
        $timekeeper->Empid = $request->Empid;
        $timekeeper->Companyid = $request->Companyid;
        $timekeeper->Roasterdate = $request->Roasterdate;
        $timekeeper->Shiftstart = $request->Shiftstart;
        $timekeeper->Shiftend = $request->Shiftend;
        $timekeeper->Signon = $request->Signon;
        $timekeeper->Signoff = $request->Signoff;
        $timekeeper->Duration = $request->Duration;
        $timekeeper->Rate = $request->Rate;
        $timekeeper->Amount = $request->Amount;
        $timekeeper->Jobtypeid = $request->Jobtypeid;
        $timekeeper->RoasterstatusID = $request->RoasterstatusID;
        $timekeeper->Roastertypeid = $request->Roastertypeid;
        $timekeeper->Remarks = $request->Remarks;
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
