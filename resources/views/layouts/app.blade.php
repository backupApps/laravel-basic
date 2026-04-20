<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.css')
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.leftbar')
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="main-content">
            <!-- Start Page-content -->
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- End Page-content -->

            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.rightbar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    @include('layouts.js')
</body>

</html>
