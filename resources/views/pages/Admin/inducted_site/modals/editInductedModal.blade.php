<div class="modal fade text-left" id="editInduction{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Induction</h4>
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
                                    <form class="form" action="{{ route('update-induction') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Employee Name *</label>
                                                    <select class="form-control" name="employee_id"
                                                        value="{{ $row->employee_id }}"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($employees as $employee)
                                                            @if ($employee->status == 1)
                                                                <option value="{{ $employee->id }}"
                                                                    {{ $employee->id == $row->employee_id ? 'selected' : '' }}>
                                                                    {{ $employee->fname }}
                                                                </option>
                                                            @else
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Client Name *</label>
                                                    <select class="form-control" name="client_id"
                                                        value="{{ $row->client_id }}"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($clients as $client)
                                                            @if ($client->status == 1)
                                                                <option value="{{ $client->id }}"
                                                                    {{ $client->id == $row->client_id ? 'selected' : '' }}>
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
                                                    <select class="form-control" name="project_id"
                                                        value="{{ $row->project_id }}"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($projects as $project)
                                                            @if ($project->Status == 1)
                                                                <option value="{{ $project->id }}"
                                                                    {{ $project->id == $row->project_id ? 'selected' : '' }}>
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
                                                    <label for="email-id-column">Induction Date</label>
                                                    <input type="text" class="form-control flatpickr-basic"
                                                        name="induction_date" value="{{ $row->induction_date }}"
                                                        placeholder="Select induction date" required />
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
                <button type="submit" class="btn btn-success">Add Revenue</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
            </form>
        </div>
    </div>
</div>
