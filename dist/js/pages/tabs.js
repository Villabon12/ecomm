$('ul.nav-tabs li a:first').addClass('active');
$('.tab-pane ').hide();
$('.tab-pane:first').show();


$('ul.nav-tabs li a').click(function () {
	$('ul.nav-tabs li a').removeClass('active');
	$(this).addClass('active');
	$('.tab-pane').hide();
	var activeTab = $(this).attr('href');
	console.log(activeTab);
	$(activeTab).show();
	return false;
});




var options = {
	series: [{
		name: "Desktops",
		data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
	}],
	chart: {
		height: 350,
		type: 'line',
		zoom: {
			enabled: false
		},
		foreColor: '#ffffff'
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		curve: 'straight'
	},
	title: {
		text: 'TUS COMPRAS DE USDT',
		align: 'left'
	},
	xaxis: {
		categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep'],
	}
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
