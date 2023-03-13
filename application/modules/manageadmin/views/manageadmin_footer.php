<script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script type="text/javascript">


    // Users > Table
    $(document).ready(function(e) {
        var filter_user_type = "";
        var base_url = "<?php echo base_url(); ?>";
        var data_table = $('#user_datatable').DataTable({
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
                url: base_url + 'manageadmin/get_userlist',
                type: 'POST',
            },
        });
    });


    $(document).on('click', '.edit-users', function(e) {
        e.preventDefault();

        var users_details_id = $(this).attr('user-id');
        $('#update_users_details_id').val(users_details_id);

        let new_array = [];
        let checker = '';

        var base_url = "<?php echo base_url(); ?>manageadmin/get_users/";
        $.ajax({
            type: "GET",
            url: base_url + users_details_id,
            success: function(data) {
                let result = JSON.parse(data);
                $('[name="user_id"]').val(result[0].user_id);
                $('[name="fk_user_id"]').val(result[0].fk_user_id);
                $('[name="first_name"]').val(result[0].first_name);
                $('[name="last_name"]').val(result[0].last_name);
                $('[name="username"]').val(result[0].username);
                $('[name="password_plain"]').val(result[0].password_plain);
                $('[name="email"]').val(result[0].email);
                $('[name="phone_number"]').val(result[0].phone_number);
                $('[name="city"]').val(result[0].city);
                $('[name="state"]').val(result[0].state);
                $('[name="country"]').val(result[0].country);
                $('[name="zip_code"]').val(result[0].zip_code);
                $('#UpdateUsers').modal('show');
            },
            error: function(data) {
                alert(data);
            }
        });
    });

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

<script>
