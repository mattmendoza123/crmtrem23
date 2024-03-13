<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">Media Buying</h3>
            </div>
            <div class="col-md-7 align-self-center text-right">
            <!-- <button type="button" id="excsv"><i class="fa fa-plus-circle"></i> Export to CSV </button> -->
            <button onclick="ExportToExcel('xlsx')" class="btn atm-button"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/002-export.png" style="width: 10%;"> Export table to excel</img></button>
        </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mediabuying_table" class="table table-striped jambo_table bulk_action dt-responsive" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>GCLID</th>
                                <th>Conversion Name</th>
                                <th>Conversion Time</th>
                                <th>Conversion Value</th>
                                <th>Conversion Currency</th>
                            </tr>
                        </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>