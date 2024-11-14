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
    const base_url = "https://crm.tremendio.network/";

    var dataTable = $('#activedomain').DataTable({
        "pageLength": 10,
        "order": [[3, "desc"]]
    });

    fetchData();

    function fetchData() {
        fetch(base_url + 'activedomain/activedomain_api', {
            headers: {
                'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
            }
        })
        .then(response => response.json())
        .then(data => {
            dataTable.clear().draw(); // Clear existing data in DataTable

            if (Array.isArray(data)) {
                data.forEach(obj => {
                    const tags = obj.tags || 'N1';
                    const lastFinalUrl = obj.url || 'N/A';
                    const comments = obj.comments || 'N1';

                    // Actions cell with view and update buttons
                    const actionsCell = `
                        <button class="view-button btn btn-xs"><i class="fa fa-eye"></i></button>
                        <button class="update-button btn btn-xs" data-toggle="modal" data-target="#update-modal" data-active_id="${obj.active_id}">
                            <i class="fa fa-edit"></i>
                        </button>
                    `;

                    dataTable.row.add([tags, lastFinalUrl, '', '', '', '', '', comments, actionsCell]).draw();
                });
            }
        })
        .catch(error => console.error("Error:", error));
    }

    $('#activedomain').on('click', '.view-button', function () {
        const row = $(this).closest('tr');
        $('#modal-tags').text('Aff ID: ' + row.find('td:eq(0)').text());
        $('#modal-url').text('URL: ' + row.find('td:eq(1)').text());
        $('#modal-comments').text('Comments: ' + row.find('td:eq(7)').text());
        $('#view-modal').modal('show');
    });

    $('#activedomain').on('click', '.update-button', function () {
        const row = $(this).closest('tr');
        const active_id = $(this).data('active_id');
        const tags = row.find('td:eq(0)').text().split(';');
        const url = row.find('td:eq(1)').text();
        const comments = row.find('td:eq(7)').text();

        $('#u_url').val(url);
        $('#u_comment').val(comments);
        $('#u_active_id').val(active_id);
        $('#u_tags').val(tags.shift());

        const additionalTagsContainer = document.getElementById("additional-tags-container");
        additionalTagsContainer.innerHTML = ''; 
        tags.forEach(tag => {
            const input = createInputField(tag);
            additionalTagsContainer.appendChild(input);
        });

        $('#update-modal').modal('show');
    });

    function createInputField(value = '') {
        const input = document.createElement("input");
        input.type = "text";
        input.className = "form-control";
        input.name = "u_tags[]";
        input.placeholder = "Additional Aff ID";
        input.value = value;
        return input;
    }
});






    </script>