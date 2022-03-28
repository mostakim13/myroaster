<div class="modal fade text-left" id="editCompany{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
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
                                  <form class="form" action="{{route('company-update')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$row->id}}">
                                      <div class="row">
                                          <div class="col-md-4 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">First Name</label>
                                                  <input type="text" value="{{$row->name}}" id="name" class="form-control" placeholder="First Name" name="name" required />
                                              </div>
                                          </div>
                                          <div class="col-md-4 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">Middle Name</label>
                                                  <input type="text" value="{{$row->mname}}" id="mname" class="form-control" placeholder="Middle name" name="mname" required />
                                              </div>
                                          </div>
                                          <div class="col-md-4 col-12">
                                              <div class="form-group">
                                                  <label for="last-name-column">Last Name</label>
                                                  <input type="text" value="{{$row->lname}}" id="lname" class="form-control" placeholder="Last Name" name="lname" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Email</label>
                                                  <input type="email" value="{{$row->email}}" id="email"  class="form-control" name="email" placeholder="Email" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Status</label>
                                                <select class="form-control" name="Status" aria-label="Default select example">
                                                    <option value="" disabled selected hidden>Please Choose...</option>
                                                    <option value="1"{{ $row->Status == 1? 'selected':'' }}>Active</option>
                                                    <option value="2"{{ $row->Status == 2? 'selected':'' }}>Inactive</option>

                                                  </select>
                                            </div>
                                        </div>

                                          <div class="card-header col-12">
                                              <h4 class="card-title">Company Info</h4>
                                          </div>
                                          <hr>

                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="company-column">Company</label>
                                                  <input type="text" value="{{$row->company}}" id="company" class="form-control" name="company" placeholder="Company" required/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="company-column">Company Contact Number</label>
                                                  <input type="number" value="{{$row->companyContact}}" id="companyContact" class="form-control" name="companyContact" placeholder="Company" required/>
                                              </div>
                                          </div>
                                          <div class="col-12">
                                              <div class="form-group">
                                                  <label for="company-column">Avatar</label>
                                                  <input type="file" id="image" class="form-control" name="file" placeholder="Company Image" />
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
