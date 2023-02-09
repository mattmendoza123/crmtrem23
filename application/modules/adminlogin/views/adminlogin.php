

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
                <form class="form-horizontal form-material" id="adminlogin" method="post" action="<?= base_url("adminlogin/adminlogin_account"); ?>">
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
                    <div class="adminlogin_field">
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
   