<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Roaster-Status</h4>
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
                                  <form class="form" action="{{route('roasterStatus.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                      <div class="row">
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">Name *</label>
                                                  <input type="text"  class="form-control" placeholder="Name" name="name" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">Remarks</label>
                                                  <input type="text"  class="form-control" placeholder="remarks" name="remarks"/>
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="last-name-column">User Id *</label>
                                                  <input type="number"  class="form-control" placeholder="User Id" name="user_id" required />
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Company Code *</label>
                                                  <input type="number"  class="form-control" name="company_code" placeholder="Company Code" required />
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
                <button type="submit" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>
