<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Datatables | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- third party css -->
        <link href="{{asset('assets/template/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/template/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/template/css/vendor/buttons.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/template/css/vendor/select.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/template/css/vendor/fixedHeader.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/template/css/vendor/fixedColumns.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="{{asset('assets/template/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/template/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
        <link href="http://www.mysite.com/Jquery/javascript.js">  
        @yield('token')
        @yield('css')
    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
                @include('layouts.nav')
            <!-- Left Sidebar End -->
            

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                        @include('layouts.topbar')
                    <!-- end Topbar -->
                
                <!-- Start Content-->

                    <!-- Start Content-->
                    <div class="container-fluid">
                        @yield('content')
                    </div> <!-- container -->

                </div> <!-- content -->
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © KSPPS Simpul Berkah Sinergi - eoaclub.id
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->


            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <!-- Right Sidebar -->

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->

        <!-- bundle -->
        <script src="{{asset('assets/template/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/template/js/app.min.js')}}"></script>

        <!-- third party js -->
        <script src="{{asset('assets/template/js/vendor/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.bootstrap5.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/buttons.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/buttons.flash.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.select.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/fixedColumns.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/fixedHeader.bootstrap5.min.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{asset('assets/template/js/pages/demo.datatable-init.js')}}"></script>
        <!-- end demo js-->
        @stack('script')
    </body>
</html>
