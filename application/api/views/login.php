<!doctype html>
<html lang="en">
<!-- Mirrored from themesbrand.com/Ctrl-Next/layouts/vertical/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2020 05:29:32 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Login | Invoice App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Multipurpose Billing Software" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico');?>">
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('assets/css/icons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('assets/css/app.min.css');?>" id="app-style" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                         <div class="row">
                            <div class="col-lg-12 message"><?php message(); ?></div>
                        </div>
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <!-- <p>Sign in to continue to Ctrl-Next.</p> -->
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="<?php echo base_url('assets/images/profile-img.png');?>" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0"> 
                            <div>
                                <a href="index.html">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="<?php echo base_url('assets/images/logo.svg');?>" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <!-- <form class="form-horizontal" action="https://themesbrand.com/Ctrl-Next/layouts/vertical/index.html"> -->
                                    <form class="form-horizontal" method="post" id="loginform">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username"placeholder="Enter username">
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                        <!-- <div class="mt-4 text-center">
                                            <h5 class="font-size-14 mb-3">Sign in with</h5>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                                        <i class="mdi mdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                        <i class="mdi mdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                        <i class="mdi mdi-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> -->
                                        <div class="mt-4 text-center">
                                            <a href="<?php echo base_url('forget_password');?>" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="mt-5 text-center">
                            <div>
                                <p>Don't have an account ? <a href="auth-register.html" class="font-weight-medium text-primary"> Signup now </a> </p>
                                <p>© 2020 Ctrl-Next. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url('assets/libs/jquery/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/metismenu/metisMenu.min.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js');?>"></script>
        <script src="<?php echo base_url('assets/libs/node-waves/waves.min.js');?>"></script>
        <!-- App js -->
        <script src="<?php echo base_url('assets/js/app.js');?>"></script>
    </body>
    <!-- Mirrored from themesbrand.com/Ctrl-Next/layouts/vertical/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2020 05:29:32 GMT -->
    </html>