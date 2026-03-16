@extends('layouts.app')

@section('title','Add to Cart')

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

/* SCROLLABLE MENU COLUMN */

.menu-column{
height:70vh;
overflow-y:auto;
padding-right:5px;
}

/* EXTRA SPACE FOR DESSERT COLUMN */

.dessert-column{
padding-bottom:33vh;
}

/* SCROLLBAR */

.menu-column::-webkit-scrollbar{
width:6px;
}

.menu-column::-webkit-scrollbar-thumb{
background:#d9e8ea;
border-radius:10px;
}

/* MENU CARD */

.menu-card{
border:none;
border-radius:12px;
box-shadow:0 6px 18px rgba(0,0,0,0.06);
transition:0.2s;
cursor:pointer;
overflow:hidden;
}

.menu-card:hover{
transform:translateY(-3px);
box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

.menu-img{
height:150px;
width:100%;
object-fit:cover;
background:#f5f5f5;
}

.menu-img-modal{
height:150px;
width:100%;
object-fit:cover;
background:#f5f5f5;
}

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

.menu-desc{
font-size:12px;
color:#777;
margin-top:4px;
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

.qty-btn{
background:#0a7f8a;
border:none;
color:white;
width:35px;
height:35px;
border-radius:6px;
}

.qty-btn:hover{
background:#086a73;
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


<div class="container py-4">

<h3 class="page-title mb-4">
Select Menu Items
</h3>

<div class="row">


{{-- FOOD COLUMN --}}

<div class="col-lg-4">

<div class="section-title">
Food
</div>

<div class="menu-column">

@foreach($foods as $item)

<div class="card menu-card mb-3"
data-bs-toggle="modal"
data-bs-target="#itemModal{{$item->id}}">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="menu-body">

<div class="menu-name">
{{$item->name}}
</div>

<div class="menu-price">
₱{{$item->price}}
</div>

<div class="menu-desc">
{{ Str::limit($item->description,60) }}
</div>

</div>

</div>

@endforeach

</div>

</div>



{{-- DRINKS COLUMN --}}

<div class="col-lg-4">

<div class="section-title">
Drinks
</div>

<div class="menu-column">

@foreach($drinks as $item)

<div class="card menu-card mb-3"
data-bs-toggle="modal"
data-bs-target="#itemModal{{$item->id}}">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="menu-body">

<div class="menu-name">
{{$item->name}}
</div>

<div class="menu-price">
₱{{$item->price}}
</div>

<div class="menu-desc">
{{ Str::limit($item->description,60) }}
</div>

</div>

</div>

@endforeach

</div>

</div>



{{-- DESSERTS COLUMN --}}

<div class="col-lg-4">

<div class="section-title">
Desserts
</div>

<div class="menu-column dessert-column">

@foreach($desserts as $item)

<div class="card menu-card mb-3"
data-bs-toggle="modal"
data-bs-target="#itemModal{{$item->id}}">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="menu-body">

<div class="menu-name">
{{$item->name}}
</div>

<div class="menu-price">
₱{{$item->price}}
</div>

<div class="menu-desc">
{{ Str::limit($item->description,60) }}
</div>

</div>

</div>

@endforeach

</div>

</div>


</div>



{{-- FLOATING CART SUMMARY --}}

<div class="cart-summary">

<h6 class="mb-3">Cart Summary</h6>

@if($cartItems->count())

@foreach($cartItems as $cart)

<div class="d-flex justify-content-between small mb-2">

<span>
{{$cart->item->name}} x {{$cart->quantity}}
</span>

<span>
₱{{$cart->item->price * $cart->quantity}}
</span>

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



{{-- ITEM MODALS --}}

@foreach($foods->merge($drinks)->merge($desserts) as $item)

<div class="modal fade" id="itemModal{{$item->id}}" tabindex="-1">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
{{$item->name}}
</h5>

<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

</div>


<div class="modal-body text-center">

<img src="{{$item->photo_url}}"
style="width:100%; max-height:500px; object-fit:cover; border-radius:10px; margin-bottom:15px;">

<p class="text-muted">
{{$item->description}}
</p>

<h5 style="color:#0a7f8a">
₱{{$item->price}}
</h5>


<form method="POST" action="/client/cart/add">

@csrf

<input type="hidden" name="item_id" value="{{$item->id}}">

<div class="d-flex justify-content-center align-items-center mb-3">

<button type="button"
class="btn btn-outline-secondary"
onclick="decreaseQty({{$item->id}})">
-
</button>

<input
type="number"
name="quantity"
id="qty{{$item->id}}"
value="1"
min="1"
class="form-control text-center mx-2"
style="width:80px"
>

<button type="button"
class="btn btn-outline-secondary"
onclick="increaseQty({{$item->id}})">
+
</button>

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