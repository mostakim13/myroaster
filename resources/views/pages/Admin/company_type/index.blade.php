@extends('layouts.Admin.master')


@section('admincontent')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Company-Type</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Company-Type Lists
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
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add">Add Company-Type</a>
            </div>
            @include('pages.Admin.company_type.modals.AddModal')


            <div class="container">
              <div class="table-responsive">
                  <table class="table table-hover-animation table-bordered mb-4">
                      <thead>
                          <tr>
                            <th>#</th>
                              <th>Name</th>
                              <th>Remarks</th>
                              <th>User Id</th>
                              <th>Company Code</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $row)

                          <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->remarks}}</td>
                              <td>{{$row->user_id}}</td>
                            <td>{{$row->company_code}}</td>

                              <td>
                                <a href="#" data-toggle="modal" data-target="#edit{{$row->id}}"><i data-feather='edit'></i></a>
                                  <a href="/company/type/delete/{{$row->id}}"><i data-feather='trash-2'></i></a>
                              </td>
                          </tr>
                          @include('pages.Admin.company_type.modals.EditModal')
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