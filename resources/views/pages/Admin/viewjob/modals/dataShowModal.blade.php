<style>
    .modal-dialog {
        overflow-y: initial !important
    }

    .modal-body {
        height: 60vh;
        overflow-y: auto;
    }

</style>
<div class="modal fade text-left" id="dataShowModal{{ $timekeeper->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Schedule</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- {{ dd($timekeeper->id) }} --}}
            <form action="{{ route('store-timekeeper') }}" method="POST" id="newModalForm">
                <input type="hidden" id="timepeeper_id" name="timepeeper_id">
                @csrf
                <div class="modal-body">
                    <section id="multiple-column-form">
                        <div class="row">
                            @php
                                $employee_id = App\Models\Employee::all();
                                $timekeeperData = App\Models\TimeKeeper::where('employee_id', $timekeeper->id)->get();
                                // $timekeeperData = App\Models\TimeKeeper::with('employee')
                                //     ->where('id', '=', 'employee.id')
                                //     ->get();

                                // $timekeeperData = DB::table('time_keepers')
                                //     ->select('time_keepers.*', 'employees.*')
                                //     ->join('employees', 'employees.id', '=', 'time_keepers.employee_id')
                                //     ->get();
                            @endphp
                            <div class="col-12">
                                <table class="table table-hover-animation table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee</th>
                                            <th>Client</th>
                                            <th>Project</th>
                                            <th>Roaster Date</th>
                                            <th>Shift Start</th>
                                            <th>Shift Etart</th>
                                            <th>Duration</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($timekeeperData as $k => $row)
                                            {{-- {{ dd($row) }} --}}
                                            @php
                                                $json = json_encode($row->toArray(), false);

                                            @endphp
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>
                                                    {{ $row->employee->fname }}

                                                </td>
                                                <td>
                                                    @if (isset($row->client->cname))
                                                        {{ $row->client->cname }}
                                                    @else
                                                        Null
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($row->project->pName))
                                                        {{ $row->project->pName }}
                                                    @else
                                                        Null
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $row->roaster_date }}
                                                </td>
                                                <td>
                                                    {{ getTime($row->shift_start) }}
                                                </td>
                                                <td>
                                                    {{ getTime($row->shift_end) }}
                                                </td>
                                                <td>
                                                    {{ $row->duration }}
                                                </td>
                                                <td>
                                                    {{ $row->ratePerHour }}
                                                </td>
                                                <td>
                                                    {{ $row->amount }}
                                                </td>

                                                <td>
                                                    <div class="row">
                                                        <a style="color:black; margin-right:5px;" href="#"
                                                            data-toggle="modal"
                                                            data-target="#editDataModal{{ $row->id }}"><i
                                                                data-feather='edit'></i></a>
                                                        {{-- <a href="#" type="button" class="btn btn-outline-primary"
                                                            data-toggle="modal"
                                                            data-target="#editDataModal{{ $row->id }}">
                                                            <i data-feather='edit'></i>
                                                        </a> --}}

                                                        {{-- <button class="edit-btn btn-link btn"
                                                            data-row="{{ $json }}"><i
                                                                data-feather='edit'></i></button> --}}

                                                        {{-- <button data-copy="true" class="edit-btn btn-link btn"
                                                            data-row="{{ $json }}"><i
                                                                data-feather='copy'></i></button> --}}
                                                        <a href="/admin/home/timekeeper/delete/{{ $row->id }}"><i
                                                                data-feather='trash-2'></i></a>
                                                    </div>

                                                </td>
                                                @include(
                                                    'pages.Admin.viewjob.modals.editDataModal'
                                                )
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success timekeer-btn">Submit</button>
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
                </div>
            </form>
        </div>
    </div>
</div>
