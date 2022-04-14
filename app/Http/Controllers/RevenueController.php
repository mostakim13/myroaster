<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index($id)
    {
        $revenues = Revenue::where('user_id', Auth::id())->get();
        $clients = Client::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        $employees = Employee::where('user_id', Auth::id())->get();
        return view('pages.Admin.revenue.index', compact('revenues', 'clients', 'projects', 'employees'));
    }

    public function store(Request $request)
    {
        $revenues = new Revenue();
        $revenues->user_id = Auth::id();
        $revenues->company_code = Auth::user()->company->company_code;
        $revenues->client_name = $request->client_name;
        $revenues->project_name = $request->project_name;
        $revenues->payment_date = $request->payment_date;
        $revenues->shift_start = $request->shift_start;
        $revenues->shift_end = $request->shift_end;
        $revenues->rate = $request->rate;
        $revenues->hours = $request->hours;
        $revenues->amount = $request->amount;
        $revenues->remarks = $request->remarks;
        $revenues->created_at = Carbon::now();
        $revenues->save();

        Alert::success('Success', 'Event Added Successfully!');
        return Redirect()->back();
    }

    public function update(Request $request)
    {
        $revenues = Revenue::find($request->id);
        $revenues->client_name = $request->client_name;
        $revenues->project_name = $request->project_name;
        $revenues->payment_date = $request->payment_date;
        $revenues->shift_start = $request->shift_start;
        $revenues->shift_end = $request->shift_end;
        $revenues->rate = $request->rate;
        $revenues->hours = $request->hours;
        $revenues->amount = $request->amount;
        $revenues->remarks = $request->remarks;
        $revenues->updated_at = Carbon::now();
        $revenues->save();

        Alert::success('Updated', 'Event Updated Successfully!');
        return Redirect()->back();
    }

    public function delete($id)
    {
        $revenues = Revenue::find($id);
        $revenues->delete();
        Alert::success('Deleted', 'Event record has been deleted successfully!');
        return Redirect()->back();
    }
}