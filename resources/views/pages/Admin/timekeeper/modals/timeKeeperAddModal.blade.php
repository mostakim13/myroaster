<div class="modal fade text-left" id="addTimeKeeper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Schedule</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store-timekeeper') }}" method="POST" id="newModalForm">
                <input type="hidden" id="timepeeper_id" name="timepeeper_id">
                @csrf
                <div class="modal-body">
                    <section id="multiple-column-form">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <label for="">Select Employee</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="employee_id" id="employee_id"
                                                        aria-label="Default select example" required>
                                                        <option value="{{ old('employee_id') }}" disabled selected
                                                            hidden>Please Choose...</option>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}">
                                                                {{ $employee->fname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Select Client</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="client_id" id="client-select"
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
                                                <label for="">Select Project</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="project_id" id="project-select"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($projects as $project)
                                                            <option value="{{ $project->id }}">{{ $project->pName }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Roaster Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" readonly id="roaster_date" name="roaster_date"
                                                        class="form-control" placeholder="DD-MM-YYYY" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift Start<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" readonly id="shift_start" name="shift_start"
                                                        class="form-control reactive" placeholder="Start" required />
                                                    <span id="shift_start_error" class="text-danger text-small"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift Ends Date & Time<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" readonly id="shift_end" name="shift_end"
                                                        class="form-control reactive" placeholder="End" required />
                                                    <span id="shift_end_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Duration<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="duration" name="duration"
                                                        class="form-control" placeholder="Duration" id="days"
                                                        readonly="readonly" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Amount Per Hour<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="number" id="rate" name="ratePerHour"
                                                        class="form-control reactive" placeholder="0" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="amount" name="amount" class="form-control"
                                                        placeholder="0" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <label for="">Select Job Type</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="job_type_id" id="job"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($job_types as $job_type)
                                                            <option value="{{ $job_type->id }}">
                                                                {{ $job_type->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-12 col-6">-->
                                            <!--    <label for="">Select Roaster Type</label>-->
                                            <!--    <div class="form-group">-->
                                            <!--        <select class="form-control" name="roaster_type" id="raoster-select"-->
                                            <!--            aria-label="Default select example" required>-->
                                            <!--            <option value="" disabled selected hidden>Please Choose...-->
                                            <!--            </option>-->
                                            <!--            @foreach ($roaster_types as $roaster_type)
-->
                                            <!--                <option value="{{ $roaster_type->id }}">{{ $roaster_type->roaster_type }}-->
                                            <!--                </option>-->
                                            <!--
@endforeach-->

                                            <!--        </select>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="col-md-12 col-6">
                                                <label for="">Select Roaster Status</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="roaster_status_id" id="roaster"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($roaster_status as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Remarks<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="remarks" id="remarks"
                                                        class="form-control" placeholder="remarks" />
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
                    <button type="button" class="btn btn-success timekeer-btn">Submit</button>
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
                </div>
            </form>
        </div>
    </div>
</div>
