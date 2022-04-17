<div class="modal fade text-left" id="edit{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add My-Availavility</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <spanbutton aria-hidden="true">&times;</spanbutton>
            </div>
            <div class="modal-body">
              <section id="multiple-column-form">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">

                              <div class="card-body">
                                  <form class="form" action="{{route('myAvailability.update')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    <input type="hidden" name="id" value="{{$row->id}}">
                                      <div class="row">
                                       <div class="col-md-6 col-12">
                                                <label for="">Select Employee<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <select class="form-control" name="employee_id"
                                                        aria-label="Default select example" required>
                                                        <option value="" disabled selected hidden>Please Choose...
                                                        </option>
                                    @foreach ($employees as $employee)
                                    @if($employee->status == 1)
                                    <option value="{{ $employee->id }}"
                    {{ $employee->id == $row->employee_id ? 'selected' : '' }}>
                            {{ $employee->fname }}</option>
                            @else
                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                          <!--<div class="col-md-6 col-12">-->
                                          <!--    <div class="form-group">-->
                                          <!--        <label for="last-name-column">Company Code *</label>-->
                                          <!--        <input type="number" value="{{$row->company_code}}" class="form-control" placeholder="Company Code" name="company_code" required />-->
                                          <!--    </div>-->
                                          <!--</div>-->
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">Start Date *</label>
                                                <input type="datetime-local" value="{{\Carbon\Carbon::parse($row->start_date)->format('Y-m-d')}}T{{\Carbon\Carbon::parse($row->start_date)->format('h:i')}}" class="form-control" name="start_date" required/>
                                            </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="email-id-column">End Date *</label>
                                                <input type="datetime-local" value="{{\Carbon\Carbon::parse($row->end_date)->format('Y-m-d')}}T{{\Carbon\Carbon::parse($row->end_date)->format('h:i')}}" class="form-control" name="end_date" required/>
                                            </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="first-name-column">Remarks</label>
                                                  <input type="text" value="{{$row->remarks}}" class="form-control" placeholder="remarks" name="remarks"/>
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
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>
