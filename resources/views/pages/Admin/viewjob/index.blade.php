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
        @include('sweetalert::alert')
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

                    <form action="{{ route('search') }}" method="POST" id="dates_form">
                        @csrf
                        <div class="row row-xs">
                            <div class="col-md-5 col-lg-4 ">
                                <input type="date" class="form-control date_range_filter date"
                                    placeholder="Select Start Date" name="start_date" id="start_date datepicker_from"
                                    required="required">
                            </div>
                            <div class="col-md-5 col-lg-4 mt-3 mt-md-0 ">
                                <input type="date" class="form-control" placeholder="Select End Date"
                                    id="end_date datepicker_to" required="required" name="end_date"
                                    min="0000-00-00 00:00:00">
                            </div>
                            <div class="col-md-2 col-lg-3 mt-3 mt-md-0">
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
                        <th scope="col">Employee Name</th>
                        <th scope="col">Total Hours</th>
                        <th scope="col">Total Amount $</th>
                        <!-- <th>Actual Start Date</th>
                        <th>Actual Etart Date</th> -->
                    </tr>
                </thead>
                <tbody>

                    @foreach ($timekeepers as $timekeeper)
                        <tr>
                            <td>{{ $timekeeper->employee->fname }}
                                </td>
                            <td>{{ $timekeeper->duration }} hours</td>
                            <td>${{ $timekeeper->amount }}</td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(function() {
            var oTable = $('#datatable').DataTable({
                "oLanguage": {
                    "sSearch": "Filter Data"
                },
                "iDisplayLength": -1,
                "sPaginationType": "full_numbers",

            });




        // Date range filter
        minDateFilter = "";
        maxDateFilter = "";

        $.fn.dataTableExt.afnFiltering.push(
            function(oSettings, aData, iDataIndex) {
                if (typeof aData._date == 'undefined') {
                    aData._date = new Date(aData[0]).getTime();
                }

                if (minDateFilter && !isNaN(minDateFilter)) {
                    if (aData._date < minDateFilter) {
                        return false;
                    }
                }

                if (maxDateFilter && !isNaN(maxDateFilter)) {
                    if (aData._date > maxDateFilter) {
                        return false;
                    }
                }

                return true;
            }
        );
    </script>
    <script data-require="jqueryui@*" data-semver="1.10.0"
        src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.js" data-semver="1.9.4"
        data-require="datatables@*"></script>
@endsection
