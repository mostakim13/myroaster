@extends('layouts.Admin.master')


@section('admincontent')
    @include('sweetalert::alert')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Event Request</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active">Request Lists
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
                <br>
                <div class="container">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover-animation table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Project Name</th>
                                    <th>Event Date</th>
                                    <th>Shift Start</th>
                                    <th>Shift End</th>
                                    <th>Rate</th>
                                    <th>Employee Name</th>
                                    <th>Employee Email</th>
                                    <th>Employee Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventrequests as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->upcomingevent->client->cname }}</td>
                                        <td>{{ $row->upcomingevent->project->pName }}</td>
                                        <td>{{ $row->upcomingevent->event_date }}</td>
                                        <td>{{ $row->upcomingevent->shift_start }}</td>
                                        <td>{{ $row->upcomingevent->shift_end }}</td>
                                        <td>{{ $row->upcomingevent->rate }}</td>
                                        <td>{{ $row->employee->fname }}</td>
                                        <td>{{ $row->employee->email }}</td>
                                        <td>{{ $row->employee->contact_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
