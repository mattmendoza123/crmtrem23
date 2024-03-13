<!-- <script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>
<script src="https://apis.google.com/js/api.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>




<script type="text/javascript">




$(document).ready(function() {
  var base_url = "https://crm.tremendio.network/";
  var dataTable = null;

  // Mapping object to translate API values to user-friendly names
  var offerNameMap = {
    "PRIVATE #1247 FlirtyNLocal - US - DOI": "Flirty n Local",
    "1247 - Flirtymilfs - US - CPL - SOI": "Flirty Milfs",
    "1247 - BBWtodate - US - CPL - SOI": "BBW to date",
    "1247 - One-nightstand - US - CPL - DOI ": "One Night stand",
    "1247 ONLY Ashley Madison - US - CPL - SOI - WEB/WAP": "Ashley Madison"
    // Add more mappings as needed
  };

  function formatDate(dateString) {
    var date = new Date(dateString);
    var formattedDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    return formattedDate + ' ' + formattedTime;
  }

  function removeTrailingZeros(value) {
    return parseFloat(value).toString();
  }

  function fetchData() {
    fetch(base_url + 'mediabuying/mediabuying_api', {
      headers: {
        'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
      }
    })
    .then(response => response.json())
    .then(data => {
      var transactions = data.info.transactions;

      if (!transactions || !Array.isArray(transactions)) {
        console.error("Error: Unable to find transactions data in the API response");
        return;
      }

      if (dataTable) {
        dataTable.clear().draw(); // Clear existing data in DataTable
      } else {
        dataTable = $('#mediabuying_table').DataTable({
          processing: true,
          order: [[2, "desc"]],
          pageLength: 100 
        });
      }

      transactions.forEach(transaction => {
        var gclid = transaction.sub_id1;
        if (!gclid) return; // Skip if GCLID is empty
        var conversionName = offerNameMap[transaction.offer.value] || transaction.offer.value;
        var conversionTime = formatDate(transaction.added_timestamp);
        var conversionValue = removeTrailingZeros(transaction.payout);
        var conversionCurrency = transaction.currency;

        dataTable.row.add([gclid, conversionName, conversionTime, conversionValue, conversionCurrency]);
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

function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('mediabuying_table');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
            XLSX.writeFile(wb, fn || ('MediaBuying.' + (type || 'xlsx')));
    }









// $(document).ready(function() {
//   var base_url = "https://greenifymyhome.co.uk/Invalidclicks/";
//   var dataTable = null;

//   // Mapping object to translate API values to user-friendly names
//   var offerNameMap = {
//     "PRIVATE #1247 FlirtyNLocal - US - DOI": "Flirty n Local",
//     "1247 - Flirtymilfs - US - CPL - SOI": "Flirty Milfs",
//     "1247 - BBWtodate - US - CPL - SOI": "BBW to date",
//     "1247 - One-nightstand - US - CPL - DOI ": "One Night stand",
//     "1247 ONLY Ashley Madison - US - CPL - SOI - WEB/WAP": "Ashley Madison"
//     // Add more mappings as needed
//   };

//   function formatDate(dateString) {
//     var date = new Date(dateString);
//     var formattedDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
//     var hours = date.getHours();
//     var minutes = date.getMinutes();
//     var seconds = date.getSeconds();
//     var formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
//     return formattedDate + ' ' + formattedTime;
//   }

//   function removeTrailingZeros(value) {
//     return parseFloat(value).toString();
//   }

//   function sendDataToGoogleSheet(gclid, conversionName, conversionTime, conversionValue, conversionCurrency) {
//     var url = 'https://script.google.com/macros/s/AKfycbz1oz1jzeNx-Zk04oqaR2wwUKSIpUqx9TlV2J6B8-EEo3qkPXvff2iGpP7YuhGa1g2nPA/exec'; // Replace 'your_script_id' with the ID of your Google Apps Script
//     var data = {
//       gclid: gclid,
//       conversionName: conversionName,
//       conversionTime: conversionTime,
//       conversionValue: conversionValue,
//       conversionCurrency: conversionCurrency
//     };

//     $.post(url, data)
//       .done(function(response) {
//         console.log("Data sent to Google Sheet successfully");
//       })
//       .fail(function(error) {
//         console.error("Error sending data to Google Sheet:", error);
//       });
//   }

//   function fetchData() {
//     fetch(base_url + 'mediabuying/mediabuying_api', {
//       headers: {
//         'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
//       }
//     })
//     .then(response => response.json())
//     .then(data => {
//       var transactions = data.info.transactions;

//       if (!transactions || !Array.isArray(transactions)) {
//         console.error("Error: Unable to find transactions data in the API response");
//         return;
//       }

//       if (dataTable) {
//         dataTable.clear().draw(); // Clear existing data in DataTable
//       } else {
//         dataTable = $('#mediabuying_table').DataTable({
//           processing: true,
//           order: [[2, "desc"]]
//         });
//       }

//       transactions.forEach(transaction => {
//         var gclid = transaction.sub_id1;
//         if (!gclid) return; // Skip if GCLID is empty
//         var conversionName = offerNameMap[transaction.offer.value] || transaction.offer.value;
//         var conversionTime = formatDate(transaction.added_timestamp);
//         var conversionValue = removeTrailingZeros(transaction.payout);
//         var conversionCurrency = transaction.currency;

//         // Add row to DataTable
//         dataTable.row.add([gclid, conversionName, conversionTime, conversionValue, conversionCurrency]);

//         // Send data to Google Sheet
//         sendDataToGoogleSheet(gclid, conversionName, conversionTime, conversionValue, conversionCurrency);
//       });

//       dataTable.draw();
//     })
//     .catch(error => {
//       console.error("Error:", error);
//     });
//   }

//   fetchData(); // Initial fetch on page load

//   // Refresh data every 24 hours
//   setInterval(fetchData, 24 * 60 * 60 * 1000);
// });


</script>


