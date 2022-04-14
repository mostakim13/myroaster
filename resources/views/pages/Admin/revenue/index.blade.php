@extends('layouts.Admin.master')


@section('admincontent')
    @include('sweetalert::alert')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Revenue</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="/admin/home/{{ Auth::user()->company->company_code }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Revenue Lists
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addRevenue">Add Revenue</a>
                </div>
                @include('pages.Admin.revenue.modals.addRevenueModal')

                <div class="container">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover-animation table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Project Name</th>
                                    <th>Shift Start</th>
                                    <th>Shift End</th>
                                    <th>Hours</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($revenues as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->client_name }}</td>
                                        <td>{{ $row->project_name }}</td>
                                        <td>{{ $row->shift_start }}</td>
                                        <td>{{ $row->shift_end }}</td>
                                        <td>{{ $row->hours }}</td>
                                        <td>{{ $row->rate }}</td>
                                        <td>{{ $row->amount }}</td>
                                        <td>{{ $row->payment_date }}</td>
                                        <td>{{ $row->remarks }}</td>
                                        <td>
                                            <a href="#" data-toggle="modal"
                                                data-target="#editRevenue{{ $row->id }}"><i
                                                    data-feather='edit'></i></a>
                                            <a href="/admin/home/revenue/delete/{{ $row->id }}"><i
                                                    data-feather='trash-2'></i></a>
                                        </td>
                                    </tr>
                                    @include(
                                        'pages.Admin.revenue.modals.editRevenueModal'
                                    )
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
