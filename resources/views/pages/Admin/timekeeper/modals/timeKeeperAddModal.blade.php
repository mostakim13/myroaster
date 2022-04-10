<div class="modal fade text-left" id="addTimeKeeper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Schedule</h4>
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
                                    <form action="{{ route('store-timekeeper') }}" method="POST">
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
                                                            <option value="{{ $employee->id }}">
                                                                {{ $employee->fname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Select Client<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="client_id"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($clients as $client)
                                                            <option value="{{ $client->id }}">{{ $client->cname }}
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
                                                            <option value="{{ $project->id }}">{{ $project->pName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Roaster Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start" name="roaster_date"
                                                        class="form-control flatpickr-range"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift Start<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start_date" name="shift_start"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift End<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="end_date" name="shift_end"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" onchange="getDays()" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Duration<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="duration" class="form-control"
                                                        placeholder="Duration" id="days" readonly="readonly" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Rate<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="rate" name="ratePerHour"
                                                        onchange="amountPerHour()" class="form-control"
                                                        placeholder="0" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="amount" name="amount" class="form-control"
                                                        placeholder="0" readonly="readonly" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Sign In</label>
                                                <div class="form-group">
                                                    <input type="text" name="sign_in"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Sign Out</label>
                                                <div class="form-group">
                                                    <input type="text" name="sign_out"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" required />
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-12 col-12">
                                                <label for="email-id-column">Job Type ID<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="job_type_id" class="form-control"
                                                        placeholder="job type id" required/>
                                                </div>
                                            </div> --}}
                                            @php
                                                $job_types = App\Models\JobType::all();
                                            @endphp
                                            <div class="col-md-12 col-12">
                                                <label for="">Job Type ID<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="job_type_id"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($job_types as $job_type)
                                                            <option value="{{ $job_type->id }}">
                                                                {{ $job_type->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <label for="">Roaster Type ID<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="roaster_type_id"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @php
                                                $roaster_statuses = App\Models\RoasterStatus::all();
                                            @endphp

                                            <div class="col-md-12 col-12">
                                                <label for="">Roaster Status<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="roaster_status_id"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($roaster_statuses as $roaster_status)
                                                            <option value="{{ $roaster_status->id }}">
                                                                {{ $roaster_status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            {{-- <div class="col-md-12 col-12">
                                                <label for="email-id-column">Roaster type<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="roaster_type" class="form-control"
                                                        placeholder="Roaster type id" />
                                                </div>
                                            </div> --}}

                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Remarks</label>
                                                <div class="form-group">
                                                    <input type="text" name="remarks" class="form-control"
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
                <button type="submit" class="btn btn-success">Create Roaster</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
            </form>
        </div>
    </div>
</div>
