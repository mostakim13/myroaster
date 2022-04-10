<div class="modal fade text-left" id="editEmployee{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Edit Employee</h4>
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
                                  <form class="form" action="{{route('update-employee')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$row->id}}">
                                      <div class="row">
                                          <div class="col-md-4 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">First Name *</label>
                                                  <input type="text" id="name" class="form-control" value="{{$row->fname}}" placeholder="First Name" name="fname" required />
                                              </div>
                                          </div>
                                          <div class="col-md-4 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">Middle Name</label>
                                                  <input type="text" id="mname" value="{{$row->mname}}" class="form-control" placeholder="Middle name" name="mname"/>
                                              </div>
                                          </div>
                                          <div class="col-md-4 col-12">
                                              <div class="form-group">
                                                  <label for="last-name-column">Last Name *</label>
                                                  <input type="text" id="lname" value="{{$row->lname}}" class="form-control" placeholder="Last Name" name="lname"/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Address *</label>
                                                  <input type="text"  class="form-control" value="{{$row->address}}" name="address" placeholder="Address" required />
                                              </div>
                                          </div>
                                          <div class="col-md-3 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">State *</label>
                                                  <input type="text"  class="form-control" value="{{$row->state}}" name="state" placeholder="State" required />
                                              </div>
                                          </div>
                                          <div class="col-md-3 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Postal Code *</label>
                                                  <input type="number"  class="form-control" value="{{$row->postal_code}}" name="postal_code" placeholder="Postal Code" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Email *</label>
                                                  <input type="email"  class="form-control" value="{{$row->email}}" name="email" placeholder="Email" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Contact Number *</label>
                                                  <input type="number"  class="form-control" value="{{$row->contact_number}}" name="contact_number" placeholder="Contact Number" required />
                                              </div>
                                            </div>

                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="company-column">Date of Birth *</label>
                                                  <input type="date" value="{{$row->date_of_birth}}"  class="form-control flatpickr-basic" name="date_of_birth" placeholder="Date Of Birth" required/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                            <label for="email-id-column">Select Status<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select class="form-control" name="status"
                                                    aria-label="Default select example" required>
                                                    <option value="" disabled selected hidden>Please Choose...
                                                    </option>
                                                    <option value="1" {{ $row->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="2" {{ $row->status == 2 ? 'selected' : '' }}>Inactive</option>

                                                </select>
                                            </div>
                                        </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="company-column">RSA Number</label>
                                                  <input type="number" value="{{$row->rsa_number}}"  class="form-control" name="rsa_number" placeholder="RSA Number" required/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                            <label for="company-column">RSA Expire Date *</label>
                                              <div class="form-group">
                                                  <input type="date" value="{{$row->rsa_expire_date}}"  class="form-control flatpickr-basic" name="rsa_expire_date" placeholder="RSA Expire Date" required/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="company-column">Sec License No</label>
                                                  <input type="number" value="{{$row->license_no}}"  class="form-control" name="license_no" placeholder="License No" required/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                <label for="company-column">License Expire Date *</label>
                                                  <input type="date" value="{{$row->license_expire_date}}"  class="form-control flatpickr-basic" name="license_expire_date" placeholder="License Expire Date" required/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="company-column">Avatar</label>
                                                  <input type="file" id="image" class="form-control" name="employee_image" placeholder="Avatar"/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                <label for="company-column">First Aid License Expire Date *</label>
                                                  <input type="date" value="{{$row->first_aid_license}}" class="form-control flatpickr-basic" name="first_aid_license" placeholder="First Aid License Expire Date" required />
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
                <button type="submit" class="btn btn-success">Update Employee</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>
