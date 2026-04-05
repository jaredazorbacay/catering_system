@extends('layouts.app')

@section('title', 'Add to Cart')

@section('content')

<style>

.page-title{
font-weight:700;
color:#0a7f8a;
}

.section-title{
font-weight:600;
margin-bottom:15px;
color:#0a7f8a;
border-bottom:2px solid #e8f7f8;
padding-bottom:5px;
}

/* GRID LAYOUT */

.menu-grid{
display:grid;
grid-template-columns:repeat(auto-fill, minmax(220px,1fr));
gap:20px;
}

/* CARD */

.menu-card{
border:none;
border-radius:12px;
box-shadow:0 6px 18px rgba(0,0,0,0.06);
cursor:pointer;
overflow:hidden;
transition:0.2s;
background:white;
}

.menu-card:hover{
transform:translateY(-4px);
box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

/* IMAGE */

.menu-img-wrapper{
position:relative;
}

.menu-img{
height:170px;
width:100%;
object-fit:cover;
background:#f5f5f5;
}

/* SERVING BADGE */

.serving-badge{
position:absolute;
bottom:8px;
left:8px;
background:rgba(0,0,0,0.7);
color:white;
padding:4px 8px;
border-radius:6px;
font-size:11px;
}

/* BODY */

.menu-body{
padding:12px;
}

.menu-name{
font-weight:600;
color:#333;
font-size:14px;
}

.menu-price{
color:#0a7f8a;
font-weight:600;
font-size:13px;
}

/* FLOATING CART */

.cart-summary{
position:fixed;
right:20px;
bottom:20px;
width:260px;
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 8px 25px rgba(0,0,0,0.15);
z-index:999;
}

.add-btn{
background:#0a7f8a;
border:none;
color:white;
font-weight:500;
padding:10px;
border-radius:8px;
}

.add-btn:hover{
background:#086a73;
}

</style>


<div class="container pb-5">

<h3 class="page-title mb-4">
Select Menu Items
</h3>


{{-- FOOD --}}
<div class="mb-5">

<div class="section-title">Food</div>

<div class="menu-grid">

@foreach($foods as $item)

<div class="menu-card"
data-bs-toggle="modal"
data-bs-target="#itemModal{{$item->id}}">

<div class="menu-img-wrapper">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="serving-badge">
👥 Good for {{$item->serving}}
</div>

</div>

<div class="menu-body">

<div class="menu-name">{{$item->name}}</div>

<div class="menu-price">
₱{{$item->price}}
</div>

</div>

</div>

@endforeach

</div>

</div>


{{-- DRINKS --}}
<div class="mb-5">

<div class="section-title">Drinks</div>

<div class="menu-grid">

@foreach($drinks as $item)

<div class="menu-card"
data-bs-toggle="modal"
data-bs-target="#itemModal{{$item->id}}">

<div class="menu-img-wrapper">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="serving-badge">
👥 Good for {{$item->serving}}
</div>

</div>

<div class="menu-body">

<div class="menu-name">{{$item->name}}</div>

<div class="menu-price">
₱{{$item->price}}
</div>

</div>

</div>

@endforeach

</div>

</div>


{{-- DESSERTS --}}
<div class="mb-5">

<div class="section-title">Desserts</div>

<div class="menu-grid">

@foreach($desserts as $item)

<div class="menu-card"
data-bs-toggle="modal"
data-bs-target="#itemModal{{$item->id}}">

<div class="menu-img-wrapper">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="serving-badge">
👥 Good for {{$item->serving}}
</div>

</div>

<div class="menu-body">

<div class="menu-name">{{$item->name}}</div>

<div class="menu-price">
₱{{$item->price}}
</div>

</div>

</div>

@endforeach

</div>

</div>


</div>


{{-- FLOATING CART --}}
<div class="cart-summary">

<h6 class="mb-3">Cart Summary</h6>

@if($cartItems->count())

@foreach($cartItems as $cart)

<div class="d-flex justify-content-between small mb-2">
<span>{{$cart->item->name}} x {{$cart->quantity}}</span>
<span>₱{{$cart->item->price * $cart->quantity}}</span>
</div>

@endforeach

<hr>

<h5 class="text-end">
Total: ₱{{$total}}
</h5>

<a href="/client/order/create" class="btn btn-success w-100 mt-2">
Proceed to Order
</a>

<form method="POST" action="/client/cart/clear">
@csrf
<button class="btn btn-danger w-100 mt-2">
Clear Cart
</button>
</form>

@else

<p class="text-muted small">Cart is empty</p>

@endif

</div>


{{-- MODALS --}}
@foreach($foods->merge($drinks)->merge($desserts) as $item)

<div class="modal fade" id="itemModal{{$item->id}}" tabindex="-1">

<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">{{$item->name}}</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body text-center">

<img src="{{$item->photo_url}}"
style="width:100%; max-height:500px; object-fit:cover; border-radius:10px; margin-bottom:15px;">

<p class="text-muted">{{$item->description}}</p>

<h5 style="color:#0a7f8a">
₱{{$item->price}}
</h5>

<p class="text-muted small">
👥 Good for {{$item->serving}} people
</p>

<form method="POST" action="/client/cart/add">
@csrf

<input type="hidden" name="item_id" value="{{$item->id}}">

<div class="d-flex justify-content-center align-items-center mb-3">

<button type="button" class="btn btn-outline-secondary"
onclick="decreaseQty({{$item->id}})">-</button>

<input type="number"
name="quantity"
id="qty{{$item->id}}"
value="1"
min="1"
class="form-control text-center mx-2"
style="width:80px">

<button type="button" class="btn btn-outline-secondary"
onclick="increaseQty({{$item->id}})">+</button>

</div>

<button class="btn add-btn w-100">
Add to Cart
</button>

</form>

</div>

</div>
</div>

</div>

@endforeach


<script>

function increaseQty(id){
let qty = document.getElementById('qty'+id);
qty.value = parseInt(qty.value) + 1;
}

function decreaseQty(id){
let qty = document.getElementById('qty'+id);
if(qty.value > 1){
qty.value = parseInt(qty.value) - 1;
}
}

</script>

@endsection