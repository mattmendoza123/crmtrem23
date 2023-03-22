<link href="<?= base_url() . "assets"; ?>/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url() . "assets"; ?>/css/responsive.dataTables.min.css" rel="stylesheet">
<style media="screen">
table.table:first-child .delete-users{
   display: none;

}

/* table#crm_datatable td:first-child,
table#crm_datatable td:nth-child(20) ~ td {
  display: none;
} */
td:nth-of-type(3) {
  display: none !important;
}
th:nth-of-type(3) {
  display: none !important;
}
td:nth-of-type(4) {
  display: none !important;
}
th:nth-of-type(4) {
  display: none !important;
}
td:nth-of-type(5) {
  display: none !important;
}
th:nth-of-type(5) {
  display: none !important;
}
td:nth-of-type(7) {
  display: none !important;
}
th:nth-of-type(7) {
  display: none !important;
}
td:nth-of-type(8) {
  display: none !important;
}
th:nth-of-type(8) {
  display: none !important;
}
/* td:nth-of-type(9) {
  display: none !important;
}
th:nth-of-type(9) {
  display: none !important;
} */
/* td:nth-of-type(10) {
  display: none !important;
}
th:nth-of-type(10) {
  display: none !important;
} */
/* td:nth-of-type(11) {
  display: none !important;
}
th:nth-of-type(11) {
  display: none !important;
}
td:nth-of-type(12) {
  display: none !important;
}
th:nth-of-type(12) {
  display: none !important;
} */
td:nth-of-type(13) {
  display: none !important;
}
th:nth-of-type(13) {
  display: none !important;
}
td:nth-of-type(14) {
  display: none !important; 
}
th:nth-of-type(14) {
  display: none !important;
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
   .modal-header #ViewUserModalTitle,
   #ViewUserModal
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
   #adduser textarea,
   #adduser select
   {
      border: 1px solid #000!important;
      padding: 6px;
      background-color: #87dfe9 !important;
   }

   #adduser label {
      color: #000;
      font-weight: 500;
   }
   #updatecrmaff input,
   #updatecrmaff textarea,
   #updatecrmaff select,
   #updatecrmaff button
   {
      border: 1px solid #000 !important;
      padding: 4px;
      background-color: #87dfe9 !important;
      color: #000;
   }

   #viewcrmaff input,
   #viewcrmaff textarea,
   #viewcrmaff select{
      border: 1px solid #000 !important;
      padding: 6px;
      background-color: #87dfe9 !important;
   }
   #viewcrmaff label {
      color: #000;
      font-weight: 500;
   }
   
   #updatecrmaff label {
      color: #000;
      font-weight: 500;
   }
   
   #crmaff_datatable thead {
    background: #87dfe9 !important;
    color: #000;
   }

   #crmaff_datatable {
      border-bottom: 1px solid #0a205c;
   }
   .edit-crmaff
   {
      background: #ECFFDC;
      color: #2E8B57;
      border-radius: 25%;
      border: 1px solid #2E8B57;
   }
   .delete-crmaff
   {
      background: #ffcccb;
      color: #FF0000;
      border-radius: 25%;
      border: 1px solid #FF0000;
   }
   .view-crmaff
  {
      background: #e8f4f8;
      color: #0000FF;
      border-radius: 25%;
      border: 1px solid #0000FF;
   }

   .edit-crmaff:hover
   {
      background: #2E8B57;
      color: #ECFFDC;
      border-radius: 25%;
      border: 1px solid #2E8B57;
   }
   .delete-crmaff:hover
   {
      background: #FF0000;
      color: #ffcccb;
      border-radius: 25%;
      border: 1px solid #FF0000;
   }
   .view-crmaff:hover
   {
      background: #0000FF;
      color:  #e8f4f8;
      border-radius: 25%;
      border: 1px solid #0000FF;
   }

   input[type=checkbox], input[type=radio] {
    box-sizing: border-box;
    /* padding: 0; */
    transform: scale(1.5);
    margin: 10px;
   }

   .form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: none !important;
    /* box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%); */
   }
   #viewcrmaff .form-control:disabled {
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
   .business-card img {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 100%;
      max-width: 292px;
   }
   .up-business-card {
      border: 1px solid #000!important;
      padding: 6px;
      /* background-color: #87dfe9 !important; */
   }
   #inputGroupFileAddon01{
      border: 1px solid #000!important;
      padding: 6px;
      background-color: #87dfe9 !important;
   }
   #addusermodal {
    background-color: #fff !important;
    border: 1px solid #000 !important;
   }
   #updateusermodal {
    background-color: #fff !important;
    border: 1px solid #000 !important;
   }
   #viewusermodal {
    background-color: #fff !important;
    border: 1px solid #000 !important;
   }
   .req {
    color: red;
   }

   *:required {
    background-color: gold;
   }

</style>