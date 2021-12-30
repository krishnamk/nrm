<!doctype html>
<html lang="en">
<!-- Mirrored from themesbrand.com/Ctrl-Next/layouts/vertical/auth-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2020 05:29:32 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Recover Password | Invoice App</title>
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
     <div class="row">
        <div class="col-lg-12 message"><?php message(); ?></div>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary"> Reset Password</h5>
                                        <!-- <p>Re-Password with Ctrl-Next.</p> -->
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
                                <div class="alert alert-success text-center mb-4" role="alert">
                                    Enter your Email and instructions will be sent to you!
                                </div>
                                <form class="form-horizontal" action="https://themesbrand.com/Ctrl-Next/layouts/vertical/index.html">
                                    <div class="form-group">
                                        <label for="useremail">Email</label>
                                        <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-12 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Remember It ? <a href="<?php echo base_url('login'); ?>" class="font-weight-medium text-primary"> Sign In here</a> </p>
                        <!-- <p>© 2020 Ctrl-Next. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p> -->
                    </div>
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
<!-- Mirrored from themesbrand.com/Ctrl-Next/layouts/vertical/auth-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2020 05:29:32 GMT -->
</html>