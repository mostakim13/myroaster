@extends('layouts.Admin.master')
@section('admincontent')
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables_themeroller.css" rel="stylesheet"
        data-semver="1.9.4" data-require="datatables@*" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.css" rel="stylesheet"
        data-semver="1.9.4" data-require="datatables@*" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table_jui.css" rel="stylesheet"
        data-semver="1.9.4" data-require="datatables@*" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table.css" rel="stylesheet" data-semver="1.9.4"
        data-require="datatables@*" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_page.css" rel="stylesheet" data-semver="1.9.4"
        data-require="datatables@*" />
    <link data-require="jqueryui@*" data-semver="1.10.0" rel="stylesheet"
        href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card p-0">
                <div class="card-header text-primary border-top-0 border-left-0 border-right-0">
                    <h3 class="card-title text-primary d-inline">
                        Select Project Dates
                    </h3>
                    <span class="float-right">
                        <i class="fa fa-chevron-up clickable"></i>
                    </span>
                </div>
                <div class="card-body">

                    <form action="{{ route('searchData') }}" method="POST" id="dates_form">
                        @csrf
                        <div class="row row-xs">
                            <div class="col-md-3 col-3">
                                <input type="date" class="form-control date_range_filter date"
                                    placeholder="Select Start Date" name="start_dates" id="start_date datepicker_from"
                                    required="required">
                            </div>
                            <div class="col-md-3 col-3 mt-3 mt-md-0 ">
                                <input type="date" class="form-control" placeholder="Select End Date"
                                    id="end_date datepicker_to" required="required" name="end_dates"
                                    min="0000-00-00 00:00:00">
                            </div>
                            <div class="col-md-3 col-3 mt-3 mt-md-0 ">
                                @php
                                    $timekeeperID = App\Models\Timekeeper::first();
                                @endphp
                                {{-- {{ dd($timekeeperID->id) }} --}}
                                <select class="form-control" name="employee_id" id="employee_id"
                                    aria-label="Default select example" required>
                                    <option value="{{ old('employee_id') }}" disabled selected hidden>Please Choose...
                                    </option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->fname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-3 mt-3 mt-md-0">
                                <button type="submit" class="btn btn btn-outline-primary btn-block"
                                    id="btn_search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Button trigger modal -->
            </div>


            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">Remarks</th>
                        <th scope="col">App Start Time</th>
                        <th scope="col">App End Time</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum = 0;
                        $sumDuration = 0;
                    @endphp
                    @foreach ($timekeepers as $timekeeper)
                        <tr>
                            <td>{{ $timekeeper->remarks }}</td>
                            <td>{{ $timekeeper->shift_start }}</td>
                            <td>{{ $timekeeper->shift_end }}</td>
                            <td>{{ $timekeeper->duration }}</td>
                            <td>{{ $timekeeper->ratePerHour }}</td>
                            <td>{{ $timekeeper->amount }}</td>
                            {{-- @php
                                $sumDuration += $timekeeper->duration;
                                $sum += $timekeeper->amount;
                            @endphp --}}
                            <td>
                                <a href="" class="btn btn-primary btn-sm"><i data-feather='edit'></i></a>
                                <a href="" class="btn btn-danger btn-sm"><i data-feather='trash-2'></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <script data-require="jqueryui@*" data-semver="1.10.0"
        src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.js" data-semver="1.9.4"
        data-require="datatables@*"></script>
@endsection
