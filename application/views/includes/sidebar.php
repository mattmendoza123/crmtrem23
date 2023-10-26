<style>
    .topbar {
  background: #000; }
  .topbar .navbar-header {
    background: #000; }
  .topbar .top-navbar .navbar-header .navbar-brand .light-logo {
    display: none;
    color: rgba(0, 0, 0, 0.7); }
  .topbar .navbar-light .navbar-nav .nav-item > a.nav-link {
    color: #fff !important;
    }
    .topbar .navbar-light .navbar-nav .nav-item > a.nav-link:hover, .topbar .navbar-light .navbar-nav .nav-item > a.nav-link:focus {
      color: #fff !important;
      }
</style>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url() ?>/assets/images/logo1.png" alt="Logo" width="45" class="dark-logo" />
                </b>
                <span>
                    <img src="<?= base_url() ?>/assets/images/logo2.png" alt="Website Name" width="150" class="dark-logo1" />
                </span>
            </a>
        </div>

        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu" style="color: #fff;"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu" style="color: #fff;"></i></a> </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="hidden-md-down"> <?php echo $this->session->userdata('user_details')[0]['first_name'] . ' ' . $this->session->userdata('user_details')[0]['last_name']; ?> &nbsp;<i class="fa fa-angle-down"></i></span></a>
                    <!-- <i class="mdi mdi-account-circle" style="font-size: 17px"></i> -->
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <!-- <div class="u-img"><i class="mdi mdi-account-circle" style="font-size: 48px"></i></div> -->
                                    <div class="u-text">
                                        <h4><?= $this->session->userdata('user_details')[0]['first_name'] . ' ' . $this->session->userdata('user_details')[0]['last_name']; ?></h4>
                                        <p class="text-muted"><?= $this->session->userdata('user_details')[0]['email']; ?></p>
                                        <!-- </?php if ($this->session->userdata('user_details')[0]['user_type'] != "user") { ?>
                                            </?php echo "<a href='" . base_url("profile") . "' class='btn btn-rounded btn-primary btn-sm'><i class='ti-user'></i> View Profile</a>" ?>
                                        </?php } else { ?>
                                            </?php echo "<a href='" . base_url("profile") . "' class='btn btn-rounded btn-primary btn-sm'><i class='ti-user'></i> View Profile</a>" ?>
                                        </?php } ?> -->
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                             <li><a href="<?= base_url("logout") ?>"><i class="fa fa-power-off"></i> Logout</a></li> 
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Tremendio Portal</p>
    </div>
</div>

<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <?php if ($this->session->userdata('user_details')[0]['user_type'] == 'Advertiser') { ?>
                <ul id="sidebarnav">
                    <li class="<?php if (!empty($pagename)) {
                                    echo "active";
                                } else {
                                    echo "not-active";
                                }  ?>">
                     <li><a class="waves-effect" href="<?= base_url("crmads") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">CRM</span></a></li>
                     <li> <a class="waves-effect" href="<?= base_url("advinvalidclicks") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Invalid Clicks</span></a></li>
                     <li> <a class="waves-effect" href="<?= base_url("advactivedomain") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Active Domain</span></a></li>
                     <li> <a class="waves-effect" href="<?= base_url("advoverdueinvoice") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Overdue Invoice</span></a></li>
                     
                    </li>
                </ul>
            <?php } else if ($this->session->userdata('user_details')[0]['user_type'] == 'Affiliate') { ?>
                <ul id="sidebarnav">
                    <li class="<?php if (!empty($pagename)) {
                                    echo "active";
                                } else {
                                    echo "not-active";
                                }  ?>">
                        <li> <a class="waves-effect" href="<?= base_url("crmaff") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">CRM</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("newoffers") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">New Offers</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("exclusiveoffers") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Exclusive Offers</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("affactivedomain") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Active Domain</span></a></li>
                        
                    </li>
                </ul>
                 <?php } else { ?>
                <ul id="sidebarnav">
                    <li class="<?php if (!empty($pagename)) {
                                    echo "active";
                                } else {
                                    echo "not-active";
                                }  ?>">
                        <li> <a class="waves-effect" href="<?= base_url("dashboard") ?>" aria-expanded="false"><i class="fas fa-tachometer-alt" style="color: #fff;"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("manageadmin") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Manage Access</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("admincrmads") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">CRM Advertiser</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("admincrmaff") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">CRM Affiliate</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("ipwhitelist") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">IP Whitelist</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("newoffers") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">New Offers</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("exclusiveoffers") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Exclusive Offers</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("admininvalidclicks") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Invalid Clicks</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("adminactivedomain") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Active Domain</span></a></li>
                        <li> <a class="waves-effect" href="<?= base_url("adminoverdueinvoice") ?>" aria-expanded="false"><i class="fas fa-copy" style="color: #fff;"></i><span class="hide-menu">Overdue Invoice</span></a></li>
                    </li>
                </ul>
            <?php } ?>
        </nav>
    </div>
</aside>



