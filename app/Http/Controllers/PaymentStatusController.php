<?php

namespace App\Http\Controllers;

use App\Models\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    public function index()
    {
        // return 555;
        $data= PaymentStatus::get();
        return view("pages.Admin.payment_status.index",compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        'user_id' => 'required',
        'company_code' => 'required',
        ]);

        $single = new PaymentStatus;
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

        $single = PaymentStatus::find($request->id);
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
        $single = PaymentStatus::find($id);
        if($single){
            $single->delete();
        }

        return redirect()->back();
    }
}
