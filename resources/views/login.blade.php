<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Project Cost Management System</title>
    <!--favicon-->
    <link rel="icon" href="{{url('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{url('assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{url('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="{{url('assets/css/app-style.css')}}" rel="stylesheet" />


    <link href="{{url('assets/css/sidebar-menu.css')}}" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">

    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">

        <div class="loader-wrapper">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="card card-authentication1 mx-auto my-5">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img src="assets/images/logo-icon.png" alt="logo icon">
                    </div>
                    <div class="card-title text-uppercase text-center py-3">Sign In</div>
                    <form id="formLogin">
                        <div class="form-group">
                            <label for="exampleInputUsername" class="sr-only">Email</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="InputUsername" name="InputUsername" class="form-control input-shadow" placeholder="Enter Email">
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Password</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" id="InputPassword" name="InputPassword" class="form-control input-shadow" placeholder="Enter Password">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="icheck-material-white">
                                    <input type="checkbox" id="user-checkbox" checked="" />
                                    <label for="user-checkbox">Remember me</label>
                                </div>
                            </div>
                            <div class="form-group col-6 text-right">
                                <a href="authentication-reset-password.html">Reset Password</a>
                            </div>
                        </div>

                        <button type="submit" style="display: none;" class="btn btn-warning btn-block" id="btn-signin">Sign In</button>
                        <button type="submit" style="display: none;" class="btn btn-light btn-block" id="btn-signin-guest">Guest</button>
                    </form>
                    <button class="btn btn-warning btn-block" id="btn-signin-show">Sign In</button>
                        <button class="btn btn-light btn-block" id="btn-signin-guest-show">Guest</button>
                </div>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
            </div>
            <div class="right-sidebar-content">

                <p class="mb-0">Gaussion Texture</p>
                <hr>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>

                <p class="mb-0">Gradient Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                </ul>

            </div>
        </div>
        <!--end color cwitcher-->

    </div>
    <!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('assets/js/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/popper.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>

    <!-- sidebar-menu js -->
    <script src="{{url('assets/js/sidebar-menu.js')}}"></script>

    <!-- Custom scripts -->
    <script src="{{url('assets/js/app-script.js')}}"></script>
    <script src="{{url('assets/plugins/alerts-boxes/js/sweetalert.min.js')}}"></script>
    <script src="{{url('assets/plugins/alerts-boxes/js/sweet-alert-script.js')}}"></script>
    <script src="{{url('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>

    <script>
        var status=0;
        $('#btn-signin-show').click(function(e) {
            status=1;
            $('#btn-signin').click();
        });

        $('#btn-signin-guest-show').click(function(e) {
            status=0;
            $('#btn-signin').click();
        });

        $('#formLogin').validate({
            rules: {
                InputUsername: {
                    required: true,
                    minlength: 5
                },
                InputPassword: {
                    required: true,
                    minlength: 4
                }
            },
            // Specify validation error messages
            messages: {
                InputUsername: {
                    required: "Please enter your valid username",
                    minlength: "Your username must be at least 5 characters long"
                },
                InputPassword: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                }
            },

            submitHandler: function(form) {
                if(status==1) {
                    $.ajax({
                        type: "POST",
                        url: '/auth',
                        data: $('#formLogin').serialize() + "&_token=" + '{{ csrf_token() }}',
                        dataType: 'JSON'
                    }).done(function(msg) {
                        if (msg.status == '404') {
                            loginAlert();
                        } else {
                            if (msg == null || msg == "") {
                                loginAlert();
                            } else {
                                window.location = "/login";
                            }
                        }

                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        loginAlert();
                    });
                }

                else if(status==0) {
                    $.ajax({
                        type: "POST",
                        url: '/authGuest',
                        data: $('#formLogin').serialize() + "&_token=" + '{{ csrf_token() }}',
                        dataType: 'JSON'
                    }).done(function(msg) {
                        if (msg.status == '404') {
                            loginAlert();
                        } else {
                            if (msg == null || msg == "") {
                                loginAlert();
                            } else {
                                window.location = "/login";
                            }
                        }

                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        loginAlert();
                    });
                }
            }
        });
    </script>