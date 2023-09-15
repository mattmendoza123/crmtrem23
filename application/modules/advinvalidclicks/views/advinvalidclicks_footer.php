<!-- Bootstrap popper Core JavaScript -->
<!-- <script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>

<script type="text/javascript">

//Final
$(document).ready(function () {
    var base_url = "https://crm.tremendio.network/";
    var dataTable = null;
    var affiliateOffers = {};
    var modalCounter = 0; // Counter to generate unique modal IDs

    function fetchData() {
        fetch(base_url + 'advinvalidclicks/invalidclick_api', {
            headers: {
                'api-key': 'aafcf12b64ca3230279a89aa8b6eacf03c7c59da'
            }
        })
            .then(response => response.json())
            .then(data => {
                var transactions = data.info.transactions;

                if (dataTable) {
                    dataTable.clear().draw();
                } else {
                    dataTable = $('#invalidclicks_table').DataTable({
                        processing: true,
                        order: [[3, "desc"]],
                        "pageLength": 50 // Set default number of rows per page
                    });
                }

                affiliateOffers = {};

                transactions.forEach(transaction => {
                    var affiliateName = transaction.affiliate ? transaction.affiliate.value : "N/A";
                    var offerName = transaction.offer ? transaction.offer.value : "N/A";
                    var clickTimestamp = transaction.added_timestamp ? new Date(transaction.added_timestamp) : "N/A";
                    var reason = transaction.reason ? transaction.reason : "N/A";

                    // Convert the timestamp to GMT+1 (CET)
                    clickTimestamp = clickTimestamp.toLocaleString('en-US', { timeZone: 'Europe/Belgrade' });

                    if (!affiliateOffers[affiliateName]) {
                        affiliateOffers[affiliateName] = [];
                    }

                    var existingOfferIndex = affiliateOffers[affiliateName].findIndex(offerInfo => offerInfo.offer === offerName);
                    if (existingOfferIndex !== -1) {
                        affiliateOffers[affiliateName][existingOfferIndex].clicks++;
                    } else {
                        affiliateOffers[affiliateName].push({
                            offer: offerName,
                            clicks: 1,
                            clickTimestamp: clickTimestamp,
                            reason: reason
                        });
                    }
                });

                var sortedAffiliateOffers = Object.keys(affiliateOffers).sort((a, b) => {
                    const latestTimestampA = affiliateOffers[a][0].clickTimestamp;
                    const latestTimestampB = affiliateOffers[b][0].clickTimestamp;
                    return latestTimestampB.localeCompare(latestTimestampA);
                });

                sortedAffiliateOffers.forEach(affiliate => {
                    if (affiliateOffers.hasOwnProperty(affiliate)) {
                        var nestedOffers = '';
                        var totalClicks = 0;

                        affiliateOffers[affiliate].forEach(offerInfo => {
                            nestedOffers += `
                                <p>Offer: ${offerInfo.offer}</p>
                                <p>Clicks: ${offerInfo.clicks}</p>
                                <p>Click Timestamp: ${offerInfo.clickTimestamp}</p>
                                <p>Reason: ${offerInfo.reason}</p>
                                <hr>
                            `;
                            totalClicks += offerInfo.clicks;
                        });

                        var modalId = 'offersModal' + modalCounter; // Generate a unique modal ID
                        var modalContentId = modalId + 'Content'; // Generate a unique modal content ID
                        var newRow = dataTable.row.add([
                            affiliate,
                            nestedOffers,
                            affiliateOffers[affiliate][0].clickTimestamp,
                            totalClicks,
                            '<button class="btn btn-primary btn-sm view-offers" data-toggle="modal" data-target="#' + modalId + '"><i class="fas fa-eye"></i></button>'
                        ]).draw().node();

                        modalCounter++; // Increment modal counter

                        // Create the modal and display offers for the selected affiliate
                        createAndDisplayModal(affiliateOffers[affiliate], modalId, modalContentId);
                    }
                });

                // Rebind the click event for the "View" buttons using event delegation
                $('#invalidclicks_table tbody').off('click', 'button.view-offers').on('click', 'button.view-offers', function () {
                    var data = dataTable.row($(this).parents('tr')).data();
                    var affiliateName = data[0];
                    var modalId = $(this).data('target'); // Get the target modal ID

                    // Display the pre-created modal with the selected content
                    $('#' + modalId).modal('show');
                });
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }

    fetchData();

    setInterval(fetchData, 24 * 60 * 60 * 1000);

    // Function to create and display the modal
    function createAndDisplayModal(offers, modalId, modalContentId) {
        var modalContent = '<div class="modal fade" id="' + modalId + '">';
        modalContent += '<div class="modal-dialog">';
        modalContent += '<div class="modal-content">';
        modalContent += '<div class="modal-header">';
        modalContent += '<h4 class="modal-title">Offers</h4>';
        modalContent += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        modalContent += '</div>';
        modalContent += '<div class="modal-body">';
        modalContent += '<div id="' + modalContentId + '">'; // Use the provided modalContentId

        offers.forEach(offerInfo => {
            modalContent += `
                <p>Offer: ${offerInfo.offer}</p>
                <p>Clicks: ${offerInfo.clicks}</p>
                <p>Click Timestamp: ${offerInfo.clickTimestamp}</p>
                <p>Reason: ${offerInfo.reason}</p>
                <hr>
            `;
        });

        modalContent += '</div>';
        modalContent += '</div>';
        // modalContent += '<div class="modal-footer">';
        // modalContent += '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
        modalContent += '</div>';
        modalContent += '</div>';
        modalContent += '</div>';
        modalContent += '</div>';

        $(modalContent).appendTo('body');
    }
});


</script>




