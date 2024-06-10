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
      console.log("_____")
        var filter_crm_type = "";
        var base_url = "<?php echo base_url(); ?>";
        var data_table = $('#crmads_datatable').DataTable({                    
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
                url: base_url + 'admincrmads/get_crmadslist',
                type: 'POST'                
            },
            initComplete: function () {
              console.log('complete data')
                this.api()
                    .columns()
                    .every(function () {
                        let column = this;
                        console.log(column);
                        let title = column.footer().textContent;
                       
                        $("#crmads_datatable_filter").append("<input type='date'/>");
                        if(title !="Action"){
                          // Create select element
                          let select = document.createElement('select');
                          select.className = "form-control";
                          select.add(new Option(''));
                          column.footer().replaceChildren(select);
          
                          // Apply listener for user change in value
                          select.addEventListener('change', function () {
                              column
                                  .search(select.value, {exact: true})
                                  .draw();
                          });
          
                          // Add list of options
                          column
                              .data()
                              .unique()
                              .sort()
                              .each(function (d, j) {
                                  select.add(new Option(d));
                              });
                        }
                    });
            }
        });          
    });

    console.log("hello");
    $(document).on('click', '.edit-crmads', function(e) {
        e.preventDefault();

        var crmads_details_id = $(this).attr('crmads-id');
        $('#update_crmads_details_id').val(crmads_details_id);

        let new_array = [];
        let checker = '';

        var base_url = "<?php echo base_url(); ?>crmads/get_crmads/";
        $.ajax({
            type: "GET",
            url: base_url + crmads_details_id,
            success: function(data) {
                let result = JSON.parse(data);
                $('[name="crmads_id"]').val(result[0].crmads_id);
                $('[name="fk_user_id"]').val(result[0].fk_user_id);
                $('[name="u_ads_first_name"]').val(result[0].ads_first_name);
                $('[name="u_ads_last_name"]').val(result[0].ads_last_name);
                $('[name="u_ads_email"]').val(result[0].ads_email);
                $('[name="u_ads_skype"]').val(result[0].ads_skype);
                $('[name="u_ads_company"]').val(result[0].ads_company);
                $('[id="u_ads_tags[]"]').val(result[0].ads_tags);
                $('[name="u_ads_country"]').val(result[0].ads_country);
                $('[name="u_ads_website"]').val(result[0].ads_website);
                $('[id="u_ads_model[]"]').val(result[0].ads_model);
                $('[id="u_ads_geo[]"]').val(result[0].ads_geo);
                $('[id="u_ads_traffic_source[]"]').val(result[0].ads_traffic_source);
                $('[name="u_ads_am"]').val(result[0].ads_am);
                var ads_business = '<?php echo base_url(); ?>assets/uploads/files/' + result[0].ads_business_card;
                $("#u_ads_business_card").attr("src", ads_business);
                $('[name="u_ads_comment"]').val(result[0].ads_comment);
                $('#UpdateUsers').modal('show');
            },
            error: function(data) {
                alert(data);
            }
        });
    });


    $(document).on('click', '.view-crmads', function(e) {
        e.preventDefault();

        var crmads_details_id = $(this).attr('crmads-id');
        $('#view_crmads_details_id').val(crmads_details_id);

        let new_array = [];
        let checker = '';

        var base_url = "<?php echo base_url(); ?>crmads/get_crmads/";
        $.ajax({
            type: "GET",
            url: base_url + crmads_details_id,
            success: function(data) {
                let result = JSON.parse(data);
                $('[name="crmads_id"]').val(result[0].crmads_id);
                $('[name="fk_user_id"]').val(result[0].fk_user_id);
                $('[name="v_ads_first_name"]').val(result[0].ads_first_name);
                $('[name="v_ads_last_name"]').val(result[0].ads_last_name);
                $('[name="v_ads_email"]').val(result[0].ads_email);
                $('[name="v_ads_skype"]').val(result[0].ads_skype);
                $('[name="v_ads_company"]').val(result[0].ads_company);
                $('[id="v_ads_tags[]"]').val(result[0].ads_tags);
                $('[name="v_ads_country"]').val(result[0].ads_country);
                $('[name="v_ads_website"]').val(result[0].ads_website);
                $('[id="v_ads_model[]"]').val(result[0].ads_model);
                $('[id="v_ads_geo[]"]').val(result[0].ads_geo);
                $('[id="v_ads_traffic_source[]"]').val(result[0].ads_traffic_source);
                $('[name="v_ads_am"]').val(result[0].ads_am);
                var ads_business = '<?php echo base_url(); ?>assets/uploads/files/' + result[0].ads_business_card;
                $("#v_ads_business_card").attr("src", ads_business);
                $("a#down_ads_business_card").attr("href", ads_business);
                $('[name="v_ads_comment"]').val(result[0].ads_comment);
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
$(document).on('click','.delete-crmads',function(e){
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