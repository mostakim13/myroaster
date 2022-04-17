<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;
use Auth;
use Alert;

class JobTypeController extends Controller
{
    public function index()
    {
        // return 555;
        $data= JobType::where('user_id', Auth::id())->get();
        return view("pages.Admin.job_type.index",compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $single = new JobType;
        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id = Auth::id();
        $single->company_code = Auth::user()->company->company_code;
        $single->save();
        
        Alert::success('Success', 'Job Type Added Successfully!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $single = JobType::find($request->id);
        if($single){

        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id = Auth::id();
        $single->company_code = Auth::user()->company->company_code;

        $single->save();
        }
        Alert::success('Updated', 'Job Type Updateded Successfully!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $single = JobType::find($id);
        if($single){
            $single->delete();
        }
        Alert::success('Deleted', 'Job Type Deleted Successfully!');
        return redirect()->back();
    }
}
