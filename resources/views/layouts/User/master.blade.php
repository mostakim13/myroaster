@include('layouts.User.partials.header')

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
  @include('layouts.User.partials.nav')

    <!-- END: Header-->
    @include('layouts.User.partials.search')


    <!-- BEGIN: Main Menu-->
  @include('layouts.User.partials.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
    @yield('user_content')

  </div>
  </div>
  </div>

    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('layouts.User.partials.footer')
    <!-- END: Footer-->


    @include('layouts.User.partials.scripts')
</body>
<!-- END: Body-->

</html>
