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
                                                    <select class="form-control" name="Empid"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}" {{ $employee->id == $row->Empid ? 'selected' : '' }}>
                                                                {{ $employee->fname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Select Client<span
                                                    class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="Clientid"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($clients as $client)
                                                            <option value="{{ $client->id }}" {{ $client->id == $row->Clientid ? 'selected' : '' }}>{{ $client->cname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Select Project<span
                                                    class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="Projectid"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($projects as $project)
                                                            <option value="{{ $project->id }}" {{ $project->id == $row->Projectid ? 'selected' : '' }}>{{ $project->pName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>





                                            {{-- <div class="col-md-6 col-12">
                                                <label for="email-id-column">Project Start Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start" name="projectStartDate" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div> --}}

                                            {{-- <div class="col-md-6 col-12">
                                                <label for="email-id-column">Project End Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="end" name="projectEndDate" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div> --}}


                                            {{-- <div class="col-md-6 col-12">
                                                <label for="email-id-column">Roaster Start Date & Time<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start_date" name="roasterStartDate"
                                                        class="form-control flatpickr-date-time" placeholder="Start"/>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-6 col-12">
                                                <label for="email-id-column">Roaster Ends Date & Time<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="end_date" name="roasterEndDate"
                                                        class="form-control flatpickr-date-time"
                                                         placeholder="End" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" onchange="getDays()"/>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Roaster Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start" name="Roasterdate" value="{{ $row->Roasterdate }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift Start<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="start_dates" name="Shiftstart" value="{{ $row->Shiftstart }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Shift End<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="end_dates" name="Shiftend" value="{{ $row->Shiftend }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" onchange="getDay()" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Duration<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="Duration" class="form-control"
                                                        placeholder="Duration" id="day" readonly="readonly" value="{{ $row->Duration }}"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Rate<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="rates" name="Rate"
                                                        onchange="amountPerHours()" class="form-control"
                                                        placeholder="0" value="{{ $row->Rate }}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Amount<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" id="amounts" name="Amount" class="form-control"
                                                        placeholder="0" readonly="readonly" value="{{ $row->Amount }}" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Sign On</label>
                                                <div class="form-group">
                                                    <input type="text" name="Signon" value="{{ $row->Signon }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Sign Off</label>
                                                <div class="form-group">
                                                    <input type="text" name="Signoff" value="{{ $row->Signoff }}"
                                                        class="form-control flatpickr-date-time"
                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Job Type ID<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="Jobtypeid" value="{{ $row->Jobtypeid }}" class="form-control"
                                                        placeholder="job type id" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="">Roaster Status<span
                                                    class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="RoasterstatusID"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        <option value="1"
                                                        {{ $row->RoasterstatusID == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="2"
                                                        {{ $row->RoasterstatusID == 2 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Roaster type<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <input type="text" name="Roastertypeid" value="{{ $row->Roastertypeid }}" class="form-control"
                                                        placeholder="Roaster type id" />
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label for="email-id-column">Remarks</label>
                                                <div class="form-group">
                                                    <input type="text" name="Remarks" value="{{ $row->Remarks }}" class="form-control"
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
