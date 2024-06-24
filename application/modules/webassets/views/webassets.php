<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">Web Assets</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="webassets_table" class="table table-striped jambo_table bulk_action dt-responsive" style="width: 100% !important;">
                            <thead>
                                <tr>  
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Expires</th>
                                    <th>Tags</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>  
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Expires</th>
                                    <th>Tags</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="UpdateModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="UpdateModalTitle">Update Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action="<?= base_url("webassets/update_modal"); ?>" id="update-modal-form">
                    <input type="hidden" class="form-control" id="u_web_id" name="u_web_id">
   
                    <div class="form-group">
                    <div class="row">
                    <div class="col-md-12">
                        <label for="tags">Tags</label>
                        <select id="u_tags" class="form-control" name="u_tags" required>
                            <option value="N/A" selected>N/A</option>
                            <option value="Scaleo">Scaleo</option>
                            <option value="Web Assets">Web Assets</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="comment">Comments</label>
                                <textarea id="u_comment" class="form-control" name="u_comment" value="" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
            <button class="btn atm-button" id="submit" type="submit" style="background-color: green;"><i class="fa fa-plus-circle"></i> Save </button>
            </div>
            </form>
        </div>
    </div>
</div>