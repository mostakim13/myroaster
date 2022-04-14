<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class StatusController extends Controller
{
    public function index()
    {
        // \Artisan::call('migrate');
        $statuses = Status::get();
        return view("pages.Admin.status.index", compact('statuses'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_name' => 'required',
        ]);

        $status = new Status;
        $status->status_name = $request->status_name;
        $status->remarks = $request->remarks;
        $status->user_id = Auth::id();
        $status->company_code = Auth::user()->company->company_code;

        $status->save();
        Alert::success('Success', 'Status added successfully!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'status_name' => 'required',

        ]);

        $status = Status::find($request->id);
        if ($status) {

            $status->status_name = $request->status_name;
            $status->remarks = $request->remarks;
            $status->user_id = Auth::id();
            $status->company_code = Auth::user()->company->company_code;

            $status->save();
        }
        Alert::success('Updated', 'Status updated successfully!');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $status = Status::find($id);
        if ($status) {
            $status->delete();
        }
        Alert::success('Deleted', 'Status deleted successfully!');
        return redirect()->back();
    }
}