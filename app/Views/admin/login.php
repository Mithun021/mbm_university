
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>public/admin/assets/images/favicon.ico">

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
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="<?= base_url() ?>" class="text-dark font-size-22 font-family-secondary">
                                            <img src="<?= base_url() ?>public/assets/image/logo.jpg" alt="" height="90">
                                            </a>
                                        </div>
                                        <h1 class="h5 mb-1">Welcome Back!</h1>
                                        <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                                        <form class="user"  id="adminLoginForm">
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user" id="username" placeholder="Phone/Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="userpassword" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Log In </button>
                                        </form>

                                        <div class="row mt-4">
                                            <!-- <div class="col-12 text-center">
                                                <p class="text-muted mb-2"><a href="pages-recoverpw.html" class="text-muted font-weight-medium ml-1">Forgot your password?</a></p>
                                            </div> end col -->
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
    <!-- end page -->

    <!-- jQuery  -->
    <script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>public/admin/assets/js/metismenu.min.js"></script>
    <script src="<?= base_url() ?>public/admin/assets/js/waves.js"></script>
    <script src="<?= base_url() ?>public/admin/assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url() ?>public/admin/assets/js/theme.js"></script>
    <!-- Sweet Alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Jquery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#adminLoginForm").validate({
                rules:{
                    username : {
                        required: true,
                        minlength: 3
                    },
                    password : {
                        required: true,
                        minlength: 6 // Minimum length for password
                    }
                },messages: {
                    username : {
                        required: "Required User ID",
                        minlength: "Your ID must be at least 3 characters long"
                    },
                    password : {
                        required: "Please enter a password",
                        minlength: "Password must be at least 6 characters"
                    }
                },
                submitHandler: function (form) {
                    var requestedData = {
                        userId : $('#username').val(),
                        userPassword : $('#userpassword').val()
                    }
                    // console.log(requestedData);
                    $.ajax({
                        type: "post",
                        url: "login",
                        data: requestedData,
                        success: function (response) {
                            if(response == "dataMatch") {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Account Successfully Login",
                                    showConfirmButton: false,
                                    timer: 2500
                                }).then(function(){
                                    window.location.href = "<?= base_url() ?>admin/";
                                });
                                
                            }  
                            else{
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: response,
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                            }
                        }
                    });
                }
            });
    });
</script>

</body>

</html>