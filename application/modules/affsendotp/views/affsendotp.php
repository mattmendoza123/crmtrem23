<style>
#sendotpmodal {
    background-color: #fff !important;
    border: 1px solid #000 !important;
}

.modal-header {
    background: #ffd0d7;
}

.modal-header #SendOTPModalTitle, #modal_sendotp {
    color: #000;
    font-family: "Proxima Nova", sans-serif;
}
#sendotpmodal  label {
    color: #000;
    font-weight: 500;
    font-family: "Proxima Nova", sans-serif;
}


#sendotpmodal input, select{
    border: 1px solid #000!important;
    padding: 6px;
    background-color: #87dfe9 !important;
    color: #000;

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
                <form class="form-horizontal form-material" id="sendotp" method="post" action="<?= base_url("affsendotp/otp_verify"); ?>">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <img class="main_logo" src="<?= base_url("assets/images/Tremendio_logo.png") ?>" alt="Main logo">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h2 style="font-size: 30px;">
                                <center style="color: white;">Email Verification</center>
                            </h2>
                        </div>
                    </div>
                    <div class="adminlogin_field">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="login-input" type="text" name="otp_number" placeholder="OTP">
                            </div>
                        </div>
                        <div class="form-group text-center ">
                            <div class="col-xs-12 p-b-20">
                            <input type="button" data-toggle="modal" class="login-btn" value="Send OTP" data-target="#modal_sendotp">
                            <button class="login-btn" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
  <!-- Modal -->
  <div id="modal_sendotp" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" id="sendotpmodal">
                <div class="modal-header">
                    <h4 class="modal-title" id="SendOTPModalTitle"><i class="sl-icon-question"></i> Email Verification</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="form_sendotp" action="<?php echo base_url('affsendotp/otp'); ?>" method="post">
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <select id="email" name="email" class="form-control">
                                        <option selected hidden>-Please select-</option>
                                        <option value="mendozamattnoruel@gmail.com">mendozamattnoruel@gmail.com</option>
                                        <option value="jp@tremendio.com">jp@tremendio.com</option>
                                        <option value="devteam@tremendio.com">devteam@tremendio.com</option>
                                        </select>
                                        <!-- <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Here">
                                        <small style="color:red; font-size: 14px; font-weight:bold;" class="err"></small> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="submit" value="Submit" name="otp" class="btn btn-success btn-sm btn-submits">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
   