@extends('layouts.app')

@section('title','Client Dashboard')

@section('content')

<style>

/* PAGE BACKGROUND */

body{
background:#f6f8f9;
}

/* DASHBOARD CARDS */

.dashboard-card{
border:none;
border-radius:14px;
box-shadow:0 6px 18px rgba(0,0,0,0.05);
background:white;
}

/* STAT CARDS */

.stat-card{
border:none;
border-radius:12px;
box-shadow:0 6px 18px rgba(0,0,0,0.05);
padding:20px;
background:white;
}

.stat-number{
font-size:28px;
font-weight:700;
color:#2c3e50;
}

/* BUTTON */

.quick-btn{
background:#0a7f8a;
border:none;
color:white;
padding:8px 16px;
border-radius:8px;
}

.quick-btn:hover{
background:#086a73;
}

/* TABLE */

.order-row{
cursor:pointer;
transition:0.2s;
}

.order-row:hover{
background:#f1f7f8;
}

/* BADGES */

.badge.bg-success{
background:#0a7f8a !important;
}

.badge.bg-warning{
background:#ffc107 !important;
}

.badge.bg-danger{
background:#dc3545 !important;
}

/* MODAL */

.modal-content{
border-radius:14px;
border:none;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.modal-header{
border-bottom:1px solid #f1f1f1;
}

.modal-footer{
border-top:1px solid #f1f1f1;
}

/* MENU ITEMS */

.list-group-item{
border:none;
border-bottom:1px solid #f1f1f1;
}

</style>


<script>
setTimeout(function(){
let alerts = document.querySelectorAll('.alert');
alerts.forEach(alert => alert.remove());
},3000);
</script>


<div class="container py-4">

<h3 class="mb-4" style="font-weight:700;color:#2c3e50;">
Client Dashboard
</h3>


@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif


{{-- STATISTICS --}}

<div class="row mb-4">

<div class="col-md-4 mb-3">

<div class="stat-card">

<div class="stat-number">
{{ $totalOrders ?? 0 }}
</div>

<div class="text-muted">
Total Orders
</div>

</div>

</div>


<div class="col-md-4 mb-3">

<div class="stat-card">

<div class="stat-number text-warning">
{{ $pendingOrders ?? 0 }}
</div>

<div class="text-muted">
Pending Orders
</div>

</div>

</div>


<div class="col-md-4 mb-3">

<div class="stat-card">

<div class="stat-number text-success">
{{ $approvedOrders ?? 0 }}
</div>

<div class="text-muted">
Approved Orders
</div>

</div>

</div>

</div>


{{-- QUICK ACTIONS --}}

<div class="card dashboard-card p-4 mb-4">

<h5 class="mb-3">Quick Actions</h5>

<div class="d-flex flex-wrap gap-2">

<a href="/client/order/create" class="btn quick-btn">
Create New Order
</a>

<a href="/client/orders" class="btn btn-outline-secondary">
View My Orders
</a>

</div>

</div>


{{-- RECENT ORDERS --}}

<div class="card dashboard-card p-4">

<h5 class="mb-3">Recent Orders</h5>

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>

<tr>
<th>Event</th>
<th>Date</th>
<th>Guests</th>
<th>Status</th>
</tr>

</thead>

<tbody>

@if(isset($recentOrders) && count($recentOrders) > 0)

@foreach($recentOrders as $order)

<tr class="order-row" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">

<td>{{ $order->event_name }}</td>

<td>{{ \Carbon\Carbon::parse($order->event_date)->format('M d, Y') }}</td>

<td>{{ $order->guest_count }}</td>

<td>

@if($order->status == 'pending')

<span class="badge bg-warning text-dark">
Pending
</span>

@elseif($order->status == 'approved')

<span class="badge bg-success">
Approved
</span>

@elseif($order->status == 'cancelled')

<span class="badge bg-danger">
Cancelled
</span>

@else

<span class="badge bg-secondary">
{{ ucfirst($order->status) }}
</span>

@endif

</td>

</tr>

@endforeach

@else

<tr>
<td colspan="4" class="text-center text-muted">
No orders yet
</td>
</tr>

@endif

</tbody>

</table>

</div>

</div>

</div>


{{-- ORDER DETAIL MODALS --}}

@foreach($recentOrders as $order)

<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1">

<div class="modal-dialog modal-lg modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
Order Details
</h5>

<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

</div>


<div class="modal-body">

<div class="row mb-3">

<div class="col-md-6">
<strong>Event:</strong><br>
{{ $order->event_name }}
</div>

<div class="col-md-6">
<strong>Date:</strong><br>
{{ \Carbon\Carbon::parse($order->event_date)->format('M d, Y') }}
</div>

</div>


<div class="row mb-3">

<div class="col-md-6">
<strong>Location:</strong><br>
{{ $order->event_location }}
</div>

<div class="col-md-6">
<strong>Guests:</strong><br>
{{ $order->guest_count }}
</div>

</div>


<div class="mb-3">

<strong>Status:</strong><br>

@if($order->status == 'pending')

<span class="badge bg-warning text-dark">Pending</span>

@elseif($order->status == 'approved')

<span class="badge bg-success">Approved</span>

@elseif($order->status == 'cancelled')

<span class="badge bg-danger">Cancelled</span>

@else

<span class="badge bg-secondary">
{{ ucfirst($order->status) }}
</span>

@endif

</div>


<hr>


<h6 class="mb-3">Menu Items</h6>

@if($order->items->count() > 0)

<ul class="list-group">

@foreach($order->items as $orderItem)

<li class="list-group-item d-flex justify-content-between">

<span>
{{ $orderItem->item->name }}
</span>

<span class="text-muted">
₱{{ $orderItem->price }}
</span>

</li>

@endforeach

</ul>

@else

<p class="text-muted">No menu items found.</p>

@endif


</div>


<div class="modal-footer">

<button class="btn btn-secondary" data-bs-dismiss="modal">
Close
</button>

</div>

</div>

</div>

</div>

@endforeach


@endsection