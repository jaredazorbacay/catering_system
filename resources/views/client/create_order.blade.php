@extends('layouts.app')

@section('title','Create Order')

@section('content')

<style>

.card{
border:none;
border-radius:14px;
box-shadow:0 8px 25px rgba(0,0,0,0.06);
}

.header-title{
font-weight:600;
color:#0a7f8a;
}

.form-control{
border-radius:8px;
}

.create-btn{
background:#0a7f8a;
border:none;
color:white;
font-weight:500;
}

.create-btn:hover{
background:#086a73;
}

.cart-card{
border:none;
border-radius:10px;
box-shadow:0 6px 18px rgba(0,0,0,0.05);
}

.cart-img{
height:70px;
width:100%;
object-fit:cover;
border-radius:6px;
}

.remove-btn{
position:absolute;
top:5px;
right:5px;
padding:4px 6px;
}

</style>


<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="card p-4">

<h4 class="header-title mb-4">
Create Catering Order
</h4>


@if ($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach ($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif



{{-- CART ACTIONS (SEPARATE FORMS) --}}

<div class="d-flex justify-content-between align-items-center mb-3">

<h5 class="header-title">
Selected Menu Items
</h5>

<div class="d-flex gap-2">

@if($cartItems->count())

<a href="/client/cart" class="btn btn-primary btn-sm">
Add More Items
</a>

<form method="POST" action="/client/cart/clear">
@csrf
<button class="btn btn-danger btn-sm">
Clear All
</button>
</form>

@endif

</div>

</div>



@if($cartItems->count())

<div class="row">

@foreach($cartItems as $cart)

<div class="col-md-3 mb-3">

<div class="card cart-card p-2 position-relative">


<form method="POST"
action="/client/cart/remove/{{$cart->id}}">

@csrf

<button class="btn btn-danger btn-sm remove-btn">
✖
</button>

</form>


<img src="{{$cart->item->photo_url}}"
class="cart-img">


<div class="mt-2 small">

<strong>{{$cart->item->name}}</strong>

<br>

Qty: {{$cart->quantity}}

<br>

₱{{$cart->item->price * $cart->quantity}}

</div>

</div>

</div>

@endforeach

</div>


<hr>

<h4 class="text-end">
Total: ₱{{$total}}
</h4>

@else

<p class="text-muted">
No items in cart
</p>

<a href="/client/cart" class="btn btn-primary">
Add to Cart
</a>

@endif



{{-- ORDER FORM (COMPLETELY SEPARATE) --}}

@if($cartItems->count())

<form method="POST" action="/client/order/store">

@csrf


<div class="row mt-4">

<div class="col-md-6">

<label class="form-label">Event Name</label>

<input
type="text"
name="event_name"
class="form-control"
required
>

</div>

<div class="col-md-3">

<label class="form-label">Event Date</label>

<input
type="date"
name="event_date"
class="form-control"
required
>

</div>

<div class="col-md-3">

<label class="form-label">Guests</label>

<input
type="number"
name="guest_count"
class="form-control"
required
>

</div>

</div>


<div class="mt-3">

<label class="form-label">Event Location</label>

<input
type="text"
name="event_location"
class="form-control"
required
>

</div>


<div class="mt-4 text-end">

<button class="btn create-btn px-4 py-2">
Submit Order
</button>

</div>


</form>

@endif


</div>

</div>

</div>

</div>

@endsection