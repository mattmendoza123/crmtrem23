<style>
    #activedomain thead {
    background: #87dfe9 !important;
    color: #000 !important;
   }

   table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid #111;
}
   table thead th, .table th {
    border: 1px solid #000 ;
   }
   table.dataTable thead th, table.dataTable tfoot th {
    font-weight: bold;
}
.dataTables_wrapper {
    padding-top: 10px;
    color: #000;
}

#swal2-icon-content{
    display:none !important;
}
.swal2-icon-content{
    display:none !important;
}
#activedomain tbody tr td:nth-child(3), /* Hide Harmless column in all rows */
#activedomain tbody tr td:nth-child(5), /* Hide Suspicious column in all rows */
#activedomain tbody tr td:nth-child(6) /* Hide Undetected column in all rows */
{
    display: none;
}

#activedomain th:nth-child(3), /* Hide Harmless */
#activedomain th:nth-child(5), /* Hide Suspicious */
#activedomain th:nth-child(6) /* Hide Undetected */
{
    display: none;
}


/* Apply the specified widths to the columns */
.aff-id {
    width: 50px;
}

.url {
    width: 150px;
}

.malicious {
    width: 50px;
}

.total {
    width: 50px;
}

.comments {
    width: 200px;
}

.actions {
    width: 150px;
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
   .modal-header #exampleModalLabel
   {
      color: #000;
   }
   .modal-header #UpdateModalTitle
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

   #update-modal input,
   #update-modal textarea,
   #update-modal select
   {
      border: 1px solid #000 !important;
      padding: 4px;
      background-color: #87dfe9 !important;
      color: #000;
   }

   #update-modal label {
      color: #000;
      font-weight: 500;
   }

   #view-modal label {
      color: #000;
      font-weight: 500;
   }
   #modal-tags, #modal-url, #modal-harmless, 
   #modal-malicious, #modal-suspicious, 
   #modal-undetected, #modal-total, 
   #modal-comments{
    color: #000;
      font-weight: 500;
   }
   .update-button
   {
      background: #ECFFDC;
      color: #2E8B57;
      border-radius: 25%;
      border: 1px solid #2E8B57;
   }

.update-button:hover
   {
      background: #2E8B57;
      color: #ECFFDC;
      border-radius: 25%;
      border: 1px solid #2E8B57;
   }

   .view-button
  {
      background: #e8f4f8;
      color: #0000FF;
      border-radius: 25%;
      border: 1px solid #0000FF;
   }

   .view-button:hover
   {
      background: #0000FF;
      color:  #e8f4f8;
      border-radius: 25%;
      border: 1px solid #0000FF;
   }
</style>
