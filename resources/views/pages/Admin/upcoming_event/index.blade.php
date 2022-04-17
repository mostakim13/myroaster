@extends('layouts.Admin.master')


@section('admincontent')
    @include('sweetalert::alert')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Upcomming Event</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="/admin/home/{{ Auth::user()->company->company_code }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Event Lists
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
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addEvent">Add Event</a>
                </div>
                @include(
                    'pages.Admin.upcoming_event.modals.addUpcomingeventModal'
                )

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
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($upcomingevents as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->client->cname }}</td>
                                        <td>{{ $row->project->pName }}</td>
                                        <td>{{ $row->event_date }}</td>
                                        <td>{{ $row->shift_start }}</td>
                                        <td>{{ $row->shift_end }}</td>
                                        <td>{{ $row->rate }}</td>
                                        <td>{{ $row->employee_id }}</td>
                                        <td>{{ $row->remarks }}</td>

                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#editEvent{{ $row->id }}"><i
                                                    data-feather='edit'></i></a>
                                            <a href="/admin/home/upcomingevent/delete/{{ $row->id }}"><i
                                                    data-feather='trash-2'></i></a>
                                        </td>
                                    </tr>
                                    @include(
                                        'pages.Admin.upcoming_event.modals.editUpcomingeventModal'
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
