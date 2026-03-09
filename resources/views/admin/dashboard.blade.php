@extends('layouts.app')

@section('title','Admin Dashboard')

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

/* SECTION TITLE */

.section-title{
font-weight:600;
margin-bottom:15px;
color:#2c3e50;
}

/* PRIMARY BUTTON */

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

/* TABLE ROW */

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

/* MENU LIST */

.list-group-item{
border:none;
border-bottom:1px solid #f1f1f1;
}

</style>


<div class="container py-4">

<h3 class="mb-4" style="font-weight:700;color:#2c3e50;">
Admin Dashboard
</h3>


@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif


{{-- QUICK ACTIONS --}}

<div class="card dashboard-card p-4 mb-4">

<h5 class="section-title">Quick Actions</h5>

<div class="d-flex flex-wrap gap-2">

<a href="/admin/orders" class="btn quick-btn">
View Orders
</a>

<a href="/admin/analytics" class="btn btn-outline-secondary">
View Analytics
</a>

</div>

</div>



{{-- UPCOMING EVENTS --}}

<div class="card dashboard-card p-4 mb-4">

<h5 class="section-title">Upcoming Events</h5>

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>

<tr>
<th>Client</th>
<th>Phone</th>
<th>Event</th>
<th>Date</th>
<th>Guests</th>
</tr>

</thead>

<tbody>

@if($upcomingEvents->count())

@foreach($upcomingEvents as $event)

<tr class="order-row" data-bs-toggle="modal" data-bs-target="#orderModal{{ $event->id }}">

<td>{{ $event->user->name }}</td>
<td>{{ $event->user->phone_number }}</td>
<td>{{ $event->event_name }}</td>
<td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
<td>{{ $event->guest_count }}</td>

</tr>

@endforeach

@else

<tr>
<td colspan="5" class="text-center text-muted">
No upcoming events
</td>
</tr>

@endif

</tbody>

</table>

</div>

</div>



{{-- EVENT HISTORY --}}

<div class="card dashboard-card p-4">

<h5 class="section-title">Event History</h5>

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>

<tr>
<th>Client</th>
<th>Phone</th>
<th>Event</th>
<th>Date</th>
<th>Status</th>
</tr>

</thead>

<tbody>

@if($pastEvents->count())

@foreach($pastEvents as $event)

<tr class="order-row" data-bs-toggle="modal" data-bs-target="#orderModal{{ $event->id }}">

<td>{{ $event->user->name }}</td>
<td>{{ $event->user->phone_number }}</td>
<td>{{ $event->event_name }}</td>
<td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>

<td>
<span class="badge bg-success">Finished</span>
</td>

</tr>

@endforeach

@else

<tr>
<td colspan="5" class="text-center text-muted">
No past events
</td>
</tr>

@endif

</tbody>

</table>

</div>

</div>

</div>



{{-- ORDER DETAIL MODALS --}}

@foreach($upcomingEvents->merge($pastEvents)->unique('id') as $order)

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

<strong>Client:</strong><br>
{{ $order->user->name }}

</div>

<div class="col-md-6">

<strong>Phone Number:</strong><br>
{{ $order->user->phone_number }}

</div>

</div>


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


<div class="row mb-3">

<div class="col-md-6">

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

</div>


<hr>


<h6 class="mb-3">Menu Items</h6>

@if($order->items->count())

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

@if($order->status == 'pending')

<form method="POST" action="/admin/orders/{{ $order->id }}/approve">
@csrf
<button class="btn btn-success">Approve Order</button>
</form>

<form method="POST" action="/admin/orders/{{ $order->id }}/cancel">
@csrf
<button class="btn btn-danger">Cancel Order</button>
</form>

@endif

<button class="btn btn-secondary" data-bs-dismiss="modal">
Close
</button>

</div>

</div>

</div>

</div>

@endforeach


@endsection