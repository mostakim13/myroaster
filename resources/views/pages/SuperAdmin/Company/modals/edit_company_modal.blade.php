<div class="modal fade text-left" id="editCompany{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Edit Company</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Company And Login Info</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('company-update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">

                                        <input type="hidden" name="user_id" value="{{ $row->user_id }}">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">First Name</label>
                                                    <input type="text" value="{{ $row->name }}" id="name"
                                                        class="form-control" placeholder="First Name" name="name"
                                                        required />
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Middle Name</label>
                                                    <input type="text" value="{{ $row->mname }}" id="mname"
                                                        class="form-control" placeholder="Middle name" name="mname" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Last Name</label>
                                                    <input type="text" value="{{ $row->lname }}" id="lname"
                                                        class="form-control" placeholder="Last Name" name="lname" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Email</label>
                                                    <input type="email" value="{{ $row->email }}" id="email"
                                                        class="form-control" name="email" placeholder="Email"
                                                        required />
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Status</label>
                                                    <select class="form-control" name="status"
                                                        aria-label="Default select example">
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                                        <option value="1" {{ $row->status == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="2" {{ $row->status == 2 ? 'selected' : '' }}>
                                                            Inactive</option>

                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="card-header col-12">
                                                <h4 class="card-title">Company Info</h4>
                                            </div>
                                            <hr>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Company</label>
                                                    <input type="text" value="{{ $row->company }}" id="company"
                                                        class="form-control" name="company" placeholder="Company"
                                                        required />
                                                    @error('company')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Company Contact Number</label>
                                                    <input type="number" value="{{ $row->company_contact }}"
                                                        id="companyContact" class="form-control"
                                                        name="company_contact" placeholder="Company" required />
                                                    @error('company_contact')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Avatar</label>
                                                    <input type="file" id="image" class="form-control" name="file"
                                                        placeholder="Company Image" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Company Code</label>
                                                    <input type="text" class="form-control" name="company_code"
                                                        placeholder="Company Code" value="{{ $row->company_code }}"
                                                        required />
                                                    @error('company_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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
                <button type="submit" class="btn btn-success">Update Company</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
            </form>
        </div>
    </div>
</div>
