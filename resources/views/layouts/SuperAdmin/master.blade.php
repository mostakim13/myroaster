@include('layouts.SuperAdmin.partials.header')

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
  @include('layouts.SuperAdmin.partials.nav')

    <!-- END: Header-->
    @include('layouts.SuperAdmin.partials.search')


    <!-- BEGIN: Main Menu-->
  @include('layouts.SuperAdmin.partials.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
    @yield('super_admincontent')

  </div>
  </div>
  </div>

    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('layouts.SuperAdmin.partials.footer')
    <!-- END: Footer-->


    @include('layouts.SuperAdmin.partials.scripts')

    <script src="{{ asset('backend') }}/lib/toastr/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type ="{{ Session::get('alert-type', 'info') }}"
            switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
        @endif
    </script>
</body>
<!-- END: Body-->

</html>
