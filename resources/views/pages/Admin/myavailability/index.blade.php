@extends('layouts.Admin.master')


@section('admincontent')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">My Availavility</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="/admin/home/{{ Auth::user()->company->company_code }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">My Availavility Lists
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
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add">My Availavility</a>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Opss! There have an error!
                        </div>
                    @endif
                </div>
                @include('pages.Admin.myavailability.modals.AddModal')


                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-hover-animation table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Remarks</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->employee->fname }}</td>
                                        <td>{{ $row->remarks }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->start_date)->format('d-m-Y h:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->end_date)->format('d-m-Y h:i') }}</td>

                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#edit{{ $row->id }}"><i
                                                    data-feather='edit'></i></a>
                                            <a href="/myavailability/delete/{{ $row->id }}"><i
                                                    data-feather='trash-2'></i></a>
                                        </td>
                                    </tr>
                                    @include(
                                        'pages.Admin.myavailability.modals.EditModal'
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
