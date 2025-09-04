<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>LT TMS</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" type="image/png" href="https://ltfoods.com/assets/images/favicon.ico">

    <!-- Mobile Specific Metas -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendors/styles/style.css" />
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>/images/lt-foods-uk-logo.jpg" alt="" style="height:66px" />
                    <!-- <h4>LT TMS</h4> -->
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?php echo base_url(); ?>vendors/images/login-page-img.png" alt="" />

                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To TMS</h2>
                        </div>
                        <?php if (! empty($message)): ?>
                            <div class="alert alert-success" role="alert">
                                <?= esc($message); ?>
                            </div>
                        <?php endif ?>
                         <?php if (! empty($errors)): ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $field => $error): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= esc($error) ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>
                        <form method="post" action="<?php echo base_url('users/login') ?>">
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" name="email" placeholder="Username" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text">
                                        <i class="icon-copy dw dw-user1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="**********" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text">
                                        <i class="dw dw-padlock1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        <a href="forgot-password.html">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                                    </div>
                                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                        OR
                                    </div>
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block" href="<?php echo base_url('/register') ?>">
                                            Register To Create Account
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="<?php echo base_url(); ?>vendors/scripts/core.js"></script>
    <script src="<?php echo base_url(); ?>vendors/scripts/script.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/scripts/process.js"></script>
    <script src="<?php echo base_url(); ?>vendors/scripts/layout-settings.js"></script>
</body>

</html>