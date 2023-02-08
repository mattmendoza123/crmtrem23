

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
                            <div class="col-xs-12 p-b-20">
                                <button class="login-btn" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
   