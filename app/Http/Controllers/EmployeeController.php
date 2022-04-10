<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Exception;
use Auth;
use Carbon\Carbon;
use DB;
use Session;
use Hash;
use App\Notifications\UserCredential;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Employee View File
    public function index($id)
    {
        $employees = Employee::where('user_id', Auth::id())->get();
        return view('pages.Admin.employee.index', compact('employees'));
    }

    //Employee Store
    public function store(Request $request)
    {
        $image = $request->file('file');
        $filename = null;
        if ($image) {
            $filename = time() . $image->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'employees/',
                $image,
                $filename
            );
        }
        $employee = new Employee;
        $employee->user_id = Auth::id();
        $employee->fname = $request->fname;
        $employee->mname = $request->mname;
        $employee->lname = $request->lname;
        $employee->address = $request->address;
        $employee->state = $request->state;
        $employee->postal_code = $request->postal_code;
        $employee->email = $request->email;
        $employee->contact_number = $request->contact_number;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->rsa_number = $request->rsa_number;
        $employee->rsa_expire_date = $request->rsa_expire_date;
        $employee->license_no = $request->license_no;
        $employee->license_expire_date = $request->license_expire_date;
        $employee->first_aid_license = $request->first_aid_license;
        $employee->company_code = Auth::user()->company->company_code;
        $employee->image = $filename;
        $employee->save();


        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $password = substr(str_shuffle($chars), 0, 10);
        $email_data['email'] = $request['email'];
        $email_data['name'] = $request['name'];
        $email_data['password'] = $password;
        DB::transaction(function () use ($request, $password, $email_data) {
            $data = User::create([
                'name' => $request->lname,
                'email' => $request->email,
                'password' => Hash::make($password),
                'company' => $request->company,
            ]);
            $data->notify(new UserCredential($email_data));
            Session::flash('success', 'User has been Successfully Registered!!');
        });

        $notification = array(
            'message' => 'Employee Added Successfully Added !!!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'first_aid_license' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'email' => 'required|unique:users|email',
            'contact_number' => 'required|numeric',
            'date_of_birth' => 'required',
            'license_no' => 'required',
            'license_expire_date' => 'required',

        ]);
        $image = $request->file('file');
        $filename = null;
        $uploadedFile = $request->file('employee_image');
        $oldfilename = $employee['image'] ?? 'demo.jpg';

        $oldfileexists = Storage::disk('public')->exists('employees/' . $oldfilename);

        if ($uploadedFile !== null) {

            if ($oldfileexists && $oldfilename != $uploadedFile) {
                //Delete old file
                Storage::disk('public')->delete('employees/' . $oldfilename);
            }
            $filename_modified = str_replace(' ', '_', $uploadedFile->getClientOriginalName());
            $filename = time() . '_' . $filename_modified;

            Storage::disk('public')->putFileAs(
                'employees/',
                $uploadedFile,
                $filename
            );

            $data['image'] = $filename;
        } elseif (empty($oldfileexists)) {
            // throw new \Exception('Employee image not found!');
            $uploadedFile = null;
            $notification = array(
                'message' => 'User Image Not Found !!!',
                'alert-type' => 'error'
            );
            Alert::success('Success', 'User Image Not Found !!!');
            return Redirect()->back()->with($notification);

            //file check in storage
        }



        $employee = Employee::find($request->id);
        $employee->user_id = Auth::id();
        $employee->fname = $request->fname;
        $employee->mname = $request->mname;
        $employee->lname = $request->lname;
        $employee->address = $request->address;
        $employee->state = $request->state;
        $employee->postal_code = $request->postal_code;
        $employee->email = $request->email;
        $employee->contact_number = $request->contact_number;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->license_no = $request->license_no;
        $employee->license_expire_date = $request->license_expire_date;
        $employee->first_aid_license = $request->first_aid_license;
        $employee->image = $filename;

        $employee->save();
        $notification = array(
            'message' => 'Employee Updated Successfully Added !!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', 'Employee Updated Successfully !!!');
        return Redirect()->back()->with($notification);
    }
    public function delete($id)
    {
        //dd($id);
        $employee = Employee::find($id);
        //dd($employee);
        $employee->delete();
        $notification = array(
            'message' => 'Employee record has been deleted successfully!!!',
            'alert-type' => 'error'
        );
        Alert::success('Deleted', 'Employee record has been deleted successfully !!!');
        return Redirect()->back()->with($notification);
    }
}
