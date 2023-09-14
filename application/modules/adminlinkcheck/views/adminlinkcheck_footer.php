<!-- Bootstrap popper Core JavaScript -->
<!-- <script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>



<script type="text/javascript">
// $(document).ready(function() {
//   var base_url = "https://crm.tremendio.network/";

//   fetch(base_url + 'adminlinkcheck/api', {
//     headers: {
//       'x-apikey': '2d79fa4d329c17de8973a1e862539c344830a0a96ccc53599848164c11630c86'
//     }
//   })
//   .then(response => response.json())
//   .then(data => {
//     var parsedData = data.map(jsonString => JSON.parse(jsonString)); // Parse each JSON string

//     // Now you can access the properties of each parsed object
//     parsedData.forEach(obj => {
//       if (obj.data && obj.data.attributes && obj.data.attributes.redirection_chain) {
//         var redirectionChain = obj.data.attributes.redirection_chain[0];
//         var analysisStats = obj.data.attributes.last_analysis_stats;
//         var harmless = analysisStats.harmless;
//         var malicious = analysisStats.malicious;
//         var suspicious = analysisStats.suspicious;
//         var undetected = analysisStats.undetected;
//         var total = harmless + malicious + suspicious + undetected;

//         var flag = malicious > 0 ? '<button class="flag-button"><i class="fas fa-flag" style="color: red;"></i></button>' : '<button class="flag-button"><i class="fas fa-flag" style="color: green;"></i></button>';

//         var dataTable = $('#linkchecktable').DataTable();
//         dataTable.row.add([redirectionChain, harmless, malicious, suspicious, undetected, total, flag]).draw();
//       } else {
//         console.error("Required data properties are undefined.");
//       }
//     });
//   })
//   .catch(error => {
//     console.error("Error:", error);
//   });
// });

//OLD
// $(document).ready(function() {
//   var base_url = "https://crm.tremendio.network/";

//   // Add a loading row to the DataTable
//   var dataTable = $('#linkchecktable').DataTable({
//     "pageLength": 25, // Set default number of rows per page
//     "order": [[2, "desc"]] // Sort by the 'Malicious' column in descending order
//   });
//   dataTable.row.add(['', '', '', 'Please wait API is still loading...', '', '', '']).draw();
  
//   fetch(base_url + 'adminlinkcheck/api', {
//     headers: {
//       'x-apikey': '2d79fa4d329c17de8973a1e862539c344830a0a96ccc53599848164c11630c86'
//     }
//   })
//   .then(response => {
//     if (!response.ok) {
//       throw new Error("Network response was not ok");
//     }
//     return response.json();
//   })
//   .then(data => {
//     // Remove the loading row
//     dataTable.row(':contains("Please wait API is still loading...")').remove().draw();

//     var parsedData = data.map(jsonString => JSON.parse(jsonString)); // Parse each JSON string

//     // Now you can access the properties of each parsed object
//     parsedData.forEach(obj => {
//       if (obj.data && obj.data.attributes && obj.data.attributes.redirection_chain) {
//         var redirectionChain = obj.data.attributes.redirection_chain[0];
//         var analysisStats = obj.data.attributes.last_analysis_stats;
//         var harmless = analysisStats.harmless;
//         var malicious = analysisStats.malicious;
//         var suspicious = analysisStats.suspicious;
//         var undetected = analysisStats.undetected;
//         var total = harmless + malicious + suspicious + undetected;

//         var flag = malicious > 0 ? '<button class="flag-button"><i class="fas fa-flag" style="color: red;"></i></button>' : '<button class="flag-button"><i class="fas fa-flag" style="color: green;"></i></button>';

//         // Add the data to the DataTable
//         dataTable.row.add([redirectionChain, harmless, malicious, suspicious, undetected, total, flag]).draw();
//       } else {
//         console.error("Required data properties are undefined.");
//       }
//     });
//   })
//   .catch(error => {
//     // Remove the loading row and show an error message
//     dataTable.row(':contains("Please wait API is still loading...")').remove().draw();
//     console.error("Error:", error);
//   });
// });

//New
$(document).ready(function() {
  var base_url = "https://crm.tremendio.network/";

  // Add a loading row to the DataTable
  var dataTable = $('#linkchecktable').DataTable({
    "pageLength": 25, // Set default number of rows per page
    "order": [[2, "desc"]] // Sort by the 'Malicious' column in descending order
  });
  dataTable.row.add(['', '', '', 'Please wait API is still loading...', '', '', '']).draw();

  fetch(base_url + 'adminlinkcheck/api', {
    headers: {
      'x-apikey': '2d79fa4d329c17de8973a1e862539c344830a0a96ccc53599848164c11630c86'
    }
  })
  .then(response => {
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    return response.json();
  })
  .then(data => {
    // Remove the loading row
    dataTable.row(':contains("Please wait API is still loading...")').remove().draw();

    var parsedData = data.map(jsonString => JSON.parse(jsonString)); // Parse each JSON string

    // Now you can access the properties of each parsed object and add them to the DataTable
    parsedData.forEach(obj => {
      if (obj.data && obj.data.attributes) {
        var lastFinalUrl = obj.data.attributes.last_final_url;
        var analysisStats = obj.data.attributes.last_analysis_stats;
        var harmless = analysisStats.harmless;
        var malicious = analysisStats.malicious;
        var suspicious = analysisStats.suspicious;
        var undetected = analysisStats.undetected;
        var total = harmless + malicious + suspicious + undetected;

        var flag = malicious > 0 ? '<button class="flag-button"><i class="fas fa-flag" style="color: red;"></i></button>' : '<button class="flag-button"><i class="fas fa-flag" style="color: green;"></i></button>';

        // Add the data to the DataTable
        dataTable.row.add([lastFinalUrl, harmless, malicious, suspicious, undetected, total, flag]).draw();
      } else {
        console.error("Required data properties are undefined.");
      }
    });
  })
  .catch(error => {
    // Remove the loading row and show an error message
    dataTable.row(':contains("Please wait API is still loading...")').remove().draw();
    console.error("Error:", error);
  });
});

</script>

