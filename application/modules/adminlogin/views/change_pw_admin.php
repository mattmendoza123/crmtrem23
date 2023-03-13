<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/assets/images/logo1.png">
    <title>Change Password | Tremendio Portal</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/adminwrap/" />
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>assets/module/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- page css -->
    <link href="<?= base_url() ?>assets/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url() ?>assets/css/colors/default.css" id="theme" rel="stylesheet">
    <link href="<?= base_url() ?>assets/module/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/mystyle.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
     .modal-backdrop {
      z-index: -1 !important;
     }
     .forgot-password{
         background: linear-gradient(to left, #006400, #32cd32) !important;
         border: none;
         color: white;
         padding: 12px 40px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-family: 'Montserrat', serif !important;
         font-size: 12px;
         border-radius: 5px;
          border: 1px;
     }
     .forgot-password:hover{
         background: #FFD700 !important;
         color: #191919;
     }
     .form-control{
         background-color: #fffdd0;
         border: 1px solid  #007f58;
     }
     .modal-header {
         background: linear-gradient(to left, #006400, #32cd32) !important;
     }
     .modal-header #ForgotPassModalTitle,
        #ForgotPassModalTitle
        {
           color: #fff;
        }
        .login-box.card {
             top: -8% !important;
             border: 1px solid #0c2873 !important;
             border-radius: 30px;
         }

         .login-box {
         width: 430px !important;
         margin: 0 auto; }

         img.main_logo {
         max-width: 70% !important;
         display: block;
         margin-left: 10px;
         margin-right: 10px;
         margin: 16px 50px 2px 52px;
         width: 100%;
     }
     </style>
</head>



<body>
     <div class="preloader">
         <div class="loader">
             <div class="loader__figure"></div>
             <p class="loader__label">Tremendio Protal</p>
         </div>
     </div>
     <section id="wrapper">
         <div class="login-register">
             <div class="login-box card">
                 <div class="card-body">
                     <form class="form-horizontal form-material" id="loginform" method="post" action="<?= base_url("adminlogin/change_password"); ?>">
                          <input type="hidden" name="ms" value="<?php if(isset($_GET['ms'])) {echo $_GET['ms'];} ?>">
                          <input type="hidden" name="te" value="<?php if(isset($_GET['te'])) {echo $_GET['te'];} ?>">
                         <div class="form-group ">
                             <div class="col-xs-12">
                             <img class="main_logo" src="<?= base_url("assets/images/Tremendio_logo.png") ?>" alt="Main logo">
                             </div>
                         </div>
                         <div class="form-group ">
                             <div class="col-xs-12">
                                 <h2 style="font-size: 30px; font-family: Montserrat, sans-seri;">
                                 <center style="color: white;">Change Password</center>
                                 </h2>
                             </div>
                         </div>
                         <div class="form-group ">
                             <div class="col-xs-12">
                                 <input class="login-input" type="password" required="" name="password" placeholder="New Password">
                             </div>
                         </div>
                         <div class="form-group">
                             <div class="col-xs-12">
                                 <input class="login-input" type="password" required="" name="confirm_password" placeholder="Confirm Password">
                             </div>
                         </div>
                         <div class="form-group text-center ">
                             <div class="col-xs-12 p-b-20">
                                 <button class="login-btn" type="submit">Submit</button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>
</body>

<script src="<?= base_url() ?>assets/module/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?= base_url() ?>assets/module/bootstrap/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/module/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/module/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>assets/module/styleswitcher/jQuery.style.switcher.js"></script>
<script src="<?= base_url() ?>assets/js/formvalidate.js"></script>
<!--Custom JavaScript -->
<script type="text/javascript">
    $(function() {

        $(".preloader").fadeOut();

    });

    $(function() {

        $('[data-toggle="tooltip"]').tooltip()

    });

    // ==============================================================

    // Login and Recover Password

    // ==============================================================

    $('#to-recover').on("click", function() {

        $("#loginform").slideUp();

        $("#recoverform").fadeIn();

    });

    $('.atm-button').hide();

</script>



<script type="text/javascript">
    $(window).on('load', function() {

        $('#myModal').modal('show');

    });
</script>





<script>
    $(document).ready(function() {

        $("#loginform").validate({

            rules: {

                username: "required",

                password: "required",



            },

            messages: {

                username: "Username is required",

                password: "Password is required",

            }

        });

    })
</script>



<?php
$hasErr = $this->session->flashdata('log_err');
if (isset($hasErr)) { ?>

    <script>

        $(document).ready(function() {

            Swal.fire({

                icon: 'error',

                title: 'Oops...',

                text: '<?= $this->session->flashdata('log_err') ?>',

            })

        })

    </script>

<?php } ?>



<script>











</script>

<?php

$hasSucc = $this->session->flashdata('check');

if (isset($hasSucc)) { ?>

    <script>

        $(document).ready(function() {

            Swal.fire({

                icon: 'success',

                title: 'Success',

                text: '<?= $this->session->flashdata('check') ?>',

            })

        })

    </script>

<?php } ?>

</html>

