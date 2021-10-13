<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>PCMS - - Project Cost Management System</title>
  @include('style')  
</head>

<body class="bg-theme bg-theme1">

  {{-- <!-- start loader -->
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner">
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <!-- end loader --> --}}

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start sidebar-wrapper-->
    @include('sidebar')
    <!--End sidebar-wrapper-->
    @include('header')
    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">
        @yield('content')
      </div>
      <!-- End container-fluid-->

    </div>
    <!--End content-wrapper-->


    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start footer-->
    @include('footer')
    <!--End footer-->

    <!--start color switcher-->
    @include('sidebar-filter')
    <!--end color cwitcher-->

  </div>
  <!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  @include('script')
</body>
</html>

