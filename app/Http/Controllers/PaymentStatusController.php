<?php

namespace App\Http\Controllers;

use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Auth;
use Alert;

class PaymentStatusController extends Controller
{
    public function index()
    {
        // return 555;
        $data= PaymentStatus::where('user_id', Auth::id())->get();
        return view("pages.Admin.payment_status.index",compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $single = new PaymentStatus;
        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id = Auth::id();
        $single->company_code = Auth::user()->company->company_code;
        $single->save();
        Alert::success('Success', 'Payment Status Added Successfully!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $single = PaymentStatus::find($request->id);
        if($single){

        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id = Auth::id();
        $single->company_code = Auth::user()->company->company_code;
        $single->save();
        }
        Alert::success('Updated', 'Payment Status Updated Successfully!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $single = PaymentStatus::find($id);
        if($single){
            $single->delete();
        }
        Alert::success('Deleted', 'Payment Status Deleted Successfully!');
        return redirect()->back();
    }
}
