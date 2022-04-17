@extends('layouts.Admin.master')


@section('admincontent')
    @include('sweetalert::alert')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Employees</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="/admin/home/{{ Auth::user()->company->company_code }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Employee Lists
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
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addEmployee">Add Employee</a>
                </div>
                @include('pages.Admin.employee.modals.employeeaddmodal')

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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if ($row->image != null)

                                                <img src="{{ asset('storage/employees/' . $row->image) }}" alt="Avatar"
                                                    height="26" width="26" />
                                            @else
                                                No image
                                            @endif
                                        </td>
                                        <td>
                                            {{ $row->fname }}
                                        </td>
                                        <td>{{ $row->email }}

                                        </td>
                                        <td>{{ $row->contact_number }}</td>

                                <td>
                                    @if ($row->status == 1)
                                        <span class="badge badge-pill badge-light-success mr-1">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-light-danger mr-1">Inactive</span>
                                    @endif
                                </td>


                                        <td>
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <input type="hidden" name="user_id" value="{{ $row->user_id }}">
                                            <a href="#" data-toggle="modal"
                                                data-target="#editEmployee{{ $row->id }}"><i
                                                    data-feather='edit'></i></a>
                                            <a href="/admin/home/employee/delete/{{ $row->id }}"><i
                                                    data-feather='trash-2'></i></a>
                                        </td>

                                    </tr>
                                    @include(
                                        'pages.Admin.employee.modals.employeeeditmodal'
                                    )
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
