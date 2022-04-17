<div class="modal fade text-left" id="addProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Project</h4>
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
                                    <form class="form" action="{{ route('store-project') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Project Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Project Name"
                                                        name="pName" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Contact Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Contact Number" name="cName" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Contact Number<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="cNumber"
                                                        placeholder="Contact name" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Project Address<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="project_address"
                                                        placeholder="Project Address" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Project State<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="project_state"
                                                        placeholder="Project State" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Project Venue/Site<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="project_venue"
                                                        placeholder="Project Venue" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Select Status<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="Status"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="email-id-column">Clients<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="clientName"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        @foreach ($clients as $client)
                                                            @if ($client->status == 1)
                                                                <option value="{{ $client->id }}">
                                                                    {{ $client->cname }}
                                                                </option>
                                                            @else
                                                            @endif
                                                        @endforeach
                                                    </select>
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
                <button type="submit" class="btn btn-success">Add Project</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
            </form>
        </div>
    </div>
</div>
