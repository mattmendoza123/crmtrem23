<!-- Bootstrap popper Core JavaScript -->
<!-- <script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>
<script type="text/javascript">


    // Users > Table
    $(document).ready(function(e) {
        var filter_crm_type = "";
        var base_url = "<?php echo base_url(); ?>";
        var data_table = $('#crmads_datatable').DataTable({
            // "pageLength": 10,
            // "serverSide": true,
            "pageLength": 5,
            // "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "processing": true,
            bLengthChange: true,
            "lengthMenu": [ [5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "All"] ],
            "iDisplayLength": 5,
            bInfo: false,
            responsive: true,
            "bAutoWidth": false,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'crmads/get_crmlist',
                type: 'POST',
            },
        });
    });


    $(document).on('click', '.edit-crm', function(e) {
        e.preventDefault();

        var crm_details_id = $(this).attr('crm-id');
        $('#update_crm_details_id').val(crm_details_id);

        let new_array = [];
        let checker = '';

        var base_url = "<?php echo base_url(); ?>crm/get_crm/";
        $.ajax({
            type: "GET",
            url: base_url + crm_details_id,
            success: function(data) {
                let result = JSON.parse(data);
                $('[name="crm_id"]').val(result[0].crm_id);
                $('[name="fk_user_id"]').val(result[0].fk_user_id);
                $('[name="u_first_name"]').val(result[0].first_name);
                $('[name="u_last_name"]').val(result[0].last_name);
                $('[name="u_email"]').val(result[0].email);
                $('[name="u_skype"]').val(result[0].skype);
                $('[name="u_company"]').val(result[0].company);
                $('[id="u_tags[]"]').val(result[0].tags);
                $('[name="u_country"]').val(result[0].country);
                $('[name="u_website"]').val(result[0].website);
                $('[id="u_model[]"]').val(result[0].model);
                $('[id="u_geo[]"]').val(result[0].geo);
                $('[id="u_traffic_source[]"]').val(result[0].traffic_source);
                $('[name="u_am"]').val(result[0].am);
                var business = '<?php echo base_url(); ?>assets/uploads/files/' + result[0].business_card;
                $("#u_business_card").attr("src", business);
                $('[name="u_comment"]').val(result[0].comment);
                $('#UpdateUsers').modal('show');
            },
            error: function(data) {
                alert(data);
            }
        });
    });


    $(document).on('click', '.view-crm', function(e) {
        e.preventDefault();

        var crm_details_id = $(this).attr('crm-id');
        $('#view_crm_details_id').val(crm_details_id);

        let new_array = [];
        let checker = '';

        var base_url = "<?php echo base_url(); ?>crm/get_crm/";
        $.ajax({
            type: "GET",
            url: base_url + crm_details_id,
            success: function(data) {
                let result = JSON.parse(data);
                $('[name="crm_id"]').val(result[0].crm_id);
                $('[name="fk_user_id"]').val(result[0].fk_user_id);
                $('[name="v_first_name"]').val(result[0].first_name);
                $('[name="v_last_name"]').val(result[0].last_name);
                $('[name="v_email"]').val(result[0].email);
                $('[name="v_skype"]').val(result[0].skype);
                $('[name="v_company"]').val(result[0].company);
                $('[id="v_tags[]"]').val(result[0].tags);
                $('[name="v_country"]').val(result[0].country);
                $('[name="v_website"]').val(result[0].website);
                $('[id="v_model[]"]').val(result[0].model);
                $('[id="v_geo[]"]').val(result[0].geo);
                $('[id="v_traffic_source[]"]').val(result[0].traffic_source);
                $('[name="v_am"]').val(result[0].am);
                var business = '<?php echo base_url(); ?>assets/uploads/files/' + result[0].business_card;
                $("#v_business_card").attr("src", business);
                $("a#down_business_card").attr("href", business);
                $('[name="v_comment"]').val(result[0].comment);
                $('#ViewUsers').modal('show');
            },
            error: function(data) {
                alert(data);
            }
        });
    });

    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('crmads_datatable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('CRM.' + (type || 'xlsx')));
    }
    
    $(document).ready(function () {
    $('#submit').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("You must check at least one checkbox.");
        return false;
      }

        });
    });

function tags() {
  var x = document.getElementById("tags2");
  var y = document.getElementById("tags1");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    $( ".hidden" ).remove();
  } else {
    x.style.display = "block";
    y.style.display = "none";
  }

}
function model() {
  var x = document.getElementById("model2");
  var y = document.getElementById("model1");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    $( ".hidden1" ).remove();
  } else {
    x.style.display = "block";
    y.style.display = "none";
  }

}
function geo() {
  var x = document.getElementById("geo2");
  var y = document.getElementById("geo1");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    $( ".hidden2" ).remove();
  } else {
    x.style.display = "block";
    y.style.display = "none";
  }

}
function traffic_source() {
  var x = document.getElementById("traffic_source2");
  var y = document.getElementById("traffic_source1");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    $( ".hidden3" ).remove();
  } else {
    x.style.display = "block";
    y.style.display = "none";
  }

}
$(document).on('click','.delete-crm',function(e){
   e.preventDefault();
   Swal.fire({
   title: 'Are you sure to delete this user?',
   text: "Proceeding will delete the user's data.",
   type: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, delete user.'
   }).then((result) => {
      if (result.value) {
         window.location.replace($(this).attr('href'));
      }
   });
});


function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
}
</script>