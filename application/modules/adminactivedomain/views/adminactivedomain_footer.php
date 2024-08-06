<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const baseUrl = "https://crm.tremendio.network/";
    const dataTable = initializeDataTable();
    const existingUrls = [];

    fetchData();

    setInterval(fetchData, 24 * 60 * 60 * 1000);

    function initializeDataTable() {
        return $('#activedomain').DataTable({
            pageLength: 25,
            order: [[3, "desc"]],
            processing: true
        });
    }

    function fetchData() {
        fetch(`${baseUrl}adminactivedomain/activedomain_api`, {
            headers: {
                'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
            }
        })
        .then(response => response.json())
        .then(data => updateDataTable(data.info.details.tracking_domains))
        .catch(error => console.error("Error:", error));
    }

    function updateDataTable(trackingDomains) {
        if (!Array.isArray(trackingDomains)) {
            console.error("Invalid tracking domains data.");
            return;
        }

        dataTable.clear().draw();
        trackingDomains.forEach(domain => {
            const domainName = domain.name;
            if (!existingUrls.includes(domainName)) {
                dataTable.row.add([domainName]);
                existingUrls.push(domainName);
            }
        });
        dataTable.draw();
    }

    $('#activedomain').on('click', '.view-button', function() {
        const row = $(this).closest('tr');
        const modalData = {
            tags: row.find('td:eq(0)').text(),
            url: row.find('td:eq(1)').text(),
            harmless: row.find('td:eq(2)').text(),
            malicious: row.find('td:eq(3)').text(),
            suspicious: row.find('td:eq(4)').text(),
            undetected: row.find('td:eq(5)').text(),
            total: row.find('td:eq(6)').text(),
            comments: row.find('td:eq(7)').text()
        };
        populateModal(modalData);
        $('#view-modal').modal('show');
    });

    function populateModal(data) {
        $('#modal-tags').text(`Aff ID: ${data.tags}`);
        $('#modal-url').text(`URL: ${data.url}`);
        $('#modal-harmless').text(`Harmless: ${data.harmless}`);
        $('#modal-malicious').text(`Malicious: ${data.malicious}`);
        $('#modal-suspicious').text(`Suspicious: ${data.suspicious}`);
        $('#modal-undetected').text(`Undetected: ${data.undetected}`);
        $('#modal-total').text(`Total: ${data.total}`);
        $('#modal-comments').text(`Comments: ${data.comments}`);
    }

    $('#activedomain').on('click', '.update-button', function() {
        const row = $(this).closest('tr');
        const activeId = $(this).data('active_id');
        const tags = row.find('td:eq(0)').text().split(';');
        const url = row.find('td:eq(1)').text();
        const comments = row.find('td:eq(7)').text();
        populateUpdateModal(activeId, tags, url, comments);
        $('#update-modal').modal('show');
    });

    function populateUpdateModal(activeId, tags, url, comments) {
        $('#u_tags').val(tags.shift());
        const additionalTagsContainer = document.getElementById("additional-tags-container");
        additionalTagsContainer.innerHTML = '';
        tags.forEach(tag => {
            const input = createInputField(tag);
            additionalTagsContainer.appendChild(input);
        });
        $('#u_url').val(url);
        $('#u_comment').val(comments);
        $('#u_active_id').val(activeId);
    }

    function createInputField(value = '') {
        const input = document.createElement("input");
        input.type = "text";
        input.className = "form-control";
        input.name = "u_tags[]";
        input.placeholder = "Additional Aff ID";
        input.value = value;
        input.addEventListener("input", function() {
            input.value = input.value.replace(/[^0-9;NA\-_.,?!@#$%^&*()+=<>\/]/g, '');
        });
        return input;
    }

    document.getElementById("add-tags-button").addEventListener("click", function() {
        const input = createInputField();
        document.getElementById("additional-tags-container").appendChild(input);
    });

    document.getElementById("remove-tags-button").addEventListener("click", function() {
        const container = document.getElementById("additional-tags-container");
        if (container.children.length > 0) {
            container.removeChild(container.lastChild);
        }
    });

    // Function to handle form submission in the update modal
    document.getElementById("update-form").addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch(`${baseUrl}adminactivedomain/update`, {
            method: 'POST',
            headers: {
                'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(formData).toString()
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#update-modal').modal('hide');
                fetchData(); // Refresh data
            } else {
                console.error("Update failed:", data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    });
});





    </script>

