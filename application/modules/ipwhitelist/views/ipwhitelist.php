<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">User IP Whitelist</h3>
            </div>
            <div class="col-md-7 align-self-center text-right">
            <!-- <button type="button" id="excsv"><i class="fa fa-plus-circle"></i> Export to CSV </button> -->
            <button onclick="ExportToExcel('xlsx')" class="btn atm-button"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/002-export.png" style="width: 10%;"> Export table to excel</img></button>
            <button type="button" class="btn atm-button" data-toggle="modal" data-target="#AddIPModal"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/001-add-user.png" style="width: 20%;"> Add Contact </img></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="ipwhitelist_datatable" class="table table-striped jambo_table bulk_action dt-responsive" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User IP</th>
                                        <th>Comment</th>
                                        <th>Status</th>
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
<!-- Add User Modal -->
<div class="modal fade" id="AddIPModal" tabindex="-1" role="dialog" aria-labelledby="AddIPModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="addipmodal">
                <div class="modal-header">
                    <h4 class="modal-title" id="AddIPModalTitle"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/001-add-users.png" style="width: 20%;">&nbsp;&nbsp;Add IP </img></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>            
                    <div class="modal-body">
                    <form class="form-horizontal form-material" method="post" enctype="multipart/form-data" id="addip"  action="<?= base_url("ipwhitelist/addip"); ?>">

                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_created">Date Created</label>
                                    <input id="date_created" class="form-control" type="date"  name="date_created" value="<?php echo date('Y-m-d'); ?>" disabled/>
                                </div>
                            </div>
                    </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <span class="req">*</span></label>
                                    <input id="name" class="form-control" type="text"  name="name" value="" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_ip">User IP</label>
                                    <span class="req">*</span></label>
                                    <input id="user_ip" class="form-control" type="text"  name="user_ip" value="" required/>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="comment">Comment</label>
                                    <span class="req">*</span></label>
                                    <textarea id="comment" class="form-control" name="comment" value="" rows="4" cols="50" required></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn atm-button" id="submit" type="submit"><i class="fa fa-plus-circle"></i> Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="UpdateIP" tabindex="-1" role="dialog" aria-labelledby="UpdateIPModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="UpdateIPModalTitle"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/001-edit-user.png" style="width: 15%;">&nbsp;&nbsp;Update User</img></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>            
                    <div class="modal-body">
                    <form  method="post" enctype="multipart/form-data" action="<?= base_url("ipwhitelist/updateip"); ?>" id="updateip">
                    <input type="hidden" class="form-control" id="crm_ip_id" name="crm_ip_id">
                     <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_created">Date Created</label>
                                    <input id="date_created" class="form-control" type="date"  name="date_created" value="<?php echo date('Y-m-d'); ?>" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input id="u_name" class="form-control" type="text"  name="u_name" value="" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_ip">User IP</label>
                                    <input id="u_user_ip" class="form-control" type="text"  name="u_user_ip" value="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="comment">Comment</label>
                                    <textarea id="u_comment" class="form-control" name="u_comment" value="" rows="4" cols="50"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn atm-button" id="submit" type="submit"><i class="fa fa-plus-circle"></i> Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>