<!DOCTYPE html>
<html style="background-color: #02b9ff !important;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../wp-content/themes/betterlifehcg/images/favicon.png">
    <title><?= $title; ?></title>
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
</head>
<style>
    .login_field
    {
        display: none;
    }
    .title-signin {
        font-size: 24px;
        color: #10359A;
        font-weight: 400;
        text-align: center;
        padding-top: 15px;
        border-top: 1px solid #10359A;
        font-weight: 600;
    }

    .login-box.card {
        top: -10%;
        border: 1px solid #0c2873;
        border-radius: 30px;
        width: 388px;
        background: #000 !important;
    }

    input.login-input,
    button.login-btn {
        font-family: "Proxima Nova", sans-serif;
    }
    img.main_logo {
        /* max-width: 70% !important;
        display: block; */
        /* margin-left: 10px;
        margin-right: 10px; */
        /* margin: 46px 50px 18px 70px;
        width: 100%; */
    max-width: 90% !important;
    display: block;
    margin: 10px 0px 5px 63px;
    width: 100%;
      }

    @media only screen and (min-width: 320px) {
    .login-box.card {
        top: -8% ;
        border: 1px solid #0c2873 ;
        border-radius: 30px;
        width: 300px;
        margin: 0 auto; 
    }

    img.main_logo {
    max-width: 70% ;
    display: block;
    margin-left: 10px;
    margin-right: 10px;
    margin: 16px 20px 2px 20px;
    width: 100%;
    }

}

@media only screen and (min-width: 375px) {
    .login-box.card {
        top: -8% ;
        border: 1px solid #0c2873 ;
        border-radius: 30px;
        width: 350px;
        margin: 0 auto; 
    }

    img.main_logo {
    max-width: 70% ;
    display: block;
    margin-left: 10px;
    margin-right: 10px;
    margin: 16px 20px 2px 20px;
    width: 100%;
    }

}


@media only screen and (min-width: 425px) {
    .login-box.card {
        top: -8% ;
        border: 1px solid #0c2873 ;
        border-radius: 30px;
        width: 400px;
        margin: 0 auto; 
    }
 
    img.main_logo {
    max-width: 70% ;
    display: block;
    margin-left: 10px;
    margin-right: 10px;
    margin: 16px 20px 2px 20px;
    width: 100%;
    }

}

@media only screen and (min-width: 767px) {
    .login-box.card {
        top: -8% ;
        border: 1px solid #0c2873 ;
        border-radius: 30px;
        width: 430px;
     margin: 0 auto;
    }


    img.main_logo {
    max-width: 70% ;
    display: block;
    margin-left: 10px;
    margin-right: 10px;
    margin: 16px 20px 2px 20px;
    width: 100%;
    }


}

@media only screen and (min-width: 1024px) {
    .login-box.card {
        top: -8%;
        border: 1px solid #0c2873;
        border-radius: 30px;
        width: 430px;
         margin: 0 auto;
    }


    img.main_logo {
    max-width: 70% ;
    display: block;
    margin-left: 10px;
    margin-right: 10px;
    margin: 16px 20px 2px 20px;
    width: 100%;
    }
  
}
 
</style>
<body>