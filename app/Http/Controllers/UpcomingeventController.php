<?php

namespace App\Http\Controllers;

use App\Models\Upcomingevent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Eventrequest;
use App\Models\Project;
use Illuminate\Support\Facades\Redirect;

class UpcomingeventController extends Controller
{
    public function index($id)
    {
        $upcomingevents = Upcomingevent::where('user_id', Auth::id())->get();
        $clients = Client::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        $employees = Employee::where('user_id', Auth::id())->get();
        return view('pages.Admin.upcoming_event.index', compact('upcomingevents', 'clients', 'projects', 'employees'));
    }

    //user
    public function userIndex($id)
    {
        $upcomingevents = Upcomingevent::where('company_code', Auth::user()->employee->company)->get();
        $clients = Client::all();
        $projects = Project::all();
        $employees = Employee::all();
        return view('pages.User.upcoming_event.index', compact('upcomingevents', 'clients', 'projects', 'employees'));
    }

    public function eventRequestIndex($id)
    {

        $eventrequests = Eventrequest::all();
        // dd($eventrequests);
        return view('pages.Admin.event_request.index', compact('eventrequests'));
    }

    public function eventStore(Request $request)
    {
        $eventrequests = new Eventrequest();
        $eventrequests->event_id = $request->event_id;
        $eventrequests->employee_id = Auth::id();
        $eventrequests->created_at = Carbon::now();
        $eventrequests->save();

        $upcomingevents = Upcomingevent::find($request->event_id);
        $upcomingevents->status = 1;
        $upcomingevents->save();
        return Redirect()->back();
    }


    public function store(Request $request)
    {
        $upcomingevents = new Upcomingevent();
        $upcomingevents->user_id = Auth::id();
        $upcomingevents->company_code = Auth::user()->company->company_code;
        $upcomingevents->client_name = $request->client_name;
        $upcomingevents->project_name = $request->project_name;
        $upcomingevents->event_date = $request->event_date;
        $upcomingevents->shift_start = $request->shift_start;
        $upcomingevents->shift_end = $request->shift_end;
        $upcomingevents->rate = $request->rate;
        // $upcomingevents->employee_id = $request->employee_id;
        $upcomingevents->remarks = $request->remarks;
        $upcomingevents->created_at = Carbon::now();
        $upcomingevents->save();

        Alert::success('Success', 'Event Added Successfully!');
        return Redirect()->back();
    }

    public function update(Request $request)
    {
        $upcomingevents = Upcomingevent::find($request->id);
        $upcomingevents->client_name = $request->client_name;
        $upcomingevents->project_name = $request->project_name;
        $upcomingevents->event_date = $request->event_date;
        $upcomingevents->shift_start = $request->shift_start;
        $upcomingevents->shift_end = $request->shift_end;
        $upcomingevents->rate = $request->rate;
        $upcomingevents->employee_id = $request->employee_id;
        $upcomingevents->remarks = $request->remarks;
        $upcomingevents->updated_at = Carbon::now();
        $upcomingevents->save();

        Alert::success('Updated', 'Event Updated Successfully!');
        return Redirect()->back();
    }

    public function delete($id)
    {
        $upcomingevents = Upcomingevent::find($id);
        $upcomingevents->delete();
        Alert::success('Deleted', 'Event record has been deleted successfully!');
        return Redirect()->back();
    }
}