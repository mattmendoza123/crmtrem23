<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
$(document).ready(function() {

    var dataTable = null;
    var existingUrls = []; // Array to store existing URLs in the database

    
    function getVTotal(hashUrl,url){            
        const settings = {
            async: true,
            crossDomain: true,
            url: base_url + 'adminactivedomain/fetchVirusTotalData/'+hashUrl,
            data:{"url": url},
            method: 'POST'
        } 
        return $.ajax(settings).done(res => {         
            console.log(res);             
           return res;
        });
        

    }
    function fetchData() {
        fetch(base_url + 'adminactivedomain/activedomain_api', {
            headers: {
                'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
            }
        })
        .then(response => response.json())
        .then(data => {
           // console.log(data.data);
            var trackingDomains = data.data.info.details.tracking_domains;
           // dataTable.row.add(['', '', '', '', 'Please wait API is still loading...', '', '', '', '']).draw();

            if (dataTable) {
                dataTable.clear().draw(); // Clear existing data in DataTable
            } else {
                dataTable = $('#activedomain').DataTable({
                    processing: true,
                    order: [[3, "desc"]],
                    pageLength: 50
                });
            }
            
            var vTotal;
            var vTotalAnalysisStats;
            var tags;
            var lastFinalUrl;
            var harmless;
            var malicious;
            var suspicious;
            var undetected;
            var total;           
            var comments;
            trackingDomains.forEach(async obj => {                           
                if (!existingUrls.includes(obj.name)) {     
                  console.log("UR",obj.urlHash);                  
                   vTotal = await getVTotal(obj.urlHash,obj.url);                                      
                   if(!vTotal){                        
                      vTotal = obj.vtotal;
                   }
                   existingUrls.push(obj.name);  
                   total = vTotal.harmless + vTotal.malicious + vTotal.suspicious + vTotal.undetected;

                   var viewButton = '<button class="view-button btn btn-xs"><i class="fa fa-eye"></i></button>';
                   var updateButton = '<button class="update-button btn btn-xs" data-toggle="modal" data-target="#update-modal" data-active_id="' + obj.active_id + '"><i class="fa fa-edit"></i></button>';                    
                   var flagButton = vTotal.malicious > 0 ? '<button class="flag-button"><i class="fas fa-flag" style="color: red;"></i></button>' : '<button class="flag-button"><i class="fas fa-flag" style="color: green;"></i></button>';
                   var actionsCell = flagButton + ' ' + viewButton + ' ' + updateButton;


                    dataTable.row.add([obj.tags || 'N1', obj.name  || 'N/A' , vTotal.harmless  || 0 , vTotal.malicious  || 0, vTotal.suspicious  || 0, vTotal.undetected  || 0, total  || 0, obj.comments || 'N1', actionsCell]).draw();
                    setTimeout("", 100000);                  
                }

                
            });      
                 
        })  
        
        $('#activedomain').on('click', '.view-button', function () {
        var row = $(this).closest('tr');
        var tags = row.find('td:eq(0)').text();
        var url = row.find('td:eq(1)').text();
        var harmless = row.find('td:eq(2)').text();
        var malicious = row.find('td:eq(3)').text();
        var suspicious = row.find('td:eq(4)').text();
        var undetected = row.find('td:eq(5)').text();
        var total = row.find('td:eq(6)').text();
        var comments = row.find('td:eq(7)').text();

        // Populate the modal fields with data
        $('#modal-tags').text('Aff ID: ' + tags);
        $('#modal-url').text('URL: ' + url);
        $('#modal-harmless').text('Harmless: ' + harmless);
        $('#modal-malicious').text('Malicious: ' + malicious);
        $('#modal-suspicious').text('Suspicious: ' + suspicious);
        $('#modal-undetected').text('Undetected: ' + undetected);
        $('#modal-total').text('Total: ' + total);
        $('#modal-comments').text('Comments: ' + comments);
        
        // Show the modal
        $('#view-modal').modal('show');
        });

        $('#activedomain').on('click', '.update-button', function () {
        var row = $(this).closest('tr');
        var active_id = $(this).data('active_id');
        var tags = row.find('td:eq(0)').text(); // Assuming this contains semicolon-separated tags

        // Split the tags into an array using the semicolon delimiter
        var tagArray = tags.split(';');

        // Set the "Aff ID" input field with the first tag
        $('#u_tags').val(tagArray.shift());

        // Populate the "additional-tags-container" with the remaining tags
        var additionalTagsContainer = document.getElementById("additional-tags-container");
        additionalTagsContainer.innerHTML = ''; // Clear previous tags
        tagArray.forEach(function (tag) {
            const input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("class", "form-control");
            input.setAttribute("name", "u_tags[]");
            input.setAttribute("placeholder", "Additional Aff ID");
            input.value = tag;
            additionalTagsContainer.appendChild(input);
        });

        // Show the update modal
        $('#update-modal').modal('show');

        // Set other fields as well
        var url = row.find('td:eq(1)').text();
        var comments = row.find('td:eq(7)').text();

        $('#u_url').val(url);
        $('#u_comment').val(comments);
        $('#u_active_id').val(active_id); // Set the active_id in a hidden input field
    });

    }

    fetchData(); // Initial fetch and insertion on page load

    // Refresh data every 24 hours
    setInterval(fetchData);
});





// // VIRUSTOTAL

/*
$(document).ready(function () {
    var base_url = "https://crm.tremendio.network/";

    var dataTable = $('#activedomain').DataTable({
        "pageLength": 10,
        "order": [[3, "desc"]]
    });

    // Show a loading message in the table while fetching data
    dataTable.row.add(['', '', '', '', 'Please wait API is still loading...', '', '', '', '']).draw();

    fetch(base_url + 'adminactivedomain/api', {
        headers: {
            // 'x-apikey': '5664f3e4ced248681f8f0ac0c4f062e8ad618ffdfb5581e382e12ca86c8bbe6e'
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

            // Check if the data is an array
            if (Array.isArray(data)) {
                data.forEach(obj => {
                    var tags = obj.tags || 'N1';
                    var lastFinalUrl = obj.url || 'N/A';
                    var harmless = obj.harmless || 0;
                    var malicious = obj.malicious || 0;
                    var suspicious = obj.suspicious || 0;
                    var undetected = obj.undetected || 0;
                    var total = harmless + malicious + suspicious + undetected;
                    var comments = obj.comments || 'N1';


                    var viewButton = '<button class="view-button btn btn-xs"><i class="fa fa-eye"></i></button>';
                    var updateButton = '<button class="update-button btn btn-xs" data-toggle="modal" data-target="#update-modal" data-active_id="' + obj.active_id + '"><i class="fa fa-edit"></i></button>';
                    // var flagButton = malicious > 0 ? '<button class="flag-button btn btn-danger"><i class="fas fa-flag"></i></button>' : '<button class="flag-button btn btn-success"><i class="fas fa-flag"></i></button>';
                    var flagButton = malicious > 0 ? '<button class="flag-button"><i class="fas fa-flag" style="color: red;"></i></button>' : '<button class="flag-button"><i class="fas fa-flag" style="color: green;"></i></button>';

                    // Create a single cell with both buttons
                    var actionsCell = flagButton + ' ' + viewButton + ' ' + updateButton;
                    // Add the data to the DataTable
                    dataTable.row.add([tags, lastFinalUrl, harmless, malicious, suspicious, undetected, total, comments, actionsCell]).draw();
                });
            } else {
                console.error("Response data is not an array.");
            }
        })
        .catch(error => {
            // Remove the loading row and show an error message
            dataTable.row(':contains("Please wait API is still loading...")').remove().draw();
            console.error("Error:", error);
        });


        $('#activedomain').on('click', '.view-button', function () {
        var row = $(this).closest('tr');
        var tags = row.find('td:eq(0)').text();
        var url = row.find('td:eq(1)').text();
        var harmless = row.find('td:eq(2)').text();
        var malicious = row.find('td:eq(3)').text();
        var suspicious = row.find('td:eq(4)').text();
        var undetected = row.find('td:eq(5)').text();
        var total = row.find('td:eq(6)').text();
        var comments = row.find('td:eq(7)').text();

        // Populate the modal fields with data
        $('#modal-tags').text('Aff ID: ' + tags);
        $('#modal-url').text('URL: ' + url);
        $('#modal-harmless').text('Harmless: ' + harmless);
        $('#modal-malicious').text('Malicious: ' + malicious);
        $('#modal-suspicious').text('Suspicious: ' + suspicious);
        $('#modal-undetected').text('Undetected: ' + undetected);
        $('#modal-total').text('Total: ' + total);
        $('#modal-comments').text('Comments: ' + comments);
        
        // Show the modal
        $('#view-modal').modal('show');
    });


$('#activedomain').on('click', '.update-button', function () {
    var row = $(this).closest('tr');
    var active_id = $(this).data('active_id');
    var tags = row.find('td:eq(0)').text(); // Assuming this contains semicolon-separated tags

    // Split the tags into an array using the semicolon delimiter
    var tagArray = tags.split(';');

    // Set the "Aff ID" input field with the first tag
    $('#u_tags').val(tagArray.shift());

    // Populate the "additional-tags-container" with the remaining tags
    var additionalTagsContainer = document.getElementById("additional-tags-container");
    additionalTagsContainer.innerHTML = ''; // Clear previous tags
    tagArray.forEach(function (tag) {
        const input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("class", "form-control");
        input.setAttribute("name", "u_tags[]");
        input.setAttribute("placeholder", "Additional Aff ID");
        input.value = tag;
        additionalTagsContainer.appendChild(input);
    });

    // Show the update modal
    $('#update-modal').modal('show');

    // Set other fields as well
    var url = row.find('td:eq(1)').text();
    var comments = row.find('td:eq(7)').text();

    $('#u_url').val(url);
    $('#u_comment').val(comments);
    $('#u_active_id').val(active_id); // Set the active_id in a hidden input field
});
});

document.addEventListener("DOMContentLoaded", function () {
            const addTagsButton = document.getElementById("add-tags-button");
            const removeTagsButton = document.getElementById("remove-tags-button");
            const additionalTagsContainer = document.getElementById("additional-tags-container");

            addTagsButton.addEventListener("click", function () {
                const input = createInputField();
                additionalTagsContainer.appendChild(input);
            });

            removeTagsButton.addEventListener("click", function () {
                const inputFields = additionalTagsContainer.querySelectorAll("input");
                if (inputFields.length > 0) {
                    const lastInputField = inputFields[inputFields.length - 1];
                    additionalTagsContainer.removeChild(lastInputField);
                }
            });

            function createInputField() {
                const input = document.createElement("input");
                input.setAttribute("type", "text");
                input.setAttribute("class", "form-control");
                input.setAttribute("name", "u_tags[]");
                input.setAttribute("placeholder", "Additional Aff ID");

                // Add an event listener to restrict input to numbers and semicolons
                input.addEventListener("input", function () {
                    const inputValue = input.value;
                    const filteredValue = inputValue.replace(/[^0-9;NA\-_.,?!@#$%^&*()+=<>\/]/g, ''); // Allow numbers, semicolons, 'N', 'A', '/', and specified symbols
                    input.value = filteredValue;
                });

                return input;
            }

    const form = document.getElementById("update-modal-form");
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get the value from the "Aff ID" input field
        const uTagsInput = document.getElementById("u_tags");
        const uTagsValue = uTagsInput.value;

        // Gather all values of input fields with the name "u_tags[]" into an array
        const uTagsInputs = document.querySelectorAll('input[name="u_tags[]"]');
        const uTagsValues = Array.from(uTagsInputs).map((input) => input.value);

        // Combine the "Aff ID" value with the dynamically added tags
        const allTags = [uTagsValue, ...uTagsValues];

        const formData = {
            u_tags: allTags,
            u_url: $('#u_url').val(),
            u_comment: $('#u_comment').val(),
            u_active_id: $('#u_active_id').val(),
        };

        var base_url = "https://crm.tremendio.network/adminactivedomain/update_modal";

        $.ajax({
            type: "POST",
            url: base_url,
            data: formData,
            dataType: "json",
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
                console.error(xhr.responseText);
                alert("An error occurred while updating the record. Please check the console for details.");
            }
        });
    });
});


// Get the input element by its ID
var inputElement = document.getElementById("u_tags");

// Add an input event listener to the input element
inputElement.addEventListener("input", function(event) {
    // Get the input value
    var inputValue = event.target.value;

    // Use a regular expression to allow only numbers and semicolon
    var numbersAndSemicolonOnly = inputValue.replace(/[^0-9;NA\-_.,?!@#$%^&*()+=<>\/]/g, ''); // Allow numbers, semicolons, 'N', 'A', '/', and specified symbols

    // Update the input value with only numbers and semicolon
    event.target.value = numbersAndSemicolonOnly;
}); */
</script>