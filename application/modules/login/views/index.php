<style>
#sendotpmodal {
    background-color: #fff !important;
    border: 1px solid #000 !important;
}

.modal-header {
    background: #ffd0d7;
}

.modal-header #ForgotPassModalTitle, #modal_forgotPass{
    color: #000;
    font-family: "Proxima Nova", sans-serif;
}
#forgotpassword  label {
    color: #000;
    font-weight: 500;
    font-family: "Proxima Nova", sans-serif;
}


#forgotpassword input, select{
    border: 1px solid #000!important;
    padding: 6px;
    background-color: #87dfe9 !important;
    color: #000;

}
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 0 !important;
    height: 0 !important;
    background-color: #000;
}
</style>
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Tremendio Portal</p>
    </div>
</div>
<section id="wrapper">
    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" method="post" action="<?= base_url("login/login_account"); ?>">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <img class="main_logo" src="<?= base_url("assets/images/Tremendio_logo.png") ?>" alt="Main logo">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h2 style="font-size: 30px;">
                                <center style="color: white;">Login</center>
                            </h2>
                        </div>
                    </div>
                    <div class="login_buttons">
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                            <input type="button" class="login-btn" id="advertiser" value="Advertiser Manager">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                            <input type="button" class="login-btn" id="affiliate" value="Affiliate Manager">
                            </div>
                        </div>
                    </div>
                    <div class="login_field">
                        <div class="form-group" name="user_ip" id="user_ip">
                            <div class="col-xs-12">
                                <input class="login-input" type="text" name="user_ip" id="user_ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="login-input" type="text" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="login-input" type="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group text-center ">
                            <div class="login_ads"> 
                            <div class="col-xs-12 p-b-20">
                            <input type="button" data-toggle="modal" class="login-btn" id="forgotadvertiser" value="Forgot Password" data-target="#modal_forgotPassAds">
                            <button class="login-btn" type="submit">Login</button>
                            </div>
                            </div>
                            <div class="login_aff"> 
                            <div class="col-xs-12 p-b-20">
                            <input type="button" data-toggle="modal" class="login-btn" id="forgotaffiliate" value="Forgot Password" data-target="#modal_forgotPassAff">
                            <button class="login-btn" type="submit">Login</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
<!-- Modal Ads-->
<div id="modal_forgotPassAds" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" style="background-color: rgba(0, 0, 0, 0.5) !important;">
        <div class="modal-dialog">
            <div class="modal-content" id="forgotpassword">
                <div class="modal-header">
                    <h4 class="modal-title" id="ForgotPassModalTitle"><i class="sl-icon-question"></i> Forgot Password</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="form_forgotPass" action="<?php echo base_url('login/forgot_password'); ?>" method="post">
                        <div class="form-body">

                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label class="control-label">Email</label>
                                        <select id="email" name="email" class="form-control">
                                        <option selected hidden>-Please select-</option>
                                        <option value="kirill@tremendio.com">kirill@tremendio.com</option>
                                        <option value="john@tremendio.com">john@tremendio.com</option>
                                        </select>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="submit" value="Submit" name="forgot_pw" class="btn btn-success btn-sm btn-submits">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Aff-->
 <div id="modal_forgotPassAff" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" style="background-color: rgba(0, 0, 0, 0.5) !important;">
        <div class="modal-dialog">
            <div class="modal-content" id="forgotpassword">
                <div class="modal-header">
                    <h4 class="modal-title" id="ForgotPassModalTitle"><i class="sl-icon-question"></i> Forgot Password</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="form_forgotPass" action="<?php echo base_url('login/forgot_password'); ?>" method="post">
                        <div class="form-body">

                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label class="control-label">Email</label>
                                        <select id="email" name="email" class="form-control">
                                        <option selected hidden>-Please select-</option>
                                        <option value="denis@tremendio.com">denis@tremendio.com</option>
                                        <option value="nina@tremendio.com">nina@tremendio.com</option>
                                        </select>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="submit" value="Submit" name="forgot_pw" class="btn btn-success btn-sm btn-submits">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
   