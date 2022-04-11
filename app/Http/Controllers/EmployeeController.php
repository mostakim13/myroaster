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
use Alert;

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



        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $password = substr(str_shuffle($chars), 0, 10);
        $email_data['email'] = $request['email'];
        $email_data['name'] = $request['name'];
        $email_data['password'] = $password;
        DB::transaction(function () use ($request, $password, $email_data) {
            $GLOBALS['data'] = User::create([
                'name' => $request->fname,
                'email' => $request->email,
                'password' => Hash::make($password),
                'company' => $request->company,

            ]);
            $GLOBALS['data']->notify(new UserCredential($email_data));
        });
        $employee = new Employee;
        $employee->user_id = $GLOBALS['data']->id;
        $employee->fname = $request->fname;
        $employee->mname = $request->mname;
        $employee->lname = $request->lname;
        $employee->address = $request->address;
        $employee->state = $request->state;
        $employee->postal_code = $request->postal_code;
        $employee->email = $request->email;
        $employee->contact_number = $request->contact_number;
        $employee->status = $request->status;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->rsa_number = $request->rsa_number;
        $employee->rsa_expire_date = $request->rsa_expire_date;
        $employee->license_no = $request->license_no;
        $employee->license_expire_date = $request->license_expire_date;
        $employee->first_aid_license = $request->first_aid_license;
        $employee->company_code = Auth::user()->company->company_code;
        $employee->image = $filename;
        $employee->save();

        $notification = array(
            'message' => 'Employee Added Successfully Added !!!',
            'alert-type' => 'success'
        );
        Alert::success('Success', 'Employee Added Successfully !!!');
        return Redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'file' => 'required',
        //     'first_aid_license' => 'required',
        //     'fname' => 'required',
        //     'mname' => 'required',
        //     'lname' => 'required',
        //     'address' => 'required',
        //     'state' => 'required',
        //     'postal_code' => 'required',
        //     'email' => 'required|unique:users|email',
        //     'contact_number' => 'required|numeric',
        //     'date_of_birth' => 'required',
        //     'license_no' => 'required',
        //     'license_expire_date' => 'required',

        // ]);

        $rules = [
            'fname' => 'required',
            'email' => 'required|email|unique:users',
            'company_code' => 'required',
            'status' => 'required',
            'company' => 'required',
            'company_contact' => 'required'
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];
        $this->validate($request, $rules, $customMessages);

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
            Alert::error('Error', 'User Image Not Found !!!');
            // return Redirect()->back()->with($notification);

            //file check in storage
        }



        $employee = Employee::find($request->id);
        $employee->user_id = Auth::id();
        $employee->fname = $request->fname;
        $employee->mname = $request->mname;
        $employee->lname = $request->lname;
        $employee->address = $request->address;
        $employee->state = $request->state;
        $employee->status = $request->status;
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
        $data = Employee::findOrFail($id);

        User::where('id',$data->user_id)->delete();
        // $user_id = Employee::all();
        Employee::findOrFail($data->id)->delete();


        // $data =DB::table('employees')
        // ->Join('users','employees.user_id', '=','users.id')
        // ->where('employees.id', $id);
        // $data->delete();

        // DB::table('users')
        //     ->join('employees', 'users.id', 'employees.user_id')
        //     ->where('employees.id', $id)
        //     ->delete();

        $notification = array(
            'message' => 'Employee record has been deleted successfully!!!',
            'alert-type' => 'error'
        );
        Alert::success('Deleted', 'Employee record has been deleted successfully !!!');
        return Redirect()->back()->with($notification);
    }
}
