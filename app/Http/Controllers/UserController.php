<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Session;
use Alert;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Notifications\UserCredential;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index2', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|same:confirm-password|max:255|unique:users',
            'roles' => 'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];
        $this->validate($request, $rules, $customMessages);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        Auth::logout();
        return redirect()->route('companies')
            ->with('success', 'User created successfully');
    }


    //===========================================================================//
    //========================Company Details Store Start========================//
    public function storeCompanies(Request $request)
    {
        $rules = [
            'name' => 'required',
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
        if ($image) {
            $filename = time() . $image->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'clients/',
                $image,
                $filename
            );
        }
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $password = substr(str_shuffle($chars), 0, 10);
        $email_data['email'] = $request['email'];
        $email_data['name'] = $request['name'];
        $email_data['password'] = $password;

        DB::transaction(function () use ($request, $password, $email_data, $filename) {

            $GLOBALS['data'] = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'is_admin' => 1,
                'created_at' => Carbon::now()
            ]);
            $GLOBALS['data']->notify(new UserCredential($email_data));
        });
        //=========================================================================//
        //================Store Company Details in Company Table===================//
        $companies = new Company();
        $companies->user_id =  $GLOBALS['data']->id;
        $companies->company_code = $request->company_code;
        $companies->image = $filename;
        $companies->mname = $request->mname;
        $companies->lname = $request->lname;
        $companies->status = $request->status;
        $companies->company = $request->company;
        $companies->company_contact = $request->company_contact;
        $companies->created_at = Carbon::now();
        $companies->Save();

        $notification = array(
            'message' => 'Company Admin Added Success',
            'alert-type' => 'success'
        );
        Alert::success('Success', 'Company Admin Added Successfully!');
        return Redirect()->back()->with($notification);
    }
     //===========================================================================//
    //========================Company Details Store End========================//

    //=======================================================================================//
    //===================================Update Company Details==============================//
    public function updateCompany(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
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
        if ($image) {
            $filename = time() . $image->getClientOriginalName();

            Storage::disk('public')->putFileAs(
                'clients/',
                $image,
                $filename
            );
        }

        $user = User::find($request->user_id);
        $user ->name = $request->name;
        $user ->email = $request->email;
        $user->save();

        $company = Company::find($request->id);
        $company->mname = $request->mname;
        $company->lname = $request->lname;
        $company->status = $request->status;
        $company->company = $request->company;
        $company->company_code = $request->company_code;
        $company->company_contact = $request->company_contact;
        $company->image = $filename;
        $company->save();
        $notification = array(
            'message' => 'Company Updated Successfully Added!',
            'alert-type' => 'success'
        );
        Alert::success('Success', 'Company Updated Successfully!');
        return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|same:confirm-password|max:255|unique:users',
            'roles' => 'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];
        $this->validate($request, $rules, $customMessages);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        if (auth()->user()->is_admin == 1) {
            return redirect()->route('admin.home')->with('success', 'Admin updated successfully');
        } elseif (auth()->user()->super_admin == 1) {
            return redirect()->route('super-admin.home')->with('success', 'Super Admin updated successfully');
        } else {
            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
