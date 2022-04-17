<div class="modal fade text-left" id="editEvent{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Edit Event</h4>
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
                                    <form class="form" action="{{ route('update-upcomingevent') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Client Name *</label>
                                                    <select class="form-control" name="client_name"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($clients as $client)
                                                            @if ($client->status == 1)
                                                                <option value="{{ $client->id }}"
                                                                    {{ $client->id == $row->client_name ? 'selected' : '' }}>
                                                                    {{ $client->cname }}
                                                                </option>
                                                            @else
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Project Name*</label>
                                                    <select class="form-control" name="project_name"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($projects as $project)
                                                            @if ($project->Status == 1)
                                                                <option value="{{ $project->id }}"
                                                                    {{ $project->id == $row->project_name ? 'selected' : '' }}>
                                                                    {{ $project->pName }}
                                                                </option>
                                                            @else
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Employee Name *</label>
                                                    <select class="form-control" name="employee_id"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($employees as $employee)
                                                            @if ($employee->status == 1)
                                                                <option value="{{ $employee->id }}"
                                                                    {{ $employee->id == $row->employee_id ? 'selected' : '' }}>
                                                                    {{ $employee->fname }}</option>
                                                            @else
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Event Date *</label>
                                                    <input type="text" class="form-control flatpickr-basic"
                                                        placeholder="Select event date"
                                                        value="{{ $row->event_date }}" name="event_date" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Shift Start *</label>
                                                    <input type="text" class="form-control flatpickr-date-time"
                                                        name="shift_start" value="{{ $row->shift_start }}"
                                                        placeholder="Select shift start" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Shift End *</label>
                                                    <input type="text" class="form-control flatpickr-date-time"
                                                        name="shift_end" value="{{ $row->shift_end }}"
                                                        placeholder="Select shift end" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Rate *</label>
                                                    <input type="number" class="form-control" name="rate"
                                                        value="{{ $row->rate }}" placeholder="Enter rate"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Remarks</label>
                                                    <input type="text" class="form-control" name="remarks"
                                                        value="{{ $row->remarks }}" placeholder="Enter remarks"
                                                        required />
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
                <button type="submit" class="btn btn-success">Update Event</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
            </form>
        </div>
    </div>
</div>
