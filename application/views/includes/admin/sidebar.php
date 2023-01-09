<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="<?= base_url() ?>assets/images/main-logo.png" alt="homepage" width="180" height="80" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <!-- <img src="<?= base_url() ?>assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /> -->
                </b>
                <!--End Logo icon -->
                <!-- Logo text --><span>
                    <!-- dark Logo text -->
                    <!-- <img src="<?= base_url() ?>assets/images/text-logo.png" alt="homepage" class="dark-logo" /> -->
                    <!-- Light Logo text -->
                    <img src="<?= base_url() ?>assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->

            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- mega menu -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End mega menu -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sign-out-alt"></i><span class="hidden-md-down"> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">

                           <li role="separator" class="divider"></li>
                           <?php if ($this->session->userdata("user_type") != "2") { ?>
                                <?php echo "<li><a href='" . base_url("admin/profile") . "'></i> Hi <strong>'" . $this->session->userdata('user_details')[0]['first_name'] . " " . $this->session->userdata('user_details')[0]['last_name']."'</strong></a></li>"; ?>
                           <?php } else { ?>
                                <?php echo "<li><a href='" . base_url("employee/profile") . "'></i> Hi <strong>'" . $this->session->userdata('user_details')[0]['first_name'] . " " . $this->session->userdata('user_details')[0]['last_name']."'</strong></a></li>"; ?>
                           <?php } ?>
                           <li><a href="<?= base_url("logout") ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>


<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <?php if ($this->session->userdata("user_type") != "2"):?>
            <ul id="sidebarnav">
                <li class="<?= $pagename == "dashboard" ? "active" : "" ?>"> <a class="waves-effect " href="<?=base_url("admin")?>" aria-expanded="false"><i class="icon-Car-Wheel"></i><span class="hide-menu">Dashboard </span></a> </li>
                <li> <a class="waves-effect " href="<?=base_url("userlist")?>" aria-expanded="false"><i class="icon-User"></i><span class="hide-menu">Manage Users</span></a></li>
                 <li> <a class="waves-effect " href="<?=base_url("admin/managefiles")?>" aria-expanded="false"><i class="icon-Files"></i><span class="hide-menu">Manage Documents</span></a> </li>
                 <li> <a class="waves-effect " href="<?=base_url("admin/logs")?>" aria-expanded="false"><i class="icon-Receipt-4"></i><span class="hide-menu">Download Logs</span></a> </li>
                 <li> <a class="waves-effect " href="<?=base_url("admin/managevideoaudio")?>" aria-expanded="false"><i class="icon-Receipt-4"></i><span class="hide-menu">Video and Audio</span></a> </li>
                 <li> <a class="waves-effect " href="<?=base_url("admin/managemembership")?>" aria-expanded="false"><i class=""></i><span class="hide-menu">Manage Membership</span></a> </li>
                 <li> <a class="waves-effect " href="<?=base_url("admin/forums")?>" aria-expanded="false"><i class=""></i><span class="hide-menu">Manage Forums</span></a> </li>
                 <li> <a class="waves-effect " href="<?=base_url("admin/surveys")?>" aria-expanded="false"><i class=""></i><span class="hide-menu">Manage Surveys</span></a> </li>
                 <li> <a class="waves-effect " href="<?=base_url("admin/volunteering")?>" aria-expanded="false"><i class=""></i><span class="hide-menu">Manage Volunteering</span></a> </li>
                <!-- <li> <a class="has-arrow waves-effect" href="javascript:;" aria-expanded="false"><i class="icon-El-Castillo"></i><span class="hide-menu">Multi level dd</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="javascript:;">item 1.1</a></li>
                        <li><a href="javascript:;">item 1.2</a></li>
                        <li> <a class="has-arrow" href="javascript:;" aria-expanded="false">Menu 1.3</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:;">item 1.3.1</a></li>
                                <li><a href="javascript:;">item 1.3.2</a></li>
                                <li><a href="javascript:;">item 1.3.3</a></li>
                                <li><a href="javascript:;">item 1.3.4</a></li>
                            </ul>
                        </li>
                        <li><a href="#">item 1.4</a></li>
                    </ul>
                </li> -->
            </ul>
        <?php endif;?>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>