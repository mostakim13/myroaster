@extends('layouts.Admin.master')
@push('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endpush

@php
function getTime($date)
{
    return \Carbon\Carbon::parse($date)->format('H:i');
}
@endphp
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
                        <th scope="col">Total Amount</th>
                    </tr>
                </thead>
                @php
                    $total_hours = 0;
                    $total_amount = 0;
                @endphp
                <tbody>
                    @foreach ($timekeepers as $timekeeper)
                        {{-- {{ dd($timekeeper) }} --}}
                        @php
                            $total_hours += floatval($timekeeper->total_hours);
                            $total_amount += floatval($timekeeper->total_amount);
                        @endphp
                        <tr>
                            <td><a style="color:black" href="#" data-toggle="modal"
                                    data-target="#dataShowModal{{ $timekeeper->id }}">{{ $timekeeper->fname }}</a>
                                @include(
                                    'pages.Admin.viewjob.modals.dataShowModal'
                                )
                            </td>


                            <td> {{ $timekeeper->total_hours }}</td>
                            <td>{{ $timekeeper->total_amount }}</td>
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th> <b>{{ $total_hours }} Hours </b> </th>
                        <th> <b>$ {{ $total_amount }} </b> </th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{-- <script>
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
    </script> --}}
    <script data-require="jqueryui@*" data-semver="1.10.0"
        src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.js" data-semver="1.9.4"
        data-require="datatables@*"></script>
    @push('scripts')
        <script>
            var myDate = function startDate(e) {
                return start_date = new Date(e.target.value);

            }

            console.log(myDate)

            function dateCalculate(e) {
                var end_date = new Date(e.target.value);
                console.log(end_date);
                var rate = document.getElementById('rate').value;
                var Difference_In_Time = end_date.getTime() - date.getTime();
                var Difference_In_hours = Difference_In_Time / (1000 * 3600);
                var amount = Difference_In_hours * rate;
                // console.log(Difference_In_Time);

                document.getElementById('duration').value = Difference_In_hours;
                document.getElementById('amount')
                    .value = amount;

            }
        </script>

        <script>
            $(function() {

                $("#newModalForm").validate({
                    rules: {
                        pName: {
                            required: true,
                            minlength: 8
                        },
                        action: "required"
                    },
                    messages: {
                        pName: {
                            required: "Please enter some data",
                            minlength: "Your data must be at least 8 characters"
                        },
                        action: "Please provide some data"
                    }
                });
            });
        </script>

        <script>
            $(document).on("change", "#client-select", function() {
                console.log($(this).val());
                if ($(this).val()) {
                    $.ajax({
                        url: "{{ route('ajax.client.project') }}/" + $(this).val(),
                        success: function(res) {
                            console.log(res)
                            // TODO
                            // create separate function

                            if (res.data.length) {
                                var htm =
                                    ` <option value="" disabled selected hidden>Please Choose...</option>`;
                                res.data.forEach(p => {
                                    htm += `<option value="${p.id}"> ${p.pName} </option>`;
                                })

                                $("#project-select").html(htm);
                            }
                        },
                    })
                }

            })


            $(document).ready(function() {


                // var roaster_date1, roaster_end, shift_start, shift_end;
                var isValid = true;

                var modalToTarget = document.getElementById("addTimeKeeper");

                function roasterEndTimeInit() {
                    $("#shift_end1").flatpickr({
                        enableTime: true,
                        altInput: false,
                        altInput: true,
                        altFormat: "d-m-Y H:i",
                        dateFormat: "Y-m-d H:i",
                        minDate: window.roaster_date1,
                        maxDate: window.roaster_end,
                        defaultDate: shift_end1,
                        time_24hr: true,
                        onOpen: function(selectedDates, dateStr, instance) {
                            modalToTarget.removeAttribute('tabindex');
                        },
                        onClose: function(selectedDates, dateStr, instance) {
                            modalToTarget.setAttribute('tabindex', -1);
                        },
                        onChange: function(selectedDates, dateStr, instance) {
                            if (new Date(window.roaster_date1) - new Date(selectedDates) > 0 || new Date(
                                    shift_start1) -
                                new Date(selectedDates) > 0) {
                                $("#shift_end_error").html(
                                    "Shift End should be after Roaster");
                                isValid = false;
                            } else {
                                $("#shift_end_error").html("");
                                isValid = true;
                            }
                        },
                    })
                }

                function roasterStartTimeInit() {
                    $("#shift_start1").flatpickr({
                        enableTime: true,
                        altInput: false,
                        altInput: true,
                        altFormat: "d-m-Y H:i",
                        dateFormat: "Y-m-d H:i",
                        minDate: window.roaster_date1,
                        maxDate: window.roaster_end,
                        defaultDate: window.shift_start1,
                        time_24hr: true,
                        onOpen: function(selectedDates, dateStr, instance) {
                            modalToTarget.removeAttribute('tabindex');
                        },
                        onClose: function(selectedDates, dateStr, instance) {
                            modalToTarget.setAttribute('tabindex', -1);
                        },
                        onChange: function(selectedDates, dateStr, instance) {
                            if (new Date(window.roaster_date1) - new Date(selectedDates) > 0) {
                                $("#shift_start_error").html("Shift Start should be after Roaster Time");
                                isValid = false;
                            } else {
                                $("#shift_start_error").html("");
                                isValid = true;
                            }
                            window.shift_start1 = selectedDates;

                            roasterEndTimeInit()
                        },
                    })
                }

                // console.log($("#roaster_date1").datetimepicker())

                const initDatePicker = () => {
                    $("#roaster_date1").flatpickr({
                        altInput: false,
                        altInput: true,
                        altFormat: "d-m-Y",
                        dateFormat: "Y-m-d",
                        defaultDate: window.roaster_date1,
                        onOpen: function(selectedDates, dateStr, instance) {
                            modalToTarget.removeAttribute('tabindex');
                        },
                        onClose: function(selectedDates, dateStr, instance) {
                            modalToTarget.setAttribute('tabindex', -1);
                        },

                        onChange: function(selectedDates, dateStr, instance) {

                            window.roaster_date1 = moment(new Date(selectedDates)).format('YYYY.MM.DD');
                            window.roaster_end = moment(new Date(selectedDates))
                                .add(24, "h")
                                .format(
                                    'YYYY.MM.DD');

                            roasterStartTimeInit();
                        },

                    });
                }

                initDatePicker();

                const initAllDatePicker = () => {
                    initDatePicker();
                    roasterStartTimeInit();
                    roasterEndTimeInit();
                }


                // Change modal to false to see that it doesn't happen there
                $("#dialog").modal({
                    autoOpen: true,
                    modal: true,
                });


                $(document).on("click", ".timekeer-btn", function() {

                    if (isValid) {
                        console.log($(this).closest("form").submit())
                    }
                })

                $(document).on("click", ".edit-btn", function() {
                    var rowData = $(this).data("row");

                    window.roaster_date1 = rowData.roaster_date1;
                    window.shift_start1 = rowData.shift_start1;
                    window.shift_end1 = rowData.shift_end1;
                    console.log($(this).data("copy"))

                    if (!$(this).data("copy"))
                        $("#timepeeper_id").val(rowData.id);

                    $("#employee_id").val(rowData.employee_id);
                    $("#client-select").val(rowData.client_id).trigger('change');

                    // $("#roaster_date1").val(rowData.roaster_date1)
                    // $("#shift_start").val(rowData.shift_start)
                    // $("#shift_end").val(rowData.shift_end)
                    $("#rate1").val(rowData.ratePerHour1)
                    $("#duration1").val(rowData.duration1)
                    $("#amount1").val(rowData.amount1)
                    $("#job").val(rowData.job)
                    $("#roaster").val(rowData.roaster)



                    $("#remarks").val(rowData.remarks)
                    $("#addTimeKeeper").modal("show")

                    setTimeout(() => {
                        $("#project-select").val(rowData.project_id);
                    }, 1000);

                    initAllDatePicker();

                })


                $(document).on("input", ".reactive", function() {
                    var start = $("#shift_start1").val();
                    var end = $("#shift_end1").val();
                    var rate1 = $("#rate1").val();

                    if (start && end) {
                        // calculate hours

                        var diff = (new Date(end) - new Date(start)) / 3600000;
                        console.log(diff)
                        if (diff > 47.99) {
                            $("#shift_end_error").html(
                                "Shift End  should be within 48 hours of roaster time ");
                            isValid = false;
                        } else if (diff < 0) {
                            $("#shift_end_error").html(
                                "Shift End Time should be after shift start");
                            isValid = false;
                        } else {
                            $("#shift_end_error").html(
                                "");
                            isValid = true;

                            $("#duration1").val(diff);
                            if (rate1) {
                                $("#amount1").val(parseFloat(rate1) * diff);
                            }

                        }

                    }
                })


            })
        </script>
    @endpush
@endsection
