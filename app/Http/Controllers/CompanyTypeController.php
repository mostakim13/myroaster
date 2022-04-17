<?php

namespace App\Http\Controllers;

use App\Models\CompanyType;
use Illuminate\Http\Request;
use Alert;
use Auth;

class CompanyTypeController extends Controller
{
    public function index()
    {
        // return 555;
        $data= CompanyType::where('user_id', Auth::id())->get();;
        return view("pages.Admin.company_type.index",compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $single = new CompanyType;
        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id = Auth::id();
        $single->company_code = Auth::user()->company->company_code;
        $single->save();

        Alert::success('Success', 'Company Type Added Successfully!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        ]);

        $single = CompanyType::find($request->id);
        if($single){

        $single->name= $request->name;
        $single->remarks= $request->remarks;
        $single->user_id = Auth::id();
        $single->company_code = Auth::user()->company->company_code;

        $single->save();
        }
        Alert::success('Updated', 'Company Type Updated Successfully!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $single = CompanyType::find($id);
        if($single){
            $single->delete();
        }
        Alert::success('Deleted', 'Company Type Deleted Successfully !!!');
        return redirect()->back();
    }
}
