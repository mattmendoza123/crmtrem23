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
        var filter_ipwhitelist_type = "";
        var base_url = "<?php echo base_url(); ?>";
        var data_table = $('#ipwhitelist_datatable').DataTable({
            // "pageLength": 10,
            // "serverSide": true,
            "pageLength": 5,
            // "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "processing": true,
            bLengthChange: true,
            "lengthMenu": [ [5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "All"] ],
            iDisplayLength: 5,
            bInfo: false,
            responsive: true,
            "bAutoWidth": false,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'ipwhitelist/get_iplist',
                type: 'POST',
            },
        });
    });


    $(document).on('click', '.edit-ip', function(e) {
        e.preventDefault();

        var crm_ip_id = $(this).attr('crm-ip');
        $('#update_crm_ip_id').val(crm_ip_id);

        let new_array = [];
        let checker = '';

        var base_url = "<?php echo base_url(); ?>ipwhitelist/get_ip/";
        $.ajax({
            type: "GET",
            url: base_url + crm_ip_id,
            success: function(data) {
                let result = JSON.parse(data);
                $('[name="crm_ip_id"]').val(result[0].crm_ip_id);
                $('[name="u_name"]').val(result[0].name);
                $('[name="u_user_ip"]').val(result[0].user_ip);
                $('[name="u_comment"]').val(result[0].comment);
                $('#UpdateIP').modal('show');
            },
            error: function(data) {
                alert(data);
            }
        });
    });

    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('ipwhitelist_datatable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('UserIP.' + (type || 'xlsx')));
    }
    $(document).on('click','.delete-ip',function(e){
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

$(document).ready(function() {
        $("#adduser").validate({
            rules: {
              traffic_source: "required",

            },
            messages: {
                postion_app: "Please fill out this field",
            }
        });
    })

</script>
















<?php
$hasErr = $this->session->flashdata('log_err');
if (isset($hasErr)) { ?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= $this->session->flashdata('log_err') ?>',
            })
        })
    </script>
<?php } ?>

