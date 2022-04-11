@extends('layouts.Admin.master')


@section('admincontent')
    @include('sweetalert::alert')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Projects</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="/admin/home/{{ Auth::user()->company->company_code }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Project Lists
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Basic Tables start -->
    <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addProject">Add Project</a>
                </div>
                @include('pages.Admin.project.modals.projectAddModal')


                <div class="container">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover-animation table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Contact Name</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Client</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $project->pName }}</td>
                                        <td>{{ $project->cName }}</td>
                                        <td>{{ $project->cNumber }}</td>
                                        <td>
                                            @if ($project->Status == 1)
                                                <span class="badge badge-pill badge-light-success mr-1">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-light-danger mr-1">Inactive</span>
                                            @endif

                                        </td>
                                        <td>
                                            @if (isset($project->client->cname))
                                                {{ $project->client->cname }}
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal"
                                                data-target="#editProject{{ $project->id }}"><i
                                                    data-feather='edit'></i></a>
                                            <a href="/admin/home/project/delete/{{ $project->id }}"><i
                                                    data-feather='trash-2'></i></a>
                                        </td>
                                    </tr>
                                    @include(
                                        'pages.Admin.project.modals.projectEditModal'
                                    )
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Table head options end -->
    <!-- Basic Tables end -->
@endsection
