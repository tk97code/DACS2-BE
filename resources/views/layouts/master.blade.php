<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EduWell - Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href={{asset("assets/vendors/mdi/css/materialdesignicons.min.css")}}>
    <link rel="stylesheet" href={{asset("assets/vendors/ti-icons/css/themify-icons.css")}}>
    <link rel="stylesheet" href={{asset("assets/vendors/css/vendor.bundle.base.css")}}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">    <link rel="stylesheet" href={{asset("assets/vendors/font-awesome/css/font-awesome.min.css")}}>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href={{asset("assets/vendors/font-awesome/css/font-awesome.min.css")}}>
    <!-- <link rel="stylesheet" href={{asset("assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css")}}> -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" type="text/css" href={{asset("assets/css/style.css")}}>
    <!-- End layout styles -->
    <link rel="shortcut icon" href={{asset("assets/images/favicon.png")}}>

    <script src={{asset('vendor/jquery/jquery.min.js')}}></script>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      @include('layouts.navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('layouts.sidebar')
        <!-- partial -->
        <div class="main-panel">
            @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <!-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer> -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src={{asset(path: "assets/vendors/js/vendor.bundle.base.js")}}></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- <script src={{asset("assets/vendors/chart.js/chart.umd.js")}}></script> -->
    <!-- <script src={{asset("assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js")}}></script> -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src={{asset("assets/js/off-canvas.js")}}></script>
    <!-- <script src={{asset("assets/js/misc.js")}}></script> -->
    <script src={{asset("assets/js/settings.js")}}></script>
    <script src={{asset("assets/js/todolist.js")}}></script>
    <!-- <script src={{asset("assets/js/jquery.cookie.js")}}></script> -->
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src={{asset("assets/js/dashboard.js")}}></script>

    <style>

.eggy.top-right {
            z-index: 10000;
        }

    </style>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- End custom js for this page -->
  </body>

</html>