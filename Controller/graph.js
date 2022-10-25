function pagos(){
		
			$.ajax({
				url:"Controllers/graph.php",
				contentType: "application/json; charset=utf-8",
	        	method: "POST",
	        	dataType:"JSON",
	        	success: function(data) {
	            var Periodo = [];
	            var TotalVenta = [];
	            var color = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)','rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
	            var bordercolor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
	            console.log(data);
	 
	            for (var i in data) {
	                Periodo.push(data[i].Periodo);
	                TotalVenta.push(parseFloat(data[i].TotalVenta) );
	            }
	 
	            var chartdata = {
	                labels: Periodo,
	                datasets: [{
	                    label: "Ventas C$",
	                    backgroundColor: color,
	                    borderColor: color,
	                    borderWidth: 2,
	                    hoverBackgroundColor: color,
	                    hoverBorderColor: bordercolor,
	                    data: TotalVenta
	                }]
	            };
	 
	            var mostrar = document.getElementById("chartBarra").getContext("2d");
	 
	            var grafico = new Chart(mostrar, {
	                type: 'bar',
	                data: chartdata,
	                options: {
	                    responsive: true,
	                    scales: {
	                        yAxes: [{
	                            ticks: {
	                                beginAtZero: true
	                            }
	                        }]
	                    }
	                }
	                
	            });

	            
	            

	            
	        },
	        error:function(data) {
	            console.log(data);
	        }
		});

			
	}