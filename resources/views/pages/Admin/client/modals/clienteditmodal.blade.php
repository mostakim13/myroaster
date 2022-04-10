<div class="modal fade text-left" id="editClient{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Edit Client</h4>
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
                                  <form class="form" action="{{route('update-client')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$row->id}}">
                                      <div class="row">
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">Client Name *</label>
                                                  <input type="text" value="{{$row->cname}}"  class="form-control" placeholder="Client Name" name="cname" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">Email *</label>
                                                  <input type="email" value="{{$row->cemail}}"  class="form-control" placeholder="Email" name="cemail" required/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="last-name-column">Contact Number *</label>
                                                  <input type="text" value="{{$row->cnumber}}"  class="form-control" placeholder="Contact Number" name="cnumber" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">State *</label>
                                                  <input type="text" value="{{$row->cstate}}"  class="form-control" name="cstate" placeholder="State" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Address *</label>
                                                  <input type="text" value="{{$row->caddress}}"  class="form-control" name="caddress" placeholder="Address" required />
                                              </div>
                                          </div>

                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Postal Code *</label>
                                                  <input type="number" value="{{$row->cpostal_code}}"  class="form-control" name="cpostal_code" placeholder="Postal Code" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Contact Person *</label>
                                                  <input type="text" value="{{$row->cperson}}"  class="form-control" name="cperson" placeholder="Contact Person" required />
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
                                                  <label for="company-column">Avatar</label>
                                                  <input type="file" id="cimage" class="form-control" name="image" placeholder="Avatar"/>
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
                <button type="submit" class="btn btn-success">Update Client</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>
