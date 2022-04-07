<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    public function index()
    {
        // return 555;
        $data= JobType::get();
        return view("pages.Admin.job_type.index",compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        'user_id' => 'required',
        'company_code' => 'required',
        ]);

        $single = new JobType;
        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id= $request->user_id;
        $single->company_code= $request->company_code;

        $single->save();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
        'id' => 'required',
        'name' => 'required',
        'user_id' => 'required',
        'company_code' => 'required',
        ]);

        $single = JobType::find($request->id);
        if($single){

        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id= $request->user_id;
        $single->company_code= $request->company_code;

        $single->save();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $single = JobType::find($id);
        if($single){
            $single->delete();
        }

        return redirect()->back();
    }
}
