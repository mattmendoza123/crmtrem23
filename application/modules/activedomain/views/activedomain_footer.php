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

    function fetchData() {
        fetch(base_url + 'activedomain/activedomain_api', {
            headers: {
                'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
            }
        })
        .then(response => response.json())
        .then(data => {
            var trackingDomains = data.info.details.tracking_domains;

            if (dataTable) {
                dataTable.clear().draw(); // Clear existing data in DataTable
            } else {
                dataTable = $('#activedomain_tremendio').DataTable({
                    processing: true,
                    order: [[0, "desc"]],
                    pageLength: 50
                });
            }

            trackingDomains.forEach(trackingDomain => {
                var trackingDomainName = trackingDomain.name;
                if (!existingUrls.includes(trackingDomainName)) {
                    // Insert only if it's not in the existing URLs array
                    dataTable.row.add([trackingDomainName]);
                    existingUrls.push(trackingDomainName); // Add to existing URLs
                }
            });

            dataTable.draw();
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }

    fetchData(); // Initial fetch and insertion on page load

    // Refresh data every 24 hours
    setInterval(fetchData, 24 * 60 * 60 * 1000);
});





// // VIRUSTOTAL



$(document).ready(function () {
    var dataTable = $('#activedomaintable').DataTable({
        "pageLength": 10,
        "order": [[3, "desc"]],
        "processing": true
    });

    function fetchActiveDomains() {
        fetch(base_url + 'activedomain/activedomain_api', {
            headers: { 'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da' }
        })
            .then(response => response.json())
            .then(data => {
                dataTable.clear();
                if (data.success) {
                    data.info.details.tracking_domains.forEach(domain => {
                        dataTable.row.add([domain.name]);
                    });
                    dataTable.draw();
                } else {
                    console.error("Error:", data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    }

    fetchActiveDomains();

    $('#activedomain').on('click', '.update-button', function () {
        var row = $(this).closest('tr');
        var active_id = $(this).data('active_id');
        $('#u_active_id').val(active_id);
        $('#u_tags').val(row.find('td:eq(0)').text());
        $('#u_url').val(row.find('td:eq(1)').text());
        $('#u_comment').val(row.find('td:eq(7)').text());
        $('#update-modal').modal('show');
    });

    $('#update-modal-form').on('submit', function (e) {
        e.preventDefault();
        const formData = {
            u_tags: [$('#u_tags').val(), ...$('input[name="u_tags[]"]').map((_, el) => el.value).get()],
            u_url: $('#u_url').val(),
            u_comment: $('#u_comment').val(),
            u_active_id: $('#u_active_id').val(),
        };

        $.ajax({
            type: "POST",
            url: base_url + 'activedomain/update_modal',
            data: formData,
            dataType: "json",
            success: function (data) {
                $('#update-modal').modal('hide');
                Swal.fire({
                    icon: data.success ? 'success' : 'error',
                    text: data.message,
                }).then(() => location.reload());
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert("An error occurred. Check the console for details.");
            }
        });
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

        var base_url = "https://crm.tremendio.network/activedomain/update_modal";

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
});







    </script>