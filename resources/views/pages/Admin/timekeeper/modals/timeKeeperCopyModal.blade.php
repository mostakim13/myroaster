<div class="modal fade text-left" id="copyTimeKeeper{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Copy Schedule</h4>
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
                                                <label for="">Select Employee</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="employeeID" aria-label="Default select example" required>

                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}">
                                                                {{ $employee->lname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Select Client</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="clientID" aria-label="Default select example" required>

                                                        @foreach ($clients as $client)
                                                            <option value="{{ $client->id }}">{{ $client->cname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Select Project</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="projectID" aria-label="Default select example">

                                                        @foreach ($projects as $project)
                                                            <option value="{{ $project->id }}">{{ $project->pName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Project Start Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="date" name="projectStartDate" id="start" class="form-control"
                                                        min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Project Ends Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="date" name="projectEndDate" class="form-control" id="end"
                                                        min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Roaster Start Date & Time<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start_date1" value="{{ $row->roasterStartDate }}" name="roasterStartDate"
                                                        class="form-control flatpickr-date-time" placeholder="Start"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Roaster Ends Date & Time<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="end_date1" name="roasterEndDate"
                                                        class="form-control flatpickr-date-time" value="{{ $row->roasterEndDate }}"
                                                         placeholder="End" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" onchange="getDuration()"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Duration<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="duration" value="{{ $row->duration }}" class="form-control" placeholder="Duration"
                                                    id="day1" readonly="readonly"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Amount Per Hour<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="hourlyRate" value="{{ $row->ratePerHour }}" name="ratePerHour" onchange="roasterAmountPerHour()" class="form-control" placeholder="0"/>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="roasterAmount" value="{{ $row->amount }}" name="amount" class="form-control" placeholder="0" readonly="readonly"/>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Remarks<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="remarks" value="{{ $row->remarks }}" class="form-control" placeholder="remarks" />
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
