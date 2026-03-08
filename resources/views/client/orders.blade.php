@extends('layouts.app')

@section('title','My Orders')

@section('content')

<style>

.orders-card{
    border:none;
    border-radius:14px;
    box-shadow:0 8px 25px rgba(0,0,0,0.06);
}

.page-title{
    font-weight:600;
}

.create-btn{
    background:#038cfc;
    border:none;
    color:white;
}

.create-btn:hover{
    background:#0277d9;
}

.order-row{
    cursor:pointer;
}

</style>


<div class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<h4 class="page-title">My Orders</h4>

<a href="/client/order/create" class="btn create-btn">
Create Order
</a>

</div>


<div class="card orders-card p-4">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>

<tr>
<th>Event</th>
<th>Date</th>
<th>Location</th>
<th>Guests</th>
<th>Status</th>
</tr>

</thead>

<tbody>

@if(count($orders) > 0)

@foreach($orders as $order)

<tr class="order-row" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">

<td>{{ $order->event_name }}</td>

<td>{{ $order->event_date }}</td>

<td>{{ $order->event_location }}</td>

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

@elseif($order->status == 'rejected')

<span class="badge bg-danger">
Rejected
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

<td colspan="5" class="text-center text-muted">

You have no orders yet.

</td>

</tr>

@endif

</tbody>

</table>

</div>

</div>

</div>


{{-- ORDER MODALS --}}

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

<strong>Event:</strong><br>
{{ $order->event_name }}

</div>

<div class="col-md-6">

<strong>Date:</strong><br>
{{ $order->event_date }}

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

<span class="badge bg-warning text-dark">
Pending
</span>

@elseif($order->status == 'approved')

<span class="badge bg-success">
Approved
</span>

@elseif($order->status == 'rejected')

<span class="badge bg-danger">
Rejected
</span>

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

<p class="text-muted">No items selected.</p>

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