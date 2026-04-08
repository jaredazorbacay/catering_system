@extends('layouts.app')

@section('title','Manage Menu')

@section('content')

<style>

.page-title{
font-weight:700;
color:#2c3e50;
}

.section-title{
font-weight:600;
margin-bottom:15px;
color:#0a7f8a;
}

/* GRID */

.menu-grid{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
gap:20px;
}

/* CARD */

.menu-card{
border:none;
border-radius:12px;
box-shadow:0 6px 18px rgba(0,0,0,0.06);
cursor:pointer;
overflow:hidden;
background:white;
transition:.2s;
}

.menu-card:hover{
transform:translateY(-4px);
}

/* IMAGE */

.menu-img-wrapper{
position:relative;
}

.menu-img{
height:170px;
width:100%;
object-fit:cover;
}

/* BADGE */

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
text-align:center;
}

.menu-name{
font-weight:600;
}

.menu-price{
color:#0a7f8a;
font-weight:600;
}

</style>


<div class="container py-4">

<h4 class="page-title mb-4">Manage Menu</h4>


{{-- FOOD --}}
<div class="mb-5">

<h5 class="section-title">Food</h5>

<div class="menu-grid">

@foreach($foods as $item)

<div class="menu-card" data-bs-toggle="modal" data-bs-target="#editItem{{$item->id}}">

<div class="menu-img-wrapper">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="serving-badge">
👥 {{$item->serving}}
</div>

</div>

<div class="menu-body">

<div class="menu-name">{{$item->name}}</div>

<div class="menu-price">₱{{$item->price}}</div>

</div>

</div>

@endforeach

</div>

</div>


{{-- DRINKS --}}
<div class="mb-5">

<h5 class="section-title">Drinks</h5>

<div class="menu-grid">

@foreach($drinks as $item)

<div class="menu-card" data-bs-toggle="modal" data-bs-target="#editItem{{$item->id}}">

<div class="menu-img-wrapper">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="serving-badge">
👥 {{$item->serving}}
</div>

</div>

<div class="menu-body">

<div class="menu-name">{{$item->name}}</div>

<div class="menu-price">₱{{$item->price}}</div>

</div>

</div>

@endforeach

</div>

</div>


{{-- DESSERTS --}}
<div class="mb-5">

<h5 class="section-title">Desserts</h5>

<div class="menu-grid">

@foreach($desserts as $item)

<div class="menu-card" data-bs-toggle="modal" data-bs-target="#editItem{{$item->id}}">

<div class="menu-img-wrapper">

<img src="{{$item->photo_url}}" class="menu-img">

<div class="serving-badge">
👥 {{$item->serving}}
</div>

</div>

<div class="menu-body">

<div class="menu-name">{{$item->name}}</div>

<div class="menu-price">₱{{$item->price}}</div>

</div>

</div>

@endforeach

</div>

</div>


</div>


{{-- EDIT MODALS --}}
@foreach($foods->merge($drinks)->merge($desserts) as $item)

<div class="modal fade" id="editItem{{$item->id}}">

<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5>Edit {{$item->name}}</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<form method="POST" action="/admin/items/{{$item->id}}/update">
@csrf

<label>Price</label>
<input type="number" step="0.01" name="price"
class="form-control mb-2"
value="{{$item->price}}">

<label>Serving</label>
<input type="number" name="serving"
class="form-control mb-2"
value="{{$item->serving}}">

<label>Description</label>
<textarea name="description"
class="form-control mb-3">{{$item->description}}</textarea>

<button class="btn btn-success w-100">
Update Item
</button>

</form>

</div>

</div>
</div>

</div>

@endforeach

@endsection