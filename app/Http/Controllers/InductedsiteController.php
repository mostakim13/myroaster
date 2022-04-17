<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use Auth;
use Alert;
use App\Models\Inductedsite;
use Carbon\Carbon;

class InductedsiteController extends Controller
{
    public function index($id)
    {
        $clients = Client::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        $employees = Employee::where('user_id', Auth::id())->get();
        $inductions = Inductedsite::where('user_id', Auth::id())->get();
        return view('pages.Admin.inducted_site.index', compact('inductions', 'clients', 'projects', 'employees'));
    }

    public function store(Request $request)
    {
        $inductedsites = new Inductedsite();
        $inductedsites->user_id = Auth::id();
        $inductedsites->company_code = Auth::user()->company->company_code;
        $inductedsites->employee_id = $request->employee_id;
        $inductedsites->client_id = $request->client_id;
        $inductedsites->project_id = $request->project_id;
        $inductedsites->induction_date = $request->induction_date;
        $inductedsites->remarks = $request->remarks;
        $inductedsites->created_at = Carbon::now();
        $inductedsites->save();

        Alert::success('Success', 'Induction Added Successfully!');
        return Redirect()->back();
    }

    public function update(Request $request)
    {
        $inductedsites = Inductedsite::find($request->id);
        $inductedsites->employee_id = $request->employee_id;
        $inductedsites->client_id = $request->client_id;
        $inductedsites->project_id = $request->project_id;
        $inductedsites->induction_date = $request->induction_date;
        $inductedsites->remarks = $request->remarks;
        $inductedsites->created_at = Carbon::now();
        $inductedsites->save();

        Alert::success('Updated', 'Induction Updated Successfully!');
        return Redirect()->back();
    }

    public function delete($id)
    {
        $inductedsites = Inductedsite::find($id);
        $inductedsites->delete();
        Alert::success('Deleted', 'Induction record has been deleted successfully!');
        return Redirect()->back();
    }
}
