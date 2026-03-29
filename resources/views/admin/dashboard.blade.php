@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<style>
body { background:#f6f8f9; }

.dashboard-card{
border:none;
border-radius:14px;
box-shadow:0 6px 18px rgba(0,0,0,0.05);
background:white;
}

.section-title{
font-weight:600;
margin-bottom:15px;
color:#2c3e50;
}

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

.order-row{
cursor:pointer;
transition:0.2s;
}

.order-row:hover{
background:#f1f7f8;
}

.badge.bg-success{ background:#0a7f8a !important; }
.badge.bg-warning{ background:#ffc107 !important; }
.badge.bg-danger{ background:#dc3545 !important; }

.modal-content{
border-radius:14px;
border:none;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

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
<a href="/admin/orders" class="btn quick-btn">View Orders</a>
<a href="/admin/analytics" class="btn btn-outline-secondary">View Analytics</a>
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
<th>Total</th>
</tr>
</thead>

<tbody>

@if($upcomingEvents->count())

@foreach($upcomingEvents as $event)

@php
$total = $event->items->sum(fn($i)=>$i->price*$i->quantity);
@endphp

<tr class="order-row" data-bs-toggle="modal" data-bs-target="#orderModal{{$event->id}}">
<td>{{ $event->user->name }}</td>
<td>{{ $event->user->phone_number }}</td>
<td>{{ $event->event_name }}</td>
<td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
<td>{{ $event->guest_count }}</td>
<td>₱{{ number_format($total,2) }}</td>
</tr>

@endforeach

@else

<tr>
<td colspan="6" class="text-center text-muted">No upcoming events</td>
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
<th>Total</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@if($pastEvents->count())

@foreach($pastEvents as $event)

@php
$total = $event->items->sum(fn($i)=>$i->price*$i->quantity);
@endphp

<tr class="order-row" data-bs-toggle="modal" data-bs-target="#orderModal{{$event->id}}">
<td>{{ $event->user->name }}</td>
<td>{{ $event->user->phone_number }}</td>
<td>{{ $event->event_name }}</td>
<td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
<td>₱{{ number_format($total,2) }}</td>
<td><span class="badge bg-success">Finished</span></td>
</tr>

@endforeach

@else

<tr>
<td colspan="6" class="text-center text-muted">No past events</td>
</tr>

@endif

</tbody>

</table>

</div>

</div>

</div>



{{-- MODALS --}}
@foreach($upcomingEvents->merge($pastEvents)->unique('id') as $order)

@php
$total = $order->items->sum(fn($i)=>$i->price*$i->quantity);
$paid = $order->payment ?? 0;
$balance = $total - $paid;
@endphp

<div class="modal fade" id="orderModal{{$order->id}}">

<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5>Order Details</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

{{-- DETAILS --}}
<div class="row mb-3">
<div class="col-md-6"><strong>Client:</strong><br>{{ $order->user->name }}</div>
<div class="col-md-6"><strong>Phone:</strong><br>{{ $order->user->phone_number }}</div>
</div>

<div class="row mb-3">
<div class="col-md-6"><strong>Event:</strong><br>{{ $order->event_name }}</div>
<div class="col-md-6"><strong>Date:</strong><br>{{ \Carbon\Carbon::parse($order->event_date)->format('M d, Y') }}</div>
</div>

<div class="row mb-3">
<div class="col-md-6"><strong>Location:</strong><br>{{ $order->event_location }}</div>
<div class="col-md-6"><strong>Guests:</strong><br>{{ $order->guest_count }}</div>
</div>

<hr>

<h6>Menu Items</h6>

<ul class="list-group mb-3">
@foreach($order->items as $item)
<li class="list-group-item d-flex justify-content-between">
<span>{{ $item->item->name }} (x{{ $item->quantity }})</span>
<span>₱{{ number_format($item->price * $item->quantity,2) }}</span>
</li>
@endforeach
</ul>

<h5 class="text-end">Total: ₱{{ number_format($total,2) }}</h5>

<hr>

{{-- PAYMENT --}}
<h6>Payment</h6>

<p>Paid: ₱{{ number_format($paid,2) }}</p>
<p>Balance: ₱{{ number_format($balance,2) }}</p>

@if($paid <= 0)
<span class="badge bg-danger">Unpaid</span>
@elseif($balance > 0)
<span class="badge bg-warning text-dark">Partial</span>
@else
<span class="badge bg-success">Paid</span>
@endif

<hr>

{{-- 🚫 BLOCK PAYMENT --}}
@if(!in_array($order->status,['pending','cancelled']))

<form method="POST" action="/admin/orders/{{$order->id}}/payment">
@csrf
<input type="number" name="payment" step="0.01" class="form-control mb-2" value="{{ $paid }}">
<button class="btn btn-primary w-100 mb-2">Update Payment</button>
</form>

<form method="POST" action="/admin/orders/{{$order->id}}/payment">
@csrf
<input type="hidden" name="payment" value="{{ $total }}">
<button class="btn btn-success w-100">Complete Payment</button>
</form>

@else

<div class="alert alert-warning text-center">
Payment can only be updated after approval
</div>

@endif

</div>


<div class="modal-footer d-flex justify-content-between">

@if($order->status == 'pending')

<div class="d-flex gap-2">

<form method="POST" action="/admin/orders/{{$order->id}}/approve">
@csrf
<button class="btn btn-success">Approve Order</button>
</form>

<form method="POST" action="/admin/orders/{{$order->id}}/cancel">
@csrf
<button class="btn btn-danger">Cancel Order</button>
</form>

</div>

@endif

<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

</div>

</div>
</div>

</div>

@endforeach

@endsection