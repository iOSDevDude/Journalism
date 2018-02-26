$(document).ready(function() {

	$('#studentListTable').dataTable({
		"pageLength": 25,
	    "bLengthChange": false,
	    "bFilter": true,
	    "responsive": true });

	Highcharts.setOptions({
		colors: ['#4B721D', ' #3B6E8F', '#AF1E2D']
    });

	$.getJSON("/kscJournalismApp/assets/js/data.json", function(result){
        $.each(result, function(i, field){
            var chart = new Highcharts.Chart({
    	      chart: {
    	         renderTo: 'container' + field[0] + "-" + field[1],
    	         type: 'pie'
    	      },
    	      title: {
    	      	text: field[0] + "-" + field[1]
    	      },
    	      tooltip: {
				pointFormat: '{point.y}</b>'
    	      },
    	      plotOptions: {
    	          pie: {
    	              allowPointSelect: true,
    	              cursor: 'pointer',
    	              dataLabels: {
    	                  enabled: true,
    	                  format: '<b>{point.name}</b>: {point.y}',
    	                  style: {
    	                      color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
    	                  }
    	              }
    	          }
    	      },
    	      series: [{
				data: [{
					name: "Completed",
					y: field[2]
				}, {
					name: "In Progress",
					y: field[3]
				}, {
					name: "Not Taken / Retake",
					y: field[4]
				}],
				pointStart: 0,
				// pointInterval
    	      }],
    	      credits: false
    		});
        });
    });
});
