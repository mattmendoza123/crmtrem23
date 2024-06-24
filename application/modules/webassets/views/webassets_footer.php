<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style type="text/css">
a#dateSearch {
    background: black;
    color: #fff;
    padding: 5px 10px;
    margin-right: 10px;
}
</style>


<script type="text/javascript">

// $(document).ready(function() {
//     var base_url = "https://greenifymyhome.co.uk/Invalidclicks/";
//     var dataTable = null;

//     function fetchData() {
//         fetch(base_url + 'webassets/webassets_api', {
//             headers: {
//                 'api-key': 'dc559ce7bbf74489a3dcfa082e66be4d'
//             }
//         })
//         .then(response => {
//             if (!response.ok) {
// 				// console.log('response: '+JSON.stringify(response));
// 				// console.log('data: '+JSON.stringify(data));
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
// 			if ( data.error ) {
// 				// alert the error if an error response was returned
// 				alert(data.error);
// 			} else {
// 				var domains = data.domains;

// 				if (dataTable) {
// 					dataTable.clear().draw();
// 				} else {
// 					dataTable = $('#webassets_table').DataTable({
// 						processing: true,
// 						order: [[0, "des"]],
// 						columnDefs: [{
// 						targets: -1,
// 						data: null,
// 						defaultContent: '<button class="btn btn-sm btn-primary update-button"><i class="fa fa-pencil"></i> Update</button>'
// 					}]
// 					});
// 				}

// 				domains.forEach(domain => {
// 					var id = domain.ID;
// 					var name = domain.Name;
// 					var expires = domain.Expires;

// 					var newRow = dataTable.row.add([
// 						id,
// 						name,
// 						expires
// 					]).draw().node();
// 				});
// 			}
			
//         })
//         .catch(error => {
//             console.error("Error2:", error);
//         });
//     }

//     fetchData();

//     // Refresh data every 24 hours
//     setInterval(fetchData, 24 * 60 * 60 * 1000);
// });


// $(document).ready(function() {
//     var base_url = "https://greenifymyhome.co.uk/Invalidclicks/";
//     var dataTable = null;

//     function fetchData() {
//         fetch(base_url + 'webassets/webassets_api', {
//             headers: {
//                 'api-key': 'dc559ce7bbf74489a3dcfa082e66be4d'
//             }
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             if (data.error) {
//                 alert(data.error);
//             } else {
//                 var domains = data.domains;

//                 if (dataTable) {
//                     dataTable.clear().draw();
//                 } else {
//                     dataTable = $('#webassets_table').DataTable({
//                         processing: true,
//                         order: [[0, "des"]],
//                         columnDefs: [{
//                             targets: -1,
//                             data: null,
//                             defaultContent: '<button class="btn btn-sm btn-primary update-button"><i class="fa fa-pencil"></i> Update</button>'
//                         }]
//                     });
//                 }

//                 domains.forEach(domain => {
//                     var id = domain.ID;
//                     var name = domain.Name;
//                     var expires = domain.Expires;
//                     var tags = domain.tag;
//                     var comments = domain.comment;
//                     // var tags = domain.Tags || 'N/A';
//                     // var comments = domain.Comments || 'N/A';

//                     var newRow = dataTable.row.add([
//                         id,
//                         name,
//                         expires,
//                         tags,
//                         comments,
//                     ]).draw().node();
//                 });
//             }
//         })
//         .catch(error => {
//             console.error("Error fetching data:", error);
//         });
//     }

//     fetchData();

//     setInterval(fetchData, 24 * 60 * 60 * 1000);

//     $('#webassets_table').on('click', '.update-button', function() {
//     var row = $(this).closest('tr');
//     var webId = row.find('td:eq(0)').text();
//     var tags = row.find('td:eq(3)').text(); // Assuming "Tags" is the fourth column (index 3)
//     var comments = row.find('td:eq(4)').text(); // Assuming "Comment" is the fifth column (index 4)

//     // console.log('Web ID:', webId);
//     // console.log('Tags:', tags);
//     // console.log('Comments:', comments);

//     $('#u_web_id').val(webId);
//     $('#u_tags').val(tags);
//     $('#u_comment').val(comments);

//     $('#update-modal').modal('show');
// });

// $('#update-modal-form').submit(function (event) {
//         event.preventDefault();
//         var formData = $(this).serialize();
//         console.log(formData);

//             $.ajax({
//         url: base_url + 'webassets/update_modal',
//         method: 'POST',
//         data: formData,
//         dataType: 'json',
//         success: function (data) {
//             if (data.success) {
//                 $('#update-modal').modal('hide');
//                 Swal.fire({
//                     icon: 'info',
//                     text: data.message,
//                 }).then(function () {
//                     location.reload();
//                 });
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     text: data.message,
//                 });
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error("Error in AJAX request:", xhr.responseText);
//         }
//     });
//     });
// });
/* OLD FUNCTION 
$(document).ready(function () {
    var base_url = "https://crm.tremendio.network/";
    var dataTable = null;

    function fetchData() {
        fetch(base_url + 'webassets/webassets_api', {
            headers: {
                'api-key': 'dc559ce7bbf74489a3dcfa082e66be4d'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    var domains = data.domains;

                    if (dataTable) {
                        dataTable.clear().draw();
                    } else {
                        dataTable = $('#webassets_table').DataTable({
                            processing: true,
                            order: [[0, "des"]],
                            columnDefs: [{
                                targets: -1,
                                data: null,
                                defaultContent: '<button class="btn btn-sm btn-primary update-button"><i class="fa fa-edit"></i></button>'
                            }]
                    }

                    domains.forEach(domain => {

                        var id = domain.ID;
                        var name = domain.Name;
                        var expires = domain.Expires;
                        var tags = domain.tag;
                        var comments = domain.comment;

                        var newRow = dataTable.row.add([
                            id,
                            name,
                            expires,
                            tags,
                            comments,
                        ]).draw().node();
                    });
                }
            })
            .catch(error => {
                console.error("Error fetching data:", error);
            });
    }

    fetchData();

    setInterval(fetchData, 24 * 60 * 60 * 1000);

   
});


*/
$(document).ready(function(e) {
      get_webAssets();
});

function get_webAssets(from = null , to = null){    
      $('#webassets_table').DataTable().clear().destroy();
      var filter_crm_type = "";
      var base_url = "<?php echo base_url(); ?>";
      var data_table = $('#webassets_table').DataTable({        
          "pageLength": 10,          
          "processing": true,
          bLengthChange: true,
          "lengthMenu": [ [10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"] ],
          "iDisplayLength": 10,
          bInfo: false,
          responsive: true,
          "bAutoWidth": false,
          "search": {regex: true},          
          ajax: {
            url: base_url + 'webassets/webassets_api',
              data: { from_date :from, to_date:  to},               
              type: "POST",              
          },
          initComplete: function () {              
           // $("#webassets_table_filter label").before("<label>Date Created</label> : <input type='date' id='from_date' value='"+from+"'/> to <input type='date' id='to_date' value='"+to+"'/> <a class='btn btn-xs' href='javascript:void(0)' id='dateSearch'><i class='fa fa-search'></i></a>  ");
            //jQuery("#dateSearch").click(function(){                                         
          //      get_webAssets($("#from_date").val(),$("#to_date").val());
          //  });       
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
  $('#webassets_table').on('click', '.update-button', function () {
        var row = $(this).closest('tr');
        var webId = row.find('td:eq(0)').text();
        var tags = row.find('td:eq(3)').text(); // Assuming "Tags" is the fourth column (index 3)
        var comments = row.find('td:eq(4)').text(); // Assuming "Comment" is the fifth column (index 4)

        $('#u_web_id').val(webId);
        $('#u_tags').val(tags);
        $('#u_comment').val(comments);

        $('#update-modal').modal('show');
    });

    $('#update-modal-form').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: base_url + 'webassets/update_modal',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('#update-modal').modal('hide');
                    Swal.fire({
                        icon: 'info',
                        text: data.message,
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: data.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error in AJAX request:", xhr.responseText);
            }
        });
    });

</script>




