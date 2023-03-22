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
        var data_table = $('#crmaff_datatable').DataTable({
            // "pageLength": 10,
            // "serverSide": true,
            "pageLength": 10,
            // "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "processing": true,
            bLengthChange: true,
            "lengthMenu": [ [10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"] ],
            "iDisplayLength": 10,
            bInfo: false,
            responsive: true,
            "bAutoWidth": false,
            "search": {regex: true},
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'admincrmaff/get_crmafflist',
                type: 'POST',
            },
        });
    });


    $(document).on('click', '.edit-crmaff', function(e) {
        e.preventDefault();

        var crmaff_details_id = $(this).attr('crmaff-id');
        $('#update_crmaff_details_id').val(crmaff_details_id);

        let new_array = [];
        let checker = '';

        var base_url = "<?php echo base_url(); ?>crmaff/get_crmaff/";
        $.ajax({
            type: "GET",
            url: base_url + crmaff_details_id,
            success: function(data) {
                let result = JSON.parse(data);
                $('[name="crmaff_id"]').val(result[0].crmaff_id);
                $('[name="fk_user_id"]').val(result[0].fk_user_id);
                $('[name="u_aff_first_name"]').val(result[0].aff_first_name);
                $('[name="u_aff_last_name"]').val(result[0].aff_last_name);
                $('[name="u_aff_email"]').val(result[0].aff_email);
                $('[name="u_aff_skype"]').val(result[0].aff_skype);
                $('[name="u_aff_company"]').val(result[0].aff_company);
                $('[id="u_aff_tags[]"]').val(result[0].aff_tags);
                $('[name="u_aff_country"]').val(result[0].aff_country);
                $('[name="u_aff_website"]').val(result[0].aff_website);
                $('[id="u_aff_model[]"]').val(result[0].aff_model);
                $('[id="u_aff_geo[]"]').val(result[0].aff_geo);
                $('[id="u_aff_traffic_source[]"]').val(result[0].aff_traffic_source);
                $('[name="u_aff_am"]').val(result[0].aff_am);
                var aff_business = '<?php echo base_url(); ?>assets/uploads/files/' + result[0].aff_business_card;
                $("#u_aff_business_card").attr("src", aff_business);
                $('[name="u_aff_ex_hou"]').val(result[0].aff_ex_hou);
                $('[name="u_aff_comment"]').val(result[0].aff_comment);
                $('#UpdateUsers').modal('show');
            },
            error: function(data) {
                alert(data);
            }
        });
    });


    $(document).on('click', '.view-crmaff', function(e) {
        e.preventDefault();

        var crmaff_details_id = $(this).attr('crmaff-id');
        $('#view_crmaff_details_id').val(crmaff_details_id);

        let new_array = [];
        let checker = '';

        var base_url = "<?php echo base_url(); ?>crmaff/get_crmaff/";
        $.ajax({
            type: "GET",
            url: base_url + crmaff_details_id,
            success: function(data) {
                let result = JSON.parse(data);
                $('[name="crmaff_id"]').val(result[0].crmaff_id);
                $('[name="fk_user_id"]').val(result[0].fk_user_id);
                $('[name="v_aff_first_name"]').val(result[0].aff_first_name);
                $('[name="v_aff_last_name"]').val(result[0].aff_last_name);
                $('[name="v_aff_email"]').val(result[0].aff_email);
                $('[name="v_aff_skype"]').val(result[0].aff_skype);
                $('[name="v_aff_company"]').val(result[0].aff_company);
                $('[id="v_aff_tags[]"]').val(result[0].aff_tags);
                $('[name="v_aff_country"]').val(result[0].aff_country);
                $('[name="v_aff_website"]').val(result[0].aff_website);
                $('[id="v_aff_model[]"]').val(result[0].aff_model);
                $('[id="v_aff_geo[]"]').val(result[0].aff_geo);
                $('[id="v_aff_traffic_source[]"]').val(result[0].aff_traffic_source);
                $('[name="v_aff_am"]').val(result[0].aff_am);
                var aff_business = '<?php echo base_url(); ?>assets/uploads/files/' + result[0].aff_business_card;
                $("#v_aff_business_card").attr("src", aff_business);
                $("a#down_aff_business_card").attr("href", aff_business);
                $('[name="v_aff_ex_hou"]').val(result[0].aff_ex_hou);
                $('[name="v_aff_comment"]').val(result[0].aff_comment);
                $('#ViewUsers').modal('show');
            },
            error: function(data) {
                alert(data);
            }
        });
    });

    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('crmaff_datatable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('CRM.' + (type || 'xlsx')));
    }
    
    // $(document).ready(function () {
    // $('#submit').click(function() {
    //   checked = $("input[type=checkbox]:checked").length;

    //   if(!checked) {
    //     alert("You must check at least one checkbox.");
    //     return false;
    //   }

    //     });
    // });

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
function ex_hou() {
  var x = document.getElementById("ex_hou2");
  var y = document.getElementById("ex_hou1");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    $( ".hidden4" ).remove();
  } else {
    x.style.display = "block";
    y.style.display = "none";
  }

}
$(document).on('click','.delete-crmaff',function(e){
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