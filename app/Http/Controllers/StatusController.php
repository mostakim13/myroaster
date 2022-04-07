<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        // \Artisan::call('migrate');
        $statuses= Status::get();
        return view("pages.Admin.status.index",compact('statuses'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
        'status_name' => 'required',
        'user_id' => 'required',
        'company_code' => 'required',
        ]);

        $status = new Status;
        $status->status_name= $request->status_name;
        $status->remarks= $request->remarks;
        $status->user_id= $request->user_id;
        $status->company_code= $request->company_code;

        $status->save();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
        'id' => 'required',
        'status_name' => 'required',
        'user_id' => 'required',
        'company_code' => 'required',
        ]);

        $status = Status::find($request->id);
        if($status){

        $status->status_name= $request->status_name;
        $status->remarks= $request->remarks;
        $status->user_id= $request->user_id;
        $status->company_code= $request->company_code;

        $status->save();
        }

        return redirect()->back();
    }


    public function destroy($id)
    {
        $status = Status::find($id);
        if($status){
            $status->delete();
        }

        return redirect()->back();
    }
}
