

$(function() {
	var base_url = $("#base_url").val();
	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	if(window.location.href == base_url+'/customerassignment'){
		getAssignRequestChart('monthly');	
	}

});

	function assign_chart(data1, data2 ,categories){

		data1 = data1.split(",");
		data2 = data2.split(",");
		categories = categories.split(",");
		
		//var columnCtx = document.getElementById("sales_chart"),
		var columnCtx = document.getElementById("assign_chart"),
			columnConfig = {
				colors: ['#7638ff', '#fda600'],
				series: [{
					name: "Accepted",
					type: "column",
					data: data1
				}, {
					name: "Rejected",
					type: "column",
					data: data2
				}],
				chart: {
					type: 'bar',
					fontFamily: 'Poppins, sans-serif',
					height: 350,
					toolbar: {
						show: false
					}
				},
				plotOptions: {
					bar: {
						horizontal: false,
						columnWidth: '60%',
						endingShape: 'rounded'
					},
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					show: true,
					width: 2,
					colors: ['transparent']
				},
				xaxis: {
					categories: categories,
				},
				yaxis: {
					title: {
						text: ' (customer)'
					}
				},
				fill: {
					opacity: 1
				},
				tooltip: {
					y: {
						formatter: function(val) {
							return " " + val + " customer"
						}
					}
				}
			};
		var columnChart = new ApexCharts(columnCtx, columnConfig);
		columnChart.render();
				
	}

	function getAssignRequestChart(el)
	{
		var base_url = $("#base_url").val();
		var type = $(el).data('type');
		//alert(type);
		type = (type !=undefined)?type:'monthly';
		var active = "";
		var rejected = "";
		var categories = "";
		var separeted1 = "";
		var separeted2 = "";
		var sum1 = 0;
		var sum2 = 0;
		$.ajax({
			url: base_url + '/getAssignRequestChart',
			type:'POST',
			data:{'type': type},
			success: function(res) {
				//console.log(res);
				 active = res.active;
				 rejected = res.rejected;
				 categories = res.categories;
				 separeted1 = active.split(",");
				 separeted2 = rejected.split(",");
				 sum1 = 0;
				 sum2 = 0;
				for (var i = 0; i < separeted1.length; i++) {
					sum1 += parseInt(separeted1[i].toString().match(/(\d+)/));
				}
				for (var j = 0; j < separeted2.length; j++) {
					sum2 += parseInt(separeted2[j].toString().match(/(\d+)/));
				}
				$("#reqTot").html(Number(sum1) + Number(sum2));
				$("#reqAce").html(sum1);
				$("#reqRej").html(sum2);
				assign_chart(active,rejected,categories);
			}
		});
	}
	

 	
