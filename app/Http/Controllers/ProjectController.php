<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Project;
use Auth;
use Alert;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Project View File
    public function index($id)
    {
        $clients = Client::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();
        return view('pages.Admin.project.index', compact('projects', 'clients'));
    }
    public function store(Request $request)
    {

        $project = new Project();
        $project->user_id = Auth::id();
        $project->pName = $request->pName;
        $project->cName = $request->cName;
        $project->Status = $request->Status;
        $project->cNumber = $request->cNumber;
        $project->project_address = $request->project_address;
        $project->project_venue = $request->project_venue;
        $project->project_state = $request->project_state;
        $project->company_code = Auth::user()->company->company_code;
        $project->clientName = $request->clientName;

        $project->save();
        $notification = array(
            'message' => 'Project Successfully Added !!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', 'Project Successfully Added !!!');
        return Redirect()->back()->with($notification);
    }
    public function update(Request $request)
    {

        $project = Project::find($request->id);

        $project->user_id = Auth::id();
        $project->pName = $request->pName;
        $project->cName = $request->cName;
        $project->Status = $request->Status;
        $project->cNumber = $request->cNumber;
        $project->project_address = $request->project_address;
        $project->project_venue = $request->project_venue;
        $project->project_state = $request->project_state;
        $project->clientName = $request->clientName;

        $project->save();
        $notification = array(
            'message' => 'Project Updated Successfully !!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', 'Project Updated Successfully !!!');
        return Redirect()->back()->with($notification);
    }
    public function delete($id)
    {
        //dd($id);
        $project = Project::find($id);

        $project->delete();
        $notification = array(
            'message' => 'Project record has been deleted successfully!!!',
            'alert-type' => 'error'
        );
        Alert::success('Deleted', 'Project record has been deleted successfully!!!');
        return Redirect()->back()->with($notification);
    }
}