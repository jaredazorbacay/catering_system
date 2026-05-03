@extends('layouts.app')

@section('title', 'Admin Orders')

@section('content')

<style>
body{ background:#f6f8f9; }

.orders-card{
border:none;
border-radius:14px;
box-shadow:0 6px 18px rgba(0,0,0,0.05);
background:white;
}

.page-title{
font-weight:700;
color:#2c3e50;
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
<th>Total</th>
<th>Payment</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($orders as $order)

@php
$total = $order->items->sum(fn($i)=>$i->price*$i->quantity);

$discount = $order->discount ?? 0;
$discountedTotal = $total - ($total * $discount);

$paid = $order->payment ?? 0;
$balance = $discountedTotal - $paid;
@endphp

<tr class="order-row" data-bs-toggle="modal" data-bs-target="#orderModal{{$order->id}}">

<td>{{ $order->user->name }}</td>
<td>{{ $order->user->phone_number }}</td>
<td>{{ $order->event_name }}</td>
<td>{{ \Carbon\Carbon::parse($order->event_date)->format('M d, Y') }}</td>
<td>{{ $order->event_location }}</td>
<td>{{ $order->guest_count }}</td>

<td>₱{{ number_format($total,2) }}</td>

<td>
@if($paid <= 0)
<span class="badge bg-danger">Unpaid</span>
@elseif($balance > 0)
<span class="badge bg-warning text-dark">Partial</span>
@else
<span class="badge bg-success">Paid</span>
@endif
</td>

<td>
@if($order->status == 'pending')
<span class="badge bg-warning text-dark">Pending</span>
@elseif($order->status == 'approved')
<span class="badge bg-success">Approved</span>
@elseif($order->status == 'cancelled')
<span class="badge bg-danger">Cancelled</span>
@else
<span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
@endif
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>


{{-- MODALS --}}
@foreach($orders as $order)

@php
$total = $order->items->sum(fn($i)=>$i->price*$i->quantity);

$discount = $order->discount ?? 0;
$discountedTotal = $total - ($total * $discount);

$paid = $order->payment ?? 0;
$balance = $discountedTotal - $paid;
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
<div class="col-md-6">
<strong>Client:</strong><br>{{ $order->user->name }}
</div>
<div class="col-md-6">
<strong>Phone:</strong><br>{{ $order->user->phone_number }}
</div>
</div>

<div class="row mb-3">
<div class="col-md-6">
<strong>Event:</strong><br>{{ $order->event_name }}
</div>
<div class="col-md-6">
<strong>Date:</strong><br>{{ \Carbon\Carbon::parse($order->event_date)->format('M d, Y') }}
</div>
</div>

<div class="row mb-3">
<div class="col-md-6">
<strong>Location:</strong><br>{{ $order->event_location }}
</div>
<div class="col-md-6">
<strong>Guests:</strong><br>{{ $order->guest_count }}
</div>
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

{{-- ✅ TOTAL WITH DISCOUNT --}}
<h5 class="text-end">

@if($discount > 0)

<span style="text-decoration:line-through; color:#999;">
₱{{ number_format($total,2) }}
</span>

<br>

<span style="color:#0a7f8a; font-weight:700;">
₱{{ number_format($discountedTotal,2) }}
</span>

<div class="text-success small">
Discount Applied ({{ $discount * 100 }}%)
</div>

@else

₱{{ number_format($total,2) }}

@endif

</h5>


{{-- ✅ APPLY DISCOUNT BUTTON --}}
@if($discount == 0 && !in_array($order->status,['cancelled']))

<form method="POST" action="/admin/orders/{{$order->id}}/discount">
@csrf
<button class="btn btn-warning w-100 mb-3">
Apply Senior/PWD Discount (20%)
</button>
</form>

@endif


<hr>

{{-- PAYMENT --}}
<h6>Payment</h6>

<p>Paid: ₱{{ number_format($paid,2) }}</p>
<p>Balance: ₱{{ number_format($balance,2) }}</p>

@if($paid <= 0)

<span class="badge bg-danger">Unpaid</span>

@elseif($paid < $discountedTotal)

<span class="badge bg-warning text-dark">Partial</span>

@else

<span class="badge bg-success">Paid</span>

@endif

<hr>

{{-- PAYMENT CONTROLS --}}
@if(!in_array($order->status, ['pending','cancelled']))

<form method="POST" action="/admin/orders/{{$order->id}}/payment">
@csrf

<input type="number"
name="payment"
step="0.01"
class="form-control mb-2"
value="{{ $paid }}">

<button class="btn btn-primary w-100 mb-2">
Update Payment
</button>

</form>

<form method="POST" action="/admin/orders/{{$order->id}}/payment">
@csrf
<input type="hidden" name="payment" value="{{ $discountedTotal }}">

<button class="btn btn-success w-100">
Complete Payment
</button>

</form>

@else

<div class="alert alert-warning text-center">
Payment can only be updated after approval
</div>

@endif

</div>

{{-- APPROVE / CANCEL --}}
<div class="modal-footer d-flex justify-content-between">

@if($order->status == 'pending')

<div class="d-flex gap-2">

<form method="POST" action="/admin/orders/{{$order->id}}/approve">
@csrf
<button class="btn btn-success">
Approve Order
</button>
</form>

<form method="POST" action="/admin/orders/{{ $order->id }}/cancel">
@csrf

<textarea name="message"
class="form-control mb-2"
placeholder="Reason for cancellation..."
required></textarea>

<button class="btn btn-danger w-100">
Cancel Order
</button>

</form>

</div>

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