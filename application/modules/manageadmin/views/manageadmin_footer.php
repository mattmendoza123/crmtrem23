<script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script type="text/javascript">


    // Users > Table
    $(document).ready(function(e) {
        get_userlist();
    });
    function get_userlist(from = null , to = null){    
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
            ajax: {
                url: base_url + 'manageadmin/get_userlist/',
                data: { from_date :from, to_date:  to},               
                type: "POST",              
            },
            initComplete: function () {              
              $("#crmads_datatable_filter label").before("<label>Date Created</label> : <input type='date' id='from_date' value='"+from+"'/> to <input type='date' id='to_date' value='"+to+"'/> <a class='btn btn-xs' href='javascript:void(0)' id='dateSearch'><i class='fa fa-search'></i></a>  ");
              jQuery("#dateSearch").click(function(){                                         
                    get_crmAddlists($("#from_date").val(),$("#to_date").val());
              });       
              this.api()
                    .columns()
                    .every(function () {
                        let column = this;
                        console.log(column);
                        let title = column.footer().textContent;
                                              
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
    }
   


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
