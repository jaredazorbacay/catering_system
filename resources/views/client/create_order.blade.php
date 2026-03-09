@extends('layouts.app')

@section('title','Create Order')

@section('content')

<style>

/* PAGE BACKGROUND */

body{
background:#f6f8f9;
}

/* CARD */

.card{
border:none;
border-radius:14px;
box-shadow:0 6px 18px rgba(0,0,0,0.05);
background:white;
}

/* HEADER */

.header-title{
font-weight:700;
color:#2c3e50;
}

/* SECTION TITLES */

.section-title{
font-weight:600;
font-size:15px;
padding:8px 12px;
border-radius:8px;
margin-bottom:10px;
}

/* CATEGORY COLORS */

.food-title{
background:#e8f6f7;
color:#0a7f8a;
}

.drink-title{
background:#f1fbfc;
color:#0a7f8a;
}

.dessert-title{
background:#f5f7ff;
color:#5a6abf;
}

/* MENU LIST */

.menu-box{
max-height:300px;
overflow-y:auto;
padding-right:5px;
}

/* MENU ITEM */

.menu-item{
padding:8px;
border-radius:8px;
display:flex;
justify-content:space-between;
align-items:center;
transition:0.2s;
font-size:14px;
}

.menu-item:hover{
background:#f1f7f8;
}

.menu-item input{
margin-right:8px;
}

/* PRICE */

.menu-price{
font-size:13px;
color:#888;
}

/* BUTTON */

.create-btn{
background:#0a7f8a;
border:none;
color:white;
font-weight:500;
border-radius:8px;
}

.create-btn:hover{
background:#086a73;
}

/* INPUTS */

.form-control{
border-radius:8px;
}

</style>


<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="card p-4">

<h4 class="header-title mb-4">Create Catering Order</h4>


{{-- VALIDATION ERRORS --}}

@if ($errors->any())

<div class="alert alert-danger">

<strong>Please fix the following errors:</strong>

<ul class="mb-0">

@foreach ($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif


<form method="POST" action="/client/order/store">

@csrf


<div class="row mb-3">

<div class="col-md-6">

<label class="form-label">Event Name</label>

<input
type="text"
name="event_name"
class="form-control"
value="{{ old('event_name') }}"
required
>

</div>


<div class="col-md-3">

<label class="form-label">Event Date</label>

<input
type="date"
name="event_date"
class="form-control"
value="{{ old('event_date') }}"
required
>

</div>


<div class="col-md-3">

<label class="form-label">Guests</label>

<input
type="number"
name="guest_count"
class="form-control"
value="{{ old('guest_count') }}"
required
>

</div>

</div>


<div class="mb-4">

<label class="form-label">Event Location</label>

<input
type="text"
name="event_location"
class="form-control"
value="{{ old('event_location') }}"
required
>

</div>



<div class="row">

<!-- FOOD -->

<div class="col-md-4">

<div class="section-title food-title">
Food
</div>

<div class="menu-box">

@foreach($foods as $item)

<label class="menu-item">

<div>

<input
type="checkbox"
name="items[]"
value="{{$item->id}}"
{{ in_array($item->id, old('items', [])) ? 'checked' : '' }}
>

{{$item->name}}

</div>

<span class="menu-price">₱{{$item->price}}</span>

</label>

@endforeach

</div>

</div>


<!-- DRINKS -->

<div class="col-md-4">

<div class="section-title drink-title">
Drinks
</div>

<div class="menu-box">

@foreach($drinks as $item)

<label class="menu-item">

<div>

<input
type="checkbox"
name="items[]"
value="{{$item->id}}"
{{ in_array($item->id, old('items', [])) ? 'checked' : '' }}
>

{{$item->name}}

</div>

<span class="menu-price">₱{{$item->price}}</span>

</label>

@endforeach

</div>

</div>


<!-- DESSERTS -->

<div class="col-md-4">

<div class="section-title dessert-title">
Desserts
</div>

<div class="menu-box">

@foreach($desserts as $item)

<label class="menu-item">

<div>

<input
type="checkbox"
name="items[]"
value="{{$item->id}}"
{{ in_array($item->id, old('items', [])) ? 'checked' : '' }}
>

{{$item->name}}

</div>

<span class="menu-price">₱{{$item->price}}</span>

</label>

@endforeach

</div>

</div>


</div>


<div class="mt-4 text-end">

<button class="btn create-btn px-4 py-2">
Create Order
</button>

</div>

</form>

</div>

</div>

</div>

</div>

@endsection