@extends('layouts.app')

@section('title','Admin Orders')

@section('content')

<style>

/* PAGE BACKGROUND */

body{
background:#f6f8f9;
}

/* CARD */

.orders-card{
border:none;
border-radius:14px;
box-shadow:0 6px 18px rgba(0,0,0,0.05);
background:white;
}

/* TITLE */

.page-title{
font-weight:700;
color:#2c3e50;
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

/* MENU ITEMS */

.list-group-item{
border:none;
border-bottom:1px solid #f1f1f1;
}

/* ACTION BUTTONS */

.btn-success{
background:#0a7f8a;
border:none;
}

.btn-success:hover{
background:#086a73;
}

</style>


<div class="container py-4">

<h4 class="page-title mb-4">All Orders</h4>


@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif


<div class="card orders-card p-4">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>

<tr>

<th>Client</th>
<th>Phone</th>
<th>Event</th>
<th>Date</th>
<th>Location</th>
<th>Guests</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($orders as $order)

<tr class="order-row" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">

<td>{{ $order->user->name }}</td>

<td>{{ $order->user->phone_number }}</td>

<td>{{ $order->event_name }}</td>

<td>{{ \Carbon\Carbon::parse($order->event_date)->format('M d, Y') }}</td>

<td>{{ $order->event_location }}</td>

<td>{{ $order->guest_count }}</td>

<td>

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

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>


{{-- ORDER DETAIL MODALS --}}

@foreach($orders as $order)

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


@if($order->status == 'pending')

<form method="POST" action="/admin/orders/{{ $order->id }}/approve">

@csrf

<button class="btn btn-success">
Approve Order
</button>

</form>


<form method="POST" action="/admin/orders/{{ $order->id }}/cancel">

@csrf

<button class="btn btn-danger">
Cancel Order
</button>

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