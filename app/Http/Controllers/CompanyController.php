<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Auth;
use Alert;
use Carbon\Carbon;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $companies =  DB::table('users')
            ->select('users.*', 'companies.*')
            ->join('companies', 'companies.user_id', '=', 'users.id')
            ->where(['users.is_admin' => '1'])
            ->get();


        return view('pages.SuperAdmin.Company.index', compact('companies'));
    }
    // public function updateCompany(Request $request)
    // {

    //     $request->validate([
    //         'file' => 'required'
    //     ]);

    //     $image = $request->file('file');
    //     $filename = null;
    //     if ($image) {
    //         $filename = time() . $image->getClientOriginalName();

    //         Storage::disk('public')->putFileAs(
    //             'clients/',
    //             $image,
    //             $filename
    //         );
    //     }

    //     $company = User::find($request->id);
    //     $company->name = $request->name;
    //     $company->mname = $request->mname;
    //     $company->lname = $request->lname;
    //     $company->email = $request->email;
    //     $company->status = $request->status;
    //     $company->company = $request->company;
    //     $company->companyContact = $request->companyContact;
    //     $company->image = $filename;
    //     $company->save();



    //=======================update company======================//

    // $companies = Company::find($request->user_id);
    // $companies->Companycode = $request->Companycode;
    // $companies->name = $request->name;
    // $companies->mname = $request->mname;
    // $companies->lname = $request->lname;
    // $companies->email = $request->email;
    // $companies->company = $request->company;
    // $companies->companyContact = $request->companyContact;
    // $companies->status = $request->status;
    // $companies->updated_at = Carbon::now();
    // $companies->Save();

    //     $notification = array(
    //         'message' => 'Company Updated Successfully Added !!!',
    //         'alert-type' => 'success'
    //     );
    //     return Redirect()->back()->with($notification);
    // }




    public function delete($id)
    {
        //dd($id);
        $employee = User::find($id);
        //dd($employee);
        $employee->delete();
        $notification = array(
            'message' => 'Company record has been deleted successfully!!!',
            'alert-type' => 'error'
        );
        Alert::success('Deleted', "Company record has been deleted successfully!!!");
        return Redirect()->back()->with($notification);
    }
    public function SuperAdminProfile($id)
    {
        return view('pages.SuperAdmin.profile');
    }
    public function profileUpdate(Request $request)
    {
        //dd($request);

        $superadmin = User::find(Auth::user()->id);
        $superadmin->name = $request->name;
        $superadmin->email = $request->email;
        $superadmin->save();

        $notification = array(
            'message' => 'Super Admin Profile Updated successfully!!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', "Super Admin Profile Updated successfully!!!");
        return Redirect()->route('super-admin.home')->with($notification);
    }
    public function changePassStore(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'password_confirmation' => 'required|min:5',
        ]);
        $db_pass = Auth::user()->password;
        $current_password = $request->old_password;
        $newpass = $request->new_password;
        $confirmpass = $request->password_confirmation;

        if (Hash::check($current_password, $db_pass)) {
            if ($newpass === $confirmpass) {
                User::findOrFail(Auth::id())->update([
                    'password' => Hash::make($newpass)
                ]);

                Auth::logout();
                $notification = array(
                    'message' => 'Your Password Change Success. Now Login With New Password',
                    'alert-type' => 'success'
                );
                Alert::success('Success', "Password Changed Successfully. Now login with new password !!");
                return Redirect()->route('login')->with($notification);
            } else {

                $notification = array(
                    'message' => 'New Password And Confirm Password Not Same',
                    'alert-type' => 'error'
                );
                Alert::error('Error', "New password and confirmation password didn't match !!");
                return Redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Old Password Not Match',
                'alert-type' => 'error'
            );
            Alert::error('Error', "Old password didn't match !!");
            return Redirect()->back()->with($notification);
        }
    }
    public function UpdateSuperAdminPhoto(Request $request)
    {
        $image = $request->file('file');
        $filename = null;
        if ($image) {
            $filename = time() . $image->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'SuperAdmin/',
                $image,
                $filename
            );
        }

        $superadmin = User::find($request->id);
        $superadmin->image = $filename;

        $superadmin->save();
        $notification = array(
            'message' => 'Super Admin Profile Updated successfully!!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', "Super Admin Profile Updated successfully!!!");
        return Redirect()->back()->with($notification);
    }
    public function AdminProfile($id)
    {
        return view('pages.Admin.profile');
    }
    public function AdminprofileUpdate(Request $request)
    {
        // dd($request);

        $admin = User::find(Auth::user()->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        $company = Company::find($request->user_id);
        $company->mname = $request->mname;
        $company->lname = $request->lname;
        $company->company = $request->company;
        $company->company_contact = $request->company_contact;
        $company->save();
        $notification = array(
            'message' => 'Admin Profile Updated successfully!!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', "Admin Profile Updated successfully!!!");
        return Redirect('/admin/home/{id}')->with($notification);
    }
    public function AdminchangePassStore(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'password_confirmation' => 'required|min:5',
        ]);
        $db_pass = Auth::user()->password;
        $current_password = $request->old_password;
        $newpass = $request->new_password;
        $confirmpass = $request->password_confirmation;

        if (Hash::check($current_password, $db_pass)) {
            if ($newpass === $confirmpass) {
                User::findOrFail(Auth::id())->update([
                    'password' => Hash::make($newpass)
                ]);

                Auth::logout();
                $notification = array(
                    'message' => 'Your Password Change Success. Now Login With New Password',
                    'alert-type' => 'success'
                );
                Alert::success('Success', 'Your Password Change Success. Now Login With New Password');
                return Redirect()->route('login')->with($notification);
            } else {

                $notification = array(
                    'message' => 'New Password And Confirm Password Not Same',
                    'alert-type' => 'error'
                );
                Alert::error('Error', 'New Password And Confirmation Password did not match !!');
                return Redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Old Password Not Match',
                'alert-type' => 'error'
            );
            Alert::error('Error', "Old password didn't Match !!");
            return Redirect()->back()->with($notification);
        }
    }
    public function UpdateAdminPhoto(Request $request)
    {
        $image = $request->file('file');
        $filename = null;
        if ($image) {
            $filename = time() . $image->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'Admin/',
                $image,
                $filename
            );
        }

        $admin = User::find($request->id);
        $admin->image = $filename;

        $admin->save();
        $notification = array(
            'message' => 'Company Profile Updated successfully!!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', "Company Profile Updated successfully!!!");
        return Redirect()->back()->with($notification);
    }
}
