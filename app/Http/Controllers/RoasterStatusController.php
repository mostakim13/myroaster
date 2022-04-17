<?php

namespace App\Http\Controllers;

use App\Models\RoasterStatus;
use Illuminate\Http\Request;
use Auth;
use Alert;

class RoasterStatusController extends Controller
{
    public function index()
    {
        // return 555;
        $data= RoasterStatus::where('user_id', Auth::id())->get();
        return view("pages.Admin.roaster_status.index",compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $single = new RoasterStatus;
        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id = Auth::id();
        $single->company_code = Auth::user()->company->company_code;

        $single->save();
        Alert::success('Success', 'Roaster Status Added Successfully!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $single = RoasterStatus::find($request->id);
        if($single){

        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id = Auth::id();
        $single->company_code = Auth::user()->company->company_code;

        $single->update();
        }
        Alert::success('Updated', 'Roaster Status Updated Successfully!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $single = RoasterStatus::find($id);
        if($single){
            $single->delete();
        }
        Alert::success('Deleted', 'Roaster Status Deleted Successfully!');
        return redirect()->back();
    }
}
