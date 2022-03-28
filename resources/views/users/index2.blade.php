@extends('layouts.master')


@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Company</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Company Management</a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
          <div class="row" id="table-hover-animation">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <a href="#" class="btn btn-primary">Add New Company</a>
                      </div>
                      <div class="card-body">

                      </div>
                      <div class="table-responsive">
                          <table id="example" class="table table-hover-animation">
                              <thead>
                                  <tr>
                                      <th>Project</th>
                                      <th>Client</th>
                                      <th>Users</th>
                                      <th>Status</th>
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <img src="../../../app-assets/images/icons/angular.svg" class="mr-75" height="20" width="20" alt="Angular" />
                                          <span class="font-weight-bold">Angular Project</span>
                                      </td>
                                      <td>Peter Charls</td>
                                      <td>
                                          <div class="avatar-group">
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Lilian Nenez">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Alberto Glotzbach">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Alberto Glotzbach">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                          </div>
                                      </td>
                                      <td><span class="badge badge-pill badge-light-primary mr-1">Active</span></td>
                                      <td>
                                          <div class="dropdown">
                                              <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                  <i data-feather="more-vertical"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i data-feather="edit-2" class="mr-50"></i>
                                                      <span>Edit</span>
                                                  </a>
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i data-feather="trash" class="mr-50"></i>
                                                      <span>Delete</span>
                                                  </a>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <img src="../../../app-assets/images/icons/react.svg" class="mr-75" height="20" width="20" alt="React" />
                                          <span class="font-weight-bold">React Project</span>
                                      </td>
                                      <td>Ronald Frest</td>
                                      <td>
                                          <div class="avatar-group">
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Lilian Nenez">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Alberto Glotzbach">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Alberto Glotzbach">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                          </div>
                                      </td>
                                      <td><span class="badge badge-pill badge-light-success mr-1">Completed</span></td>
                                      <td>
                                          <div class="dropdown">
                                              <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                  <i data-feather="more-vertical"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i data-feather="edit-2" class="mr-50"></i>
                                                      <span>Edit</span>
                                                  </a>
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i data-feather="trash" class="mr-50"></i>
                                                      <span>Delete</span>
                                                  </a>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <img src="../../../app-assets/images/icons/vuejs.svg" class="mr-75" height="20" width="20" alt="Vuejs" />
                                          <span class="font-weight-bold">Vuejs Project</span>
                                      </td>
                                      <td>Jack Obes</td>
                                      <td>
                                          <div class="avatar-group">
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Lilian Nenez">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Alberto Glotzbach">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Alberto Glotzbach">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                          </div>
                                      </td>
                                      <td><span class="badge badge-pill badge-light-info mr-1">Scheduled</span></td>
                                      <td>
                                          <div class="dropdown">
                                              <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                  <i data-feather="more-vertical"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i data-feather="edit-2" class="mr-50"></i>
                                                      <span>Edit</span>
                                                  </a>
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i data-feather="trash" class="mr-50"></i>
                                                      <span>Delete</span>
                                                  </a>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <img src="../../../app-assets/images/icons/bootstrap.svg" class="mr-75" height="20" width="20" alt="Bootstrap" />
                                          <span class="font-weight-bold">Bootstrap Project</span>
                                      </td>
                                      <td>Jerry Milton</td>
                                      <td>
                                          <div class="avatar-group">
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Lilian Nenez">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Alberto Glotzbach">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Alberto Glotzbach">
                                                  <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" height="26" width="26" />
                                              </div>
                                          </div>
                                      </td>
                                      <td><span class="badge badge-pill badge-light-warning mr-1">Pending</span></td>
                                      <td>
                                          <div class="dropdown">
                                              <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                  <i data-feather="more-vertical"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i data-feather="edit-2" class="mr-50"></i>
                                                      <span>Edit</span>
                                                  </a>
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i data-feather="trash" class="mr-50"></i>
                                                      <span>Delete</span>
                                                  </a>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>


            <!-- Basic table -->

            <!--/ Basic table -->



        </div>
    </div>
</div>


@endsection
