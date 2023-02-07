<link href="<?= base_url() . "assets"; ?>/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url() . "assets"; ?>/css/responsive.dataTables.min.css" rel="stylesheet">
<style media="screen">
table.table:first-child .delete-users{
   display: none;

}
.req {
    color: red;
}

*:required {
    background-color: gold;
}
   .modal-lg {
      /* margin-top: 10%; */
      max-width: 1200px !important;
      width: 100%;
   }

   #myModalLabel {
      font-size: 30px;
      text-align: center;
   }

   .select2-wrapper {
      width: 70%;
      margin: auto;
      margin-bottom: 20px;
   }

   .modal-footer {
      text-align: center;
   }

   .modal-header {
      background: #ffd0d7;
   }
   .modal.show .modal-dialog {
      border: 1px solid #000;
}
   .modal-header #AddIPModalTitle,
   #AddIPModal
   {
      color: #000;
   }
   .modal-header #UpdateUserModalTitle,
   #UpdateIPModal
   {
      color: #000;
   }
   .atm-button {
      background: #ffd0d7 !important;
      border: 1px solid;
      border-radius: 30px;
      color: #000;
   }

   .atm-button:hover {
      background: #87dfe9!important;
      border: 1px solid #000;
      color: #fff;
   }
   #addip input,
   #addip textarea,
   #addip select
   {
      border: 1px solid #000!important;
      padding: 6px;
      background-color: #87dfe9 !important;
   }

   #addip label {
      color: #000;
      font-weight: 500;
   }
   #updateip input,
   #updateip textarea,
   #updateip select,
   #updateip button
   {
      border: 1px solid #000 !important;
      padding: 4px;
      background-color: #87dfe9 !important;
      color: #000;
   }

   
   #updateip label {
      color: #000;
      font-weight: 500;
   }
   
   #ipwhitelist_datatable thead {
    background: #87dfe9 !important;
    color: #000;
   }

   #ipwhitelist_datatable {
      border-bottom: 1px solid #0a205c;
   }
   .edit-ip
   {
      background: #ECFFDC;
      color: #2E8B57;
      border-radius: 25%;
      border: 1px solid #2E8B57;
   }
   .delete-ip
   {
      background: #ffcccb;
      color: #FF0000;
      border-radius: 25%;
      border: 1px solid #FF0000;
   }

   .edit-ip:hover
   {
      background: #2E8B57;
      color: #ECFFDC;
      border-radius: 25%;
      border: 1px solid #2E8B57;
   }
   .delete-ip:hover
   {
      background: #FF0000;
      color: #ffcccb;
      border-radius: 25%;
      border: 1px solid #FF0000;
   }

   .form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: none !important;
    /* box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%); */
   }
   #viewip .form-control:disabled {
    opacity: 1 !important;
    color: #000;
   }

   .card-body{
      border: 1px solid;
    border-radius: 30px;
   }

   table thead th, .table th {
    border: 1px solid #000;
   }

   #addipmodal {
    background-color: #fff !important;
    border: 1px solid #000 !important;
   }


   .delete-users
   {
      background: #e8f4f8;
      color: #0000FF;
      border-radius: 25%;
      border: 1px solid #0000FF;
   }



   .delete-users:hover
   {
      background: #0000FF;
      color:  #e8f4f8;
      border-radius: 25%;
      border: 1px solid #0000FF;
   }


</style>