<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">Overdue Invoices</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="overdueinvoice_table" class="table table-striped jambo_table bulk_action dt-responsive" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Amount Due</th>
                                <th>Total</th>
                                <th>Reference</th>
                                <th>Name</th>
                                <th>Due Date</th>
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

<script type="text/javascript">
	var overdue_invoices = '<?php echo $overdue_invoice_list_json ?>';
</script>

