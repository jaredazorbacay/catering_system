@extends('layouts.app')

@section('title','Admin Analytics')

@section('content')

<style>

.analytics-container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(420px,1fr));
gap:25px;
}

.analytics-card{
border:none;
border-radius:16px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
padding:25px;
background:white;
height:100%;
display:flex;
flex-direction:column;
}

.section-title{
font-weight:600;
margin-bottom:20px;
}

.chart-container{
flex:1;
position:relative;
min-height:280px;
}

.clients-list{
flex:1;
display:flex;
flex-direction:column;
justify-content:center;
}

</style>


<div class="container py-4">

<h2 class="mb-4">Analytics Dashboard</h2>

<div class="analytics-container">

{{-- Orders Over Time --}}
<div class="analytics-card">

<h5 class="section-title">Orders Over Time</h5>

<div class="chart-container">
<canvas id="ordersChart"></canvas>
</div>

</div>


{{-- Status Distribution --}}
<div class="analytics-card">

<h5 class="section-title">Order Status Distribution</h5>

<div class="chart-container">
<canvas id="statusChart"></canvas>
</div>

</div>


{{-- Popular Items --}}
<div class="analytics-card">

<h5 class="section-title">Most Popular Menu Items</h5>

<div class="chart-container">
<canvas id="itemsChart"></canvas>
</div>

</div>


{{-- Most Active Clients --}}
<div class="analytics-card">

<h5 class="section-title">Most Active Clients</h5>

<div class="clients-list">

<ul class="list-group">

@foreach($topClients as $client)

<li class="list-group-item d-flex justify-content-between">

{{ $client->user->name }}

<span>{{ $client->total }} orders</span>

</li>

@endforeach

</ul>

</div>

</div>


</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('ordersChart'),{
type:'line',
data:{
labels:{!! json_encode($ordersChartLabels) !!},
datasets:[{
label:'Orders',
data:{!! json_encode($ordersChartData) !!},
borderColor:'#038cfc',
backgroundColor:'rgba(3,140,252,0.15)',
tension:0.4,
fill:true
}]
},
options:{
responsive:true,
maintainAspectRatio:false
}
});


new Chart(document.getElementById('statusChart'),{
type:'doughnut',
data:{
labels:{!! json_encode($statusLabels) !!},
datasets:[{
data:{!! json_encode($statusData) !!},
backgroundColor:['#ffc107','#28a745','#dc3545']
}]
},
options:{
responsive:true,
maintainAspectRatio:false
}
});


new Chart(document.getElementById('itemsChart'),{
type:'bar',
data:{
labels:{!! json_encode($itemLabels) !!},
datasets:[{
label:'Orders',
data:{!! json_encode($itemData) !!},
backgroundColor:'#038cfc'
}]
},
options:{
responsive:true,
maintainAspectRatio:false
}
});

</script>

@endsection