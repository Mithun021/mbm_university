
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Student Forget Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="NIPER" name="description" />
    <meta content="Dcode MAterials" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>public/assets/image/logo.jpg">

    <!-- App css -->
    <link href="<?= base_url() ?>public/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>public/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>public/admin/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <style>
        .error{
            color: red;
            font-weight: normal;
        }
    </style>

</head>

<body style="background-image: url('<?= base_url() ?>public/admin/assets/images/niperclg.jpg'); background-size: cover;">
 
<div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-4">
                                        <?php if (session()->getFlashdata('status')): ?>
                                            <?= session()->getFlashdata('status') ?>
                                        <?php endif; ?> 
                                        <h1 class="h5 mb-1">Forget Password</h1>
                                        <p class="text-muted mb-4">Enter your enrollment no or email address and we'll send you an email with instructions to reset your password.</p>
                                        <form method="post" action="<?= base_url() ?>forget-password">
                                            <div class="form-group">
                                                <label for="exampleInputEmail">Email / Enrollment no</label>
                                                <input type="text" class="form-control form-control-user" name="student_id" placeholder="Email / Enrollment no" required minlength="3">
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Forget Password </button>
                                            
                                        </form>

                                        <div class="row mt-5">
                                            <div class="col-12 text-center">
                                                <p class="text-muted">Already have account?  <a href="<?= base_url() ?>stdlogin" class="text-muted font-weight-medium ml-1"><b>Sign In</b></a></p>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    <!-- jQuery  -->
    <script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>public/admin/assets/js/metismenu.min.js"></script>
    <script src="<?= base_url() ?>public/admin/assets/js/waves.js"></script>
    <script src="<?= base_url() ?>public/admin/assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url() ?>public/admin/assets/js/theme.js"></script>
    

</body>

</html>