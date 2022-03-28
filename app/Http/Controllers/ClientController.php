<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Auth;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  //Employee View File
  public function index($id)
  {
     $clients= Client::where('user_id',Auth::id())->get();
    return view('pages.Admin.client.index',compact('clients'));
  }
  public function store(Request $request)
  {
    $cimage =$request->file('file');
    $filename=null;
    if ($cimage) {
        $filename = time() . $cimage->getClientOriginalName();

        Storage::disk('public')->putFileAs(
            'clients/',
            $cimage,
            $filename
        );


    }

    $client= new Client;
    $client->user_id= Auth::id();
    $client->cname= $request->cname;
    $client->cemail= $request->cemail;
    $client->cnumber=$request->cnumber;
    $client->caddress= $request->caddress;
    $client->cstate= $request->cstate;
    $client->cpostal_code= $request->cpostal_code;
    $client->cperson= $request->cperson;
    $client->cimage= $filename;

    $client->save();
    $notification=array(
        'message'=>'Client Added Successfully Added !!!',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);


  }
  public function update(Request $request)
  {
    $image =$request->file('file');
    $filename=null;
    $uploadedFile = $request->file('image');
    $oldfilename = $client['cimage'] ?? 'demo.jpg';

    $oldfileexists = Storage::disk('public')->exists('clients/' . $oldfilename);

    if ($uploadedFile !== null) {

        if ($oldfileexists && $oldfilename != $uploadedFile) {
            //Delete old file
            Storage::disk('public')->delete('clients/' . $oldfilename);
        }
        $filename_modified = str_replace(' ', '_', $uploadedFile->getClientOriginalName());
        $filename = time() . '_' . $filename_modified;

        Storage::disk('public')->putFileAs(
            'clients/',
            $uploadedFile,
            $filename
        );

        $data['image'] = $filename;
     } elseif (empty($oldfileexists)) {
        // throw new \Exception('Client image not found!');
        $uploadedFile = null;
        $notification=array(
            'message'=>'Client Image Not Found !!!',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);

        //file check in storage
      }



    $client= Client::find($request->id);

    $client->user_id= Auth::id();
    $client->cname= $request->cname;
    $client->cemail= $request->cemail;
    $client->cnumber=$request->cnumber;
    $client->caddress= $request->caddress;
    $client->cstate= $request->cstate;
    $client->cpostal_code= $request->cpostal_code;
    $client->cperson= $request->cperson;
    $client->cimage= $filename;

    $client->save();
    $notification=array(
        'message'=>'Client Updated Successfully Added !!!',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
  }
  public function delete($id)
  {
    //dd($id);
    $client = Client::find($id);

    $client->delete();
    $notification=array(
        'message'=>'Client record has been deleted successfully!!!',
        'alert-type'=>'error'
    );
    return Redirect()->back()->with($notification);
  }
}
