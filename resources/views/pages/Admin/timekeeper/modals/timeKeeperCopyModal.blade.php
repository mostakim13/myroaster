<div class="modal fade text-left" id="copyTimeKeeper{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel17" aria-hidden="true">
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

                                        <input type="hidden" name="id" value="{{ $row->id }}">
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
                                                            <option value="{{ $employee->id }}"
                                                                {{ $employee->id == $row->employee_id ? 'selected' : '' }}>
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
                                                            <option value="{{ $client->id }}"
                                                                {{ $client->id == $row->client_id ? 'selected' : '' }}>
                                                                {{ $client->cname }}
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
                                                            <option value="{{ $project->id }}"
                                                                {{ $project->id == $row->project_id ? 'selected' : '' }}>
                                                                {{ $project->pName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Roaster Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="roaster_date"
                                                        value="{{ $row->roaster_date }}"
                                                        class="form-control flatpickr-range"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift Start<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start_date1{{ $row->id }}"
                                                        name="shift_start" value="{{ $row->shift_start }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift End<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="end_date1{{ $row->id }}"
                                                        name="shift_end" value="{{ $row->shift_end }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                                        onchange="getDuration()" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Duration<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="duration" class="form-control"
                                                        placeholder="Duration" id="day1{{ $row->id }}"
                                                        readonly="readonly" value="{{ $row->duration }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Rate<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="hourlyRate{{ $row->id }}"
                                                        name="ratePerHour" onchange="roasterAmountPerHour()"
                                                        class="form-control" placeholder="0"
                                                        value="{{ $row->ratePerHour }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="roasterAmount{{ $row->id }}"
                                                        name="amount" class="form-control" placeholder="0"
                                                        readonly="readonly" value="{{ $row->amount }}" required />
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Job Type<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="job_type" value="{{ $row->job_type }}"
                                                        class="form-control" placeholder="job type" required />
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Roaster Status<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="roaster_status"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        <option value="1"
                                                            {{ $row->roaster_status == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="2"
                                                            {{ $row->roaster_status == 2 ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-12 col-12">
                                                <label for="">Roaster Type<span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="roaster_type"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                       
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option> 
                                                       
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Remarks</label>
                                                <div class="form-group">
                                                    <input type="text" name="remarks" value="{{ $row->remarks }}"
                                                        class="form-control" placeholder="Remarks" />
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
                <button type="submit" class="btn btn-success">Copy Roaster</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
            </form>
        </div>
    </div>
</div>
