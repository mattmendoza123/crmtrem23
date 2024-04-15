
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery-ui.1.11.2.min.js"></script>
<script>
window.onload = function () {


var options = {
	animationEnabled: true,
	title:{
		text: "<?=$barchart_data_title_per_offer;?>"
	},	
	toolTip: {
		shared: true,
		reversed: true
	},
	data:<?=$tab_per_offer_data;?>
};

var options2 = {
	animationEnabled: true,
	title: {
		text: "<?=$barchart_data_title_total_offer;?>"
	},	
	data: [{		
		yValueFormatString: "#,##0.0#"%"",
		dataPoints: [<?=$data_totals;?>]
	}]
};

$("#tabs").tabs({
	create: function (event, ui) {
		//Render Charts after tabs have been created.
		$("#chartContainer").CanvasJSChart(options);
		$("#chartContainer2").CanvasJSChart(options2);
	},
	activate: function (event, ui) {
		//Updates the chart to its container size if it has changed.
		ui.newPanel.children().first().CanvasJSChart().render();
	}
});
}

$("#dateFilter").on('change',function(){
    console.log(jQuery(this).val())
}); 
</script>