@extends('layouts.SuperAdmin.master')


@section('super_admincontent')
@include('sweetalert::alert')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Companies</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Company Lists
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
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addCompany">Add Company</a>
                </div>
                @include(
                    'pages.SuperAdmin.Company.modals.add_company_modal'
                )
                <div class="container">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover-animation table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Company</th>
                                    <th>Contact</th>
                                    <th>Admin Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($companies as $row)
                                    <tr>
                                        <td>
                                            @if ($row->image != null)
                                                <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top"
                                                    title="" class="avatar pull-up my-0" data-original-title="#">
                                                    <img src="{{ asset("storage/clients/$row->image") }}" alt="Avatar"
                                                        height="26" width="26" />
                                                </div>
                                            @else
                                                No image
                                            @endif
                                        </td>

                                        <td>

                                            {{ $row->company }}
                                        </td>
                                        <td> {{ $row->company_contact }}</td>
                                        <td> {{ $row->name }}</td>
                                        <td>
                                            {{ $row->email }}
                                        </td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge badge-pill badge-light-success mr-1">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-light-danger mr-1">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#editCompany{{ $row->id }}"><i
                                                    data-feather='edit'></i></a>
                                            <!-- <a href="/super-admin/company/delete/{{ $row->id }}"><i data-feather='trash-2'></i></a> -->

                                            <a href="#"><i data-feather='eye'></i></a>
                                        </td>
                                        @include(
                                            'pages.SuperAdmin.Company.modals.edit_company_modal'
                                        )
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if (Session::has('sweet_alert.alert'))
<script>
  swal({!! Session::get('sweet_alert.alert') !!});
</script>
@endif
<script>
    $(document).on('click', '.button', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure!",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "{{url('/destroy')}}",
                data: {id:id},
                success: function (data) {
                              //
                    }
            });
    });
});
</script>

@endsection
