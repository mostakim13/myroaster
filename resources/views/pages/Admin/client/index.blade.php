@extends('layouts.Admin.master')


@section('admincontent')
@include('sweetalert::alert')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Clients</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home/{{ Auth::user()->company->company_code }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Client Lists
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Basic Tables start -->
<!-- Table Hover Animation start -->
<div class="row" id="table-hover-animation">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addClient">Add Client</a>
            </div>
            @include('pages.Admin.client.modals.clientaddmodal')


            <div class="container">
              <div class="table-responsive">
                  <table id="example" class="table table-hover-animation table-bordered">
                      <thead>
                          <tr>
                            <th>#</th>
                            <th>Image</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Number</th>
                              <th>Contact Person</th>
                              <th>Address</th>
                              <th>State</th>
                              <th>Post</th>



                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($clients as $row)

                          <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                                @if ($row->cimage != null)
                              <img src="{{asset('storage/clients/'.$row->cimage)}}" alt="Avatar" height="26" width="26" />
                              </td>
                              @else
                                  No image
                              @endif
                            <td>

                              {{$row->cname}}


                              </td>
                            <td>{{$row->cemail}}</td>
                            <td>{{$row->cnumber}}</td>
                              <td>{{$row->cperson}}</td>
                            <td>{{$row->caddress}}</td>
                            <td>{{$row->cstate}}</td>
                            <td>{{$row->cpostal_code}}</td>


                              <td>
                                @if ($row->status == 1)
                                        <span class="badge badge-pill badge-light-success mr-1">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-light-danger mr-1">Inactive</span>
                                    @endif
                              </td>

                              <td>
                                <a href="#" data-toggle="modal" data-target="#editClient{{$row->id}}"><i data-feather='edit'></i></a>
                                  <a href="/admin/home/client/delete/{{$row->id}}"><i data-feather='trash-2'></i></a>
                              </td>
                          </tr>
                          @include('pages.Admin.client.modals.clienteditmodal')
                          @endforeach



                      </tbody>
                  </table>
              </div>
            </div>

        </div>
    </div>
</div>
<!-- Table head options end -->
<!-- Basic Tables end -->





@endsection
