<!DOCTYPE html>
<html style="background-color: #f6f9fa !important;">
     <head>
           <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <!-- Tell the browser to be responsive to screen width -->
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="description" content="">
          <meta name="author" content="">
          <!-- Favicon icon -->
          <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/assets/images/logo1.png">
          <title><?= $title?></title>

          <!-- Bootstrap Core CSS -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
          <link href="<?=base_url()?>assets/module/bootstrap/css/bootstrap.min.css" rel="stylesheet">
          <link href="<?=base_url()?>assets/module/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" rel="stylesheet">
          <!-- This page CSS -->
          <!-- chartist CSS -->
          <link href="<?=base_url()?>assets/module/morrisjs/morris.css" rel="stylesheet">
          <link rel="stylesheet" type="text/css"
             href="<?=base_url()?>assets/module/datatables.net-bs4/css/dataTables.bootstrap4.css">
	     <link rel="stylesheet" type="text/css"
            href="<?=base_url()?>assets/module/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/css/pages/table-pages.css" rel="stylesheet">
          <!--c3 CSS -->
          <link href="<?=base_url()?>assets/module/c3-master/c3.min.css" rel="stylesheet">
          <!--Toaster Popup message CSS -->
          <link href="<?=base_url()?>assets/module/toast-master/css/jquery.toast.css" rel="stylesheet">
          <!-- Custom CSS -->
          <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
          <!-- Dashboard 1 Page CSS -->
          <link href="<?=base_url()?>assets/css/pages/dashboard1.css" rel="stylesheet">
          <!-- You can change the theme colors from here -->
          <link href="<?=base_url()?>/assets/css/colors/default.css" id="theme" rel="stylesheet">
          <link href="<?=base_url()?>/assets/css/adminstyle.css" rel="stylesheet">
           <link href="<?=base_url()?>assets/module/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

           <?php
             if (isset($add_to_header)) {
                 $add_to_headerr_files = explode(',',$add_to_header);
                 foreach ($add_to_headerr_files as $value) {
                    $this->load->view($value);
                 }
             }
          ?>

     </head>
      <body class="fix-header fix-sidebar card-no-border">
         
