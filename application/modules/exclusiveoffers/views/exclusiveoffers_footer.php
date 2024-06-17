<!-- <script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>
<style type="text/css">
a#dateSearch {
    background: black;
    color: #fff;
    padding: 5px 10px;
    margin-right: 10px;
}
</style>
<!-- <script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script> -->


<script type="text/javascript">
//  $(document).ready(function () {
//             $("#weeklytable").dataTable();
//             $.ajax({
//                 url: 'https://cors-anywhere.herokuapp.com/https://datatables.net/examples/ajax/data/objects.txt',
//                 type: 'GET',
//                 dataType: 'json',
//                 CORS: true ,
//                 contentType: 'application/json',
//                 secure: true, 
//                  beforeSend: function (xhr) {
//                 xhr.setRequestHeader ("Authorization", "Basic " + btoa(""));
//                 },
//                 success: function (result) {
//                     let daftar = result.results;
//                     var html = '';
//                     $.each(daftar, function (i, data) {
//                         html += `<tr>
//                                         <td> ` + data.name + `</td>
//                                         <td>` + data.position + `</td>
//                                         <td>` + data.salary + `</td>
//                                         <td>` + data.office + `</td>
//                                     </tr>`;
                      
//                     });
//                 }

//         //     success: function(data) {
                
//         //         console.log(data);
//         //     },
//         //     error: function(error) {
//         //         console.log("FAIL....=================");
//         //     }
//             });
//         })
// function loadData() {
// console.clear();
// //let webUrl = _spPageContextInfo.webAbsoluteUrl;
// var mili = new Request("https://cors-anywhere.herokuapp.com/https://datatables.net/examples/ajax/data/objects.txt"
//     ,{
//         method: 'GET',
//         headers: new Headers({
//             "Accept": "application/json; odata=verbose",
//         })
//     });
//     fetch(mili)
//     .then((response) => response.json())
//     .then((data) => {
//       console.log(data)
//         //if (data.d != null && data.d != undefined && data.d.results.length > 0) {
//             var table = $('#weeklytable').DataTable();

//             table.rows.add(data.data).draw();

//         //}
//         //console.log(item.Name, item.Weight, item.WeeklyWeight, item.Steps, items.WeeklySteps, item.ExerciseMinutes, item.WeeklyExerciseMin, item.StepPoints, item.MinutePoints);
//         //console.log(item.Name.Title);
//     });

    
// }
 


// $(document).ready( function () {
       
           
//           var table = $('#weeklytable').DataTable({
//                 "columns": [
//                     { "data": "name" },
//                     { "data": "office" },
//                     { "data": "position" },
//                     { "data": "salary" }
//                 ]
//     }); 

//          loadData();
//         } );
        


// $(document).ready(function() {
//     var base_url = "<//?php echo base_url(); ?>";
//     var table = $('#weeklytable').DataTable({
        
//         "ajax": {
//             url: base_url + 'invalidclicks/api',
//             // "url": "https://datatables.net/examples/ajax/data/objects.txt",
//             "type": 'GET',
//             "dataSrc": "data",
//             "success": function(response) {
//                 console.log(response);
//             }
//         },
//         "columns": [
//             { "data": "name" },
//             { "data": "office" },
//             { "data": "position" },
//             { "data": "salary" }
//         ]
//     });


//     setInterval( function () {
//         table.ajax.reload();
//     }, 86400 ); // reload the data every 24hours
// });
// $(document).ready(function() {
//     var base_url = "<//?php echo base_url(); ?>";
//     var table = $('#weeklytable').DataTable({
//         "ajax": {
//             url: base_url + 'invalidclicks/api',
//             "type": 'GET',
//             "dataSrc": "info",
//             "success": function(response) {
//                 console.log(response);
//             }
//         },
//         "columns": [
//             { "info": "offer.title" },
//             { "info": "offer.adv_cr" },
//             { "info": "offer.advertiser_id" },
//             { "info": "offer.ar" }
//         ]
//     });

//     setInterval(function() {
//         table.ajax.reload();
//     }, 86400); // reload the data every 24 hours
// });


// $(document).ready(function() {
//   var base_url = "https://greenifymyhome.co.uk/Invalidclicks/";

//   fetch(base_url + 'newoffers/newoffers_api', {
//     headers: {
//       'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
//     }
//   })
//   .then(response => response.json())
//   .then(data => {
//     var offers = data.info.offers;

//     var dataTable = $('#newoffers_table').DataTable({
//       processing: true,
//       "order": [
//                 [0, "des"]
//             ]
//     //   serverSide: true
//     });
//     offers.forEach(offer => {
//       if (offer && offer.title_info && offer.title_info.advertiser) {
//         var advertiserId = offer.title_info.advertiser.id;
//         var advertiserName = offer.title_info.advertiser.company_name;
//       } else {
//         var advertiserId = "N/A";
//         var advertiserName = "N/A";
//       }

//       if (offer && offer.payout && offer.payout.length > 0) {
//         var payoutValue = offer.payout[0].value;
//       } else {
//         var payoutValue = "N/A";
//       }

//       var categoryTitles = "";
//       if (offer && offer.categories && offer.categories.length > 0) {
//         categoryTitles = offer.categories.map(category => category.title).join(', ');
//       } else {
//         categoryTitles = "N/A";
//       }

//       dataTable.row.add([offer.title_info.name, advertiserName, categoryTitles, payoutValue]);
//     });

//     dataTable.draw();
//   })
//   .catch(error => {
//     console.error("Error:", error);
//   });
// });

/*
$(document).ready(function() {
  var base_url = "https://crm.tremendio.network/";
  var dataTable = null;

  function fetchData() {
    fetch(base_url + 'exclusiveoffers/exclusiveoffers_api', {
      headers: {
        'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
      }
    })
    .then(response => response.json())
    .then(data => {
      var offers = data.info.offers;

      if (dataTable) {
        dataTable.clear().draw(); // Clear existing data in DataTable
      } else {
        dataTable = $('#exclusiveoffers_table').DataTable({
          processing: true,
          order: [[0, "des"]]
        });
      }

      offers.forEach(offer => {
      if (offer && offer.title_info && offer.title_info.advertiser) {
        var offersId = offer.id;
        var advertiserName = offer.title_info.advertiser.company_name;
      } else {
        var offersId = "N/A";
        var advertiserName = "N/A";
      }

      if (offer && offer.payout && offer.payout.length > 0) {
        var payoutValue = offer.payout[0].value;
      } else {
        var payoutValue = "N/A";
      }

      var categoryTitles = "";
      if (offer && offer.categories && offer.categories.length > 0) {
        categoryTitles = offer.categories.map(category => category.title).join(', ');
      } else {
        categoryTitles = "N/A";
      }

      dataTable.row.add([offersId, offer.title_info.name, advertiserName, categoryTitles, payoutValue]);
    });

    dataTable.draw();
    })
    .catch(error => {
      console.error("Error:", error);
    });
  }

  fetchData(); // Initial fetch on page load

  // Refresh data every 24 hours
  setInterval(fetchData, 24 * 60 * 60 * 1000);
});
*/


$(document).ready(function(e) {
      get_exclusiveOffers();
});

  function get_exclusiveOffers(from = null , to = null){    
      $('#exclusiveoffers_table').DataTable().clear().destroy();
      var filter_crm_type = "";
      var base_url = "<?php echo base_url(); ?>";
      var data_table = $('#exclusiveoffers_table').DataTable({
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
            url: base_url + 'exclusiveoffers/exclusiveoffers_api',
              data: { from_date :from, to_date:  to},               
              type: "POST",              
          },
          initComplete: function () {              
            $("#exclusiveoffers_table_filter label").before("<label>Date Created</label> : <input type='date' id='from_date' value='"+from+"'/> to <input type='date' id='to_date' value='"+to+"'/> <a class='btn btn-xs' href='javascript:void(0)' id='dateSearch'><i class='fa fa-search'></i></a>  ");
            jQuery("#dateSearch").click(function(){                                         
              get_exclusiveOffers($("#from_date").val(),$("#to_date").val());
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

</script>