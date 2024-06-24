<link href="<?= base_url() . "assets"; ?>/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url() . "assets"; ?>/css/responsive.dataTables.min.css" rel="stylesheet">
<style media="screen">
 #invalidclicks_table thead {
    background: #87dfe9 !important;
    color: #000;
   }

   #invalidclicks_table{
      border-bottom: 1px solid #0a205c;
   }
   
   table thead th, .table th {
    border: 1px solid #000;
   }

     /* Hide the "Offer" column in the table */
  #invalidclicks_table th:nth-child(2),
  #invalidclicks_table td:nth-child(2) {
    display: none;
  }

  .view-offers {
    background: #e8f4f8;
    color: #0000FF;
    border-radius: 25%;
    border: 1px solid #0000FF;
    padding: 5px; /* Add padding to give space for the icon */
    display: flex; /* Add flex to center the icon vertically and horizontally */
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
    cursor: pointer;
}

.view-offers:hover {
    background: #0000FF;
    color: #e8f4f8;
}
.modal-header #ViewUserModalTitle,
#ViewUserModal {
    color: #000;
}

#viewcrm label {
    color: #000;
    font-weight: 500;
}

/* Center the modal footer text */
.modal-footer {
    text-align: center;
}

/* Update the modal header background color */
.modal-header {
    background: #ffd0d7;
}

/* Add a border to the modal when it's shown */
.modal.show .modal-dialog {
    border: 1px solid #000;
}

/* Define a custom modal size for large modals */
.modal-lg {
    max-width: 1200px !important;
    width: 100%;
}

/* Style the modal title */
#myModalLabel {
    font-size: 30px;
    text-align: center;
}

.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
    color: #000;
}

.modal-body{
  color: #000;
}
</style>
