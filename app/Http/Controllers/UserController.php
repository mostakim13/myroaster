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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

Auth::logout();
        return redirect()->route('companies')
            ->with('success', 'User created successfully');
    }
    public function storeCompanies(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);
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

            $data = User::create([
                'name' => $request->name,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'email' => $request->email,
                'password' => Hash::make($password),
                'company' => $request->company,
                'companyContact' => $request->companyContact,
                'image' => $filename,
                'Status' => 1,
                'is_admin' => 1,
                'created_at' => Carbon::now()
            ]);
            $data->notify(new UserCredential($email_data));
            Session::flash('success', 'User has been Successfully Registered!!');
        });
        $companies = New Company();
        $companies->user_id = $request->id;
        $companies->Companycode = $request->Companycode;
        $companies->name = $request->name;
        $companies->mname = $request->mname;
        $companies->lname = $request->lname;
        $companies->email = $request->email;
        $companies->company = $request->company;
        $companies->companyContact = $request->companyContact;
        $companies->status = $request->status;
        $companies->created_at = Carbon::now();
        $companies -> Save();
        $notification = array(
            'message' => 'Company Admin Added Success',
            'alert-type' => 'success'
        );

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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

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
