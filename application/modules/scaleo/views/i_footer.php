<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
<script>
 anychart.onDocumentReady(function () {
      // create pie chart with passed data
      var chart_data = JSON.parse('<?=$tab_per_offer_data;?>');

      chart_data.forEach(function(item, index, arr) {
          console.log(item);
          
        /*  window["chart"+index]= anychart.pie3d([
            ['Payout', item.total_payout],
            ['Approx Spend', item.approx_spend],
          ]);

          // set chart title text settings
          window["chart"+index].title('').radius('43%');

          // set container id for the chart
          window["chart"+index].container('chartContainer'+index);
          // initiate chart drawing
          window["chart"+index].draw(); 
            */
        // create a chart
        window["chart"+index]= anychart.column();

        // create a column series and set the data
        var series =  window["chart"+index].column(item.bar_data);
        window["chart"+index].container('barChart'+index);

        // initiate chart drawing
        window["chart"+index].draw();



       });
  

	   $(".anychart-credits").hide();

});
$("#dateFilter").on('change',function(){
    window.location.href= '<?=base_url()?>scaleo/filter/'+ $(this).val();
}); 
$("#refresh").click(function(){
  location.reload();
});

</script>