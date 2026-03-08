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
    color:#444;
}

.section-title{
    font-weight:600;
    font-size:15px;
    padding:8px 12px;
    border-radius:8px;
    margin-bottom:10px;
}

.food-title{
    background:#ffe8e8;
    color:#b44;
}

.drink-title{
    background:#e8f7ff;
    color:#2a6f9b;
}

.dessert-title{
    background:#fff4e6;
    color:#c77d00;
}

.menu-box{
    max-height:300px;
    overflow-y:auto;
    padding-right:5px;
}

.menu-item{
    padding:6px 4px;
    border-radius:6px;
    transition:0.2s;
}

.menu-item:hover{
    background:#f7f7f7;
}

.menu-price{
    font-size:13px;
    color:#888;
}

.create-btn{
    background:#038cfc;
    border:none;
    color:white;
    font-weight:500;
}

.create-btn:hover{
    background:#0277d9;
}

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

<div class="menu-item">

<input
type="checkbox"
name="items[]"
value="{{$item->id}}"
{{ in_array($item->id, old('items', [])) ? 'checked' : '' }}
>

{{$item->name}}

<span class="menu-price">₱{{$item->price}}</span>

</div>

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

<div class="menu-item">

<input
type="checkbox"
name="items[]"
value="{{$item->id}}"
{{ in_array($item->id, old('items', [])) ? 'checked' : '' }}
>

{{$item->name}}

<span class="menu-price">₱{{$item->price}}</span>

</div>

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

<div class="menu-item">

<input
type="checkbox"
name="items[]"
value="{{$item->id}}"
{{ in_array($item->id, old('items', [])) ? 'checked' : '' }}
>

{{$item->name}}

<span class="menu-price">₱{{$item->price}}</span>

</div>

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