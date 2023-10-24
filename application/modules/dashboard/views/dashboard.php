<!-- <div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Dashboard</h3>
            </div>
        </div>
    </div>
</div> -->

<?php
if (extension_loaded('curl')) {
    echo "cURL is installed and enabled.";
} else {
    echo "cURL is not installed or enabled.";
}

