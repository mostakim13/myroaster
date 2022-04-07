<?php

namespace App\Http\Controllers;

use App\Models\RoasterStatus;
use Illuminate\Http\Request;

class RoasterStatusController extends Controller
{
    public function index()
    {
        // return 555;
        $data= RoasterStatus::get();
        return view("pages.Admin.roaster_status.index",compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        'user_id' => 'required',
        'company_code' => 'required',
        ]);

        $single = new RoasterStatus;
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

        $single = RoasterStatus::find($request->id);
        if($single){

        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id= $request->user_id;
        $single->company_code= $request->company_code;

        $single->update();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $single = RoasterStatus::find($id);
        if($single){
            $single->delete();
        }

        return redirect()->back();
    }
}
