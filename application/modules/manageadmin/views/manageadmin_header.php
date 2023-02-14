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
        background: #ffd0d7;
   }
   .modal-header #AddUserModalTitle,
   #AddUserModal
   {
      color: #000;
   }
   .modal-header #UpdateUserModalTitle,
   #UpdateUserModal
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
   #adduser input,
   #adduser textarea {
      border: 1px solid #000!important;
      padding: 6px;
      background-color: #87dfe9 !important;
   }

   #adduser label {
      color: #000;
      font-weight: 500;
   }
   #updateusers input,
   #updateusers textarea {
      border: 1px solid #000!important;
      padding: 6px;
      background-color: #87dfe9 !important;
   }

   #updateusers label {
      color: #000;
      font-weight: 500;
   }
   
   #user_datatable thead {
      background: #87dfe9 !important;
    color: #000;
   }

   #user_datatable {
      border-bottom: 1px solid #0a205c;
   }
   .edit-users,
   .delete-users
  {
    background: #ECFFDC;
      color: #2E8B57;
      border-radius: 25%;
      border: 1px solid #2E8B57;
   }

   .edit-users:hover,
   .delete-users:hover
   {
      background: #2E8B57;
      color: #ECFFDC;
      border-radius: 25%;
      border: 1px solid #2E8B57;
   }
   

</style>