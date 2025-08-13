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
                <a href="login.html">
                    <!-- <img src="<?php echo base_url(); ?>vendors/images/deskapp-logo.svg" alt="" /> -->
                    <h4>LT TMS</h4>
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
                            <h2 class="text-center text-primary">Register</h2>
                        </div>
                        <form method="post" action="<?php echo base_url('users/register') ?>">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">First Name*</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" autocomplete="false"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Last Name*</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" autocomplete="false" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Email Address*</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email Id" autocomplete="false" />
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Password*</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" autocomplete="false" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Confirm Password*</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password_confirm" placeholder="Enter Confirm Password" autocomplete="false" />
                                </div>
                            </div>
                            <div class="input-group mb-0">
                                <input class="btn btn-primary btn-lg btn-block"  type="submit" value="Submit">
                            </div>
                            <?php if (! empty($errors)): ?>
                                <div class="alert alert-danger">
                                <?php foreach ($errors as $field => $error): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= esc($error) ?>
                                    </div>
                                <?php endforeach ?>
                                </div>
                            <?php endif ?>
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