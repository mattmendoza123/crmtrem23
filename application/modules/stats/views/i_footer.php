<!-- <script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/calcheight.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/table2csv.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/multiselect-dropdown.js"></script>
<style type="text/css">
a#dateSearch {
    background: black;
    color: #fff;
    padding: 5px 10px;
    margin-right: 10px;
}
span.green{
  color:#008000;
}
span.red{
  color:#fb3a3a;
}
div#topoffers_table_filter{
  display: flex;
}
.dataTables_filter span{
  padding:10px;
}
.offerTable{
  float : left;
}
.dataTable thead , .dataTable tfoot{
    background: #ccc;
}
select#dateFilter {
    width: 67%;
    margin-top: 3px;
    margin-bottom: 9px;
}
</style>

<script type="text/javascript">
$(document).ready(function(e) {
    get_topOffers("today");
    get_topAffiliates("today");
});

function dateSelect(date_filter){ 
 
  var dateFilter = [<?=json_encode($date_filters);?>];
  if(date_filter == ""){
    date_filter = "<?=$date_filter;?>";
  }  
   var select = '<span>Date: </span><select id="dateFilter" class="form-control">';
    dateFilter[0].forEach((df,i) => {  
      if(date_filter == df.name){
        select += '<option value="'+df.name+'" selected=selected>'+df.val+"</option>";
     } else {
        select += '<option value="'+df.name+'">'+df.val+"</option>";
     }
   });
   return select += '</select>';
}
function get_topAffiliates(dateSelected){    
      $('#topaffiliates_table').DataTable().clear().destroy();
      var filter_crm_type = "";
      var base_url = "<?php echo base_url(); ?>";
      var data_table = $('#topaffiliates_table').DataTable({
         paging: false,
        //  "pageLength": 50,       
          "processing": false,
          lengthChange: false,
          //bLengthChange: true,
        //  "lengthMenu": [ [10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"] ],
          "iDisplayLength": 50,
          bInfo: false,
          responsive: true,
          "bAutoWidth": false,
          "order": [
              [1, "desc"]
          ],            
          ajax: {
            url: base_url + 'stats/top_affiliates',
              data: { date_selected : dateSelected},               
              type: "POST",              
          },
          initComplete: function () {              
            $("#topaffiliates_table_filter label").before(dateSelect(dateSelected)).hide();
            jQuery("#topaffiliates_table_filter > #dateFilter").change(function(){                                         
              get_topAffiliates($(this).val());
            });       
            this.api()
                  .columns()
                  .every(function () {
                      let column = this;                     
                      let title = column.footer().textContent;                    
                  }); 

                
          }
      });
  }
function get_topOffers(dateSelected){    
      $('#topoffers_table').DataTable().clear().destroy();
      var filter_crm_type = "";
      var base_url = "<?php echo base_url(); ?>";
      var data_table = $('#topoffers_table').DataTable({
         paging: false,
         // "pageLength": 50,       
          "processing": false,
          lengthChange: false,
          // bLengthChange: true,
          //"lengthMenu": [ [10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"] ],
          "iDisplayLength": 50,
          bInfo: false,
          responsive: true,
          "bAutoWidth": false,
          "order": [
              [1, "desc"]
          ],            
          ajax: {
            url: base_url + 'stats/top_offers',
              data: { date_selected : dateSelected},               
              type: "POST",              
          },
          initComplete: function () {              
            $("#topoffers_table_filter label").before(dateSelect(dateSelected)).hide();
            jQuery("#topoffers_table_filter > #dateFilter").change(function(){                                         
               get_topOffers($(this).val());
            });       
            this.api()
                  .columns()
                  .every(function () {
                      let column = this;                    
                      let title = column.footer().textContent;                      
                  }); 

                
          }
      });
  }

</script>