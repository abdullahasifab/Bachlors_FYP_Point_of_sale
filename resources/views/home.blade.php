<x-Layout>
<style>
.subtitle {
	font-size: 16px;
	font-family: Verdana;
	font-weight: bold;
	color: #fefefe;
	text-align: center;
	line-height: 40px;
}
.bicon {
	font-size: 30px !important;
}
i {
border: none !important;
}
.mytable td {border: 1px solid rgba(255,255,255,0.3) !important}

</style>
<x-breadcrumb title="Dashboard"/>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card bg-gradient-success text-white shadow-lg">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h3>Products <i class="bi bi-boxes bicon" ></i></h3>
						<span class="subtitle">{{$totalproducts}}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bg-gradient-danger text-white shadow-lg">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h3>Today's Sale <i class="bi bi-cart-fill bicon" ></i></h3>
						<span class="subtitle">{{$todaysale}}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bg-gradient-info text-white shadow-lg">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h3>Today's Expense <i class="bi bi-cash-coin bicon" ></i></h3>
						<span class="subtitle">{{$totalexpense}}</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row my-3">
		<div class="card">
			<div class="card-body">
				<div id="chart"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" ><div class="card" style="height:355px">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<tr class="bg-gradient-dark text-gradient-dark">
							<td>Customer Name</td>
							<td>Amount</td>
						</tr>
						@foreach($defaulters as $item)
						<tr>
							<td>{{$item->name}}</td>
							<td class="text-dark">{{ abs($item->amount) }}</td>
							@endforeach
						</table>
					</div>
				</div></div></div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div id="donut" ></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row my-3">
				<div class="card shadow">
					<div class="card-header">Stock IN Hand</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead >
								<th>Sno</th>
								<th>Product Name</th>
								<th>Total Purchase</th>
								<th>Total Sale</th>
								<th>IN Hand</th>
							</thead>
							<tbody>
								@foreach($stockalerts as $item)
								<tr class="{{$item->inhand<10? 'bg-danger text-white':''}}">
									<td>{{$loop->iteration}}</td>
									<td>{{$item->product}}</td>
									<td>{{$item->purchase}}</td>
									<td>{{$item->sale}}</td>
									<td>{{$item->inhand}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{{asset('chart/apexcharts.min.js')}}"></script>
		<script>
		var options = {
		series: [{
		name: 'Daily-sale',
		{{$data}},
		},
		],
		chart: {
		height: 350,
		type: 'line',
		zoom: {
		enabled: false
		}
		},
		dataLabels: {
		enabled: false
		},
		stroke: {
		curve: 'straight'
		},
		title: {
		text: 'Sale Chart'
		},
		{!! $labels !!},
		yaxis: [{
		title: {
		text: 'Sale Quantity',
		},
		}, {
		opposite: true,
		title: {
		text: 'Sale Quantity'
		}
		}]
		};
		var chart = new ApexCharts(document.querySelector("#chart"), options);
		chart.render();
		</script>
		<script>
		var optionDonut = {
		chart: {
		type: 'donut',
		width: '100%',
		height: 300
		},
		dataLabels: {
		enabled: false,
		},
		plotOptions: {
		pie: {
		customScale: 0.8,
		donut: {
		size: '75%',
		},
		offsetY: 20,
		},
		stroke: {
		colors: undefined
		}
		},
		title: {
		text: 'Top 5 Selling Products',
		style: {
		fontSize: '18px'
		}
		},
		<?php echo $data1 ?>,
		<?php echo $labels1 ?>,
		legend: {
		position: 'left',
		offsetY: 80
		}
		}
		var donut = new ApexCharts(
		document.querySelector("#donut"),
		optionDonut
		)
		donut.render();
		function trigoSeries(cnt, strength) {
		var data = [];
		for (var i = 0; i < cnt; i++) {
		data.push((Math.sin(i / strength) * (i / strength) + i / strength+1) * (strength*2));
		}
		return data;
		}
		</script>
		</x-Layout>
