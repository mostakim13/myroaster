<div class="modal fade text-left" id="editTimeKeeper{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Edit Schedule</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <form action="{{ route('update-timekeeper') }}" method="POST">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <label for="">Select Employee<span
                                                    class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="employee_id"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}" {{ $employee->id == $row->employee_id ? 'selected' : '' }}>
                                                                {{ $employee->fname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Select Client<span
                                                    class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="client_id"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($clients as $client)
                                                            <option value="{{ $client->id }}" {{ $client->id == $row->client_id ? 'selected' : '' }}>{{ $client->cname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Select Project<span
                                                    class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="project_id"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($projects as $project)
                                                            <option value="{{ $project->id }}" {{ $project->id == $row->project_id ? 'selected' : '' }}>{{ $project->pName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Roaster Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start" name="roaster_date" value="{{ $row->roaster_date }}"
                                                        class="form-control flatpickr-range"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift Start<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start_dates" name="shift_start" value="{{ $row->shift_start }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift End<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="end_dates" name="shift_end" value="{{ $row->shift_end }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" onchange="getDay()" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Duration<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="duration" class="form-control"
                                                        placeholder="Duration" id="day" readonly="readonly" value="{{ $row->duration }}"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Rate<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="rates" name="ratePerHour"
                                                        onchange="amountPerHours()" class="form-control"
                                                        placeholder="0" value="{{ $row->Rate }}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="amounts" name="amount" class="form-control"
                                                        placeholder="0" readonly="readonly" value="{{ $row->Amount }}" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Sign In</label>
                                                <div class="form-group">
                                                    <input type="text" name="sign_in" value="{{ $row->sign_in }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Sign Out</label>
                                                <div class="form-group">
                                                    <input type="text" name="Sign_out" value="{{ $row->sign_out }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Job Type ID<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="job_type_id" value="{{ $row->job_type_id }}" class="form-control"
                                                        placeholder="job type id" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Roaster Status<span
                                                    class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="roaster_status_id"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        <option value="1"
                                                        {{ $row->roaster_status_id== 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="2"
                                                        {{ $row->roaster_status_id == 2 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>


                                            {{-- <div class="col-md-12 col-12">
                                                <label for="email-id-column">Roaster type<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="roaster_type" value="{{ $row->roaster_type }}" class="form-control"
                                                        placeholder="Roaster type id" />
                                                </div>
                                            </div> --}}

                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Remarks</label>
                                                <div class="form-group">
                                                    <input type="text" name="remarks" value="{{ $row->remarks }}" class="form-control"
                                                        placeholder="Remarks" />
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update Roaster</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
            </form>
        </div>
    </div>
</div>
