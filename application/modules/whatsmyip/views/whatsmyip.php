

<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Tremendio Portal</p>
    </div>
</div>
<!-- <//?php  
echo 'User IP Address - '.$_SERVER['REMOTE_ADDR'];  
?> -->
<section id="wrapper">
    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="whatsmyip">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <img class="main_logo" src="<?= base_url("assets/images/Tremendio_logo.png") ?>" alt="Main logo">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h2 style="font-size: 30px;">
                                <center style="color: white;">What's My IP</center>
                            </h2>
                        </div>
                    </div>
                    <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="login-input" type="text" name="whatsmyip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>" style="color: white;" disabled >
                            </div>
                        </div>
                </form>

            </div>
        </div>
    </div>
   