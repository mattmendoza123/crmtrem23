<!-- <script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    $('#overdueinvoice_table').DataTable( {
	    "data": JSON.parse(overdue_invoices),
        "columns": [
            { "data": "InvoiceNumber" },
			{ "data": "AmountDue"},
			{ "data": "Total"},
			// { "data": "ContactID"},
            { "data": "Reference"},
			{ "data": "Name"},
			{ "data": "DueDatePretty"}
        ]
    } );
});
  </script>
