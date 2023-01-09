<link href="<?= base_url() . "assets"; ?>/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url() . "assets"; ?>/css/responsive.dataTables.min.css" rel="stylesheet">
<style media="screen">
table.table:first-child .delete-users{
   display: none;

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
      background: #004987;
   }
   .modal-header #AddUserModalTitle,
   #AddUserModal
   {
      color: #fff;
   }
   .modal-header #UpdateUserModalTitle,
   #UpdateUserModal
   {
      color: #fff;
   }
   .atm-button {
      background: #004987 !important;
      border: 1px solid;
      border-radius: 30px;
      color: #fff;
   }

   .atm-button:hover {
      background: #004987 !important;
      border: 1px solid;
      color: #fff;
   }
   #adduser input,
   #adduser textarea {
      border: 1px solid #004987 !important;
      padding: 4px;
      background-color: #b3dbf8 !important;
   }

   #adduser label {
      color: #000;
      font-weight: 500;
   }
   #updateusers input,
   #updateusers textarea {
      border: 1px solid #004987 !important;
      padding: 4px;
      background-color: #b3dbf8 !important;
      color: #000;
   }

   #updateusers label {
      color: #000;
      font-weight: 500;
   }
   
   #user_datatable thead {
      background: #004987;
      color: #fff;
   }

   #user_datatable {
      border-bottom: 1px solid #0a205c;
   }
   .edit-users,
   .delete-users
  {
      background: #004987;
      color: #fff;
      border-radius: 100%;
   }

   .edit-users:hover,
   .delete-users:hover
   {
      background: #004987;
      color: #fff;
      border-radius: 100%;
   }
   

</style>