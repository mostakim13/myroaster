<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Auth;
use Alert;

class StatusController extends Controller
{
    public function index()
    {
        // \Artisan::call('migrate');
        $statuses= Status::where('user_id', Auth::id())->get();
        return view("pages.Admin.status.index",compact('statuses'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
        'status_name' => 'required',
        ]);

        $status = new Status;
        $status->status_name= $request->status_name;
        $status->remarks= $request->remarks;
        $status->user_id = Auth::id();
        $status->company_code = Auth::user()->company->company_code;
        $status->save();
        Alert::success('Success', 'Status Added Successfully!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
        'status_name' => 'required',
        ]);

        $status = Status::find($request->id);
        if($status){

        $status->status_name= $request->status_name;
        $status->remarks= $request->remarks;
        $status->user_id = Auth::id();
        $status->company_code = Auth::user()->company->company_code;

        $status->save();
        }
        Alert::success('Updated', 'Status Updated Successfully!');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $status = Status::find($id);
        if($status){
            $status->delete();
        }
        Alert::success('Deleted', 'Status Deleted Successfully!');
        return redirect()->back();
    }
}
