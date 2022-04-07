<?php

namespace App\Http\Controllers;

use App\Models\Myavailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyavailabilityController extends Controller
{
    public function index()
    {
        // return 555;
        $data= Myavailability::get();
        return view("pages.Admin.myavailability.index",compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'employee_id' => 'required',
        'company_code' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        ]);

        $single = new Myavailability();
        $single->user_id= Auth::id();;
        $single->employee_id= $request->employee_id;
        $single->company_code= $request->company_code;
        $single->remarks= $request->remarks;
        $single->start_date= $request->start_date;
        $single->end_date= $request->end_date;

        $single->save();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
        'employee_id' => 'required',
        'company_code' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        ]);


        $single = Myavailability::find($request->id);
        if($single){
        $single->employee_id= $request->employee_id;
        $single->company_code= $request->company_code;
        $single->remarks= $request->remarks;
        $single->start_date= $request->start_date;
        $single->end_date= $request->end_date;

        $single->save();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $single = Myavailability::find($id);
        if($single){
            $single->delete();
        }

        return redirect()->back();
    }
}