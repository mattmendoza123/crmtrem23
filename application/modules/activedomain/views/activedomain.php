<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">Active Domain</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="activedomaintable" class="table table-striped jambo_table bulk_action dt-responsive" style="width: 100% !important;">
                            <thead>
                                <tr>
                                <th class="aff-id">Aff ID</th>
                                <th class="url">URL</th>
                                <th class="comments">Comments</th>
                                <th class="actions">Actions</th>
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


 <!-- Update modal -->
<!-- <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="UpdateModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="UpdateModalTitle">Update Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action="<?= base_url("activedomain/update_modal"); ?>" id="update-modal-form">
                    <input type="hidden" class="form-control" id="u_active_id" name="u_active_id">
                    <input type="hidden" class="form-control" id="u_url" name="u_url">
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="tags">Aff ID</label>
                            <input id="u_tags" class="form-control" type="text" name="u_tags" value="" required/>
                        </div>
                        <div class="col-md-8">
                            <div id="additional-tags-container">
                                
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary add-button" type="button" id="add-tags-button"style="margin-top: 10px;">Add Aff ID</button>
                    <button class="btn btn-danger remove-button" type="button" id="remove-tags-button" style="margin-top: 10px;">Remove Last Aff ID</button>
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
</div> -->


<div class="actvie_domain_links">
<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">Active Domain</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="activedomain_tremendio" class="table table-striped jambo_table bulk_action dt-responsive" style="width: 100% !important;">
                            <thead>
                            <tr>
                            <th>Tracking Domain</th>
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
</div>