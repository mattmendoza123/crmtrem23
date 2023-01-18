<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">CRM Advertiser</h3>
            </div>
            <div class="col-md-7 align-self-center text-right">
            <!-- <button type="button" id="excsv"><i class="fa fa-plus-circle"></i> Export to CSV </button> -->
            <button onclick="ExportToExcel('xlsx')" class="btn atm-button"><img src="https://crm.tremendio.network/assets/css/icons/new-icons/002-export.png" style="width: 10%;"> Export table to excel</img></button>
            <button type="button" class="btn atm-button" data-toggle="modal" data-target="#AddUserModal"><img src="https://crm.tremendio.network/assets/css/icons/new-icons/001-add-user.png" style="width: 20%;"> Add Contact </img></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="crmads_datatable" class="table table-striped jambo_table bulk_action dt-responsive" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Skype</th>
                                        <th>Tags</th>
                                        <th>Country</th>
                                        <th>Website</th>
                                        <th>Model</th>
                                        <th>Geo</th>
                                        <th>Traffic Source</th>
                                        <th>AM</th>
                                        <th>Comment</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
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