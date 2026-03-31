@extends('layouts.app')

@section('title','Welcome')

@section('content')

<style>

main.container{
max-width:100% !important;
padding:0 !important;
margin:0 !important;
}

/* HERO */

.landing-hero{
background:linear-gradient(135deg,#0a7f8a,#5bb6be);
color:white;
padding:60px;
min-height:calc(100vh - 110px);
}

/* TEXT */

.logo-img{
width:260px;
margin-bottom:20px;
}

.hero-title{
font-size:38px;
font-weight:700;
}

.hero-text{
margin-top:15px;
opacity:.9;
max-width:650px;
}

/* MENU */

.menu-section{
margin-top:40px;
}

.menu-section h5{
font-weight:600;
margin-bottom:15px;
}

/* SCROLL */

.menu-scroll{
display:flex;
gap:16px;
overflow-x:auto;
padding-bottom:10px;
}

/* CARD */

.menu-item{
min-width:200px;
background:rgba(255,255,255,0.15);
border-radius:14px;
overflow:hidden;
backdrop-filter:blur(6px);
transition:0.2s;
}

.menu-item:hover{
transform:translateY(-4px);
}

/* IMAGE */

.menu-img-wrapper{
position:relative;
}

.menu-item img{
width:100%;
height:140px; /* bigger */
object-fit:cover;
}

/* SERVING BADGE */

.serving-badge{
position:absolute;
bottom:8px;
left:8px;
background:rgba(0,0,0,0.7);
color:white;
font-size:11px;
padding:4px 8px;
border-radius:6px;
}

/* BODY */

.menu-body{
padding:10px;
text-align:center;
}

.menu-name{
font-size:14px;
font-weight:600;
}

.menu-price{
font-size:13px;
opacity:.9;
}

</style>


<div class="landing-hero">

<img src="{{ asset('images/logo.png') }}" class="logo-img">

<h1 class="hero-title">
Welcome to Zaylee's Bistro
</h1>

<p class="hero-text">
Experience seamless catering and event management with
<strong>Zaylee's Bistro by D' Lake</strong>.
</p>


{{-- FOOD --}}
<div class="menu-section">

<h5>Food</h5>

<div class="menu-scroll">

@foreach($foods as $item)

<div class="menu-item">

<div class="menu-img-wrapper">

<img src="{{ $item->photo_url }}"
onerror="this.src='{{ asset('images/default-food.jpg') }}'">

<div class="serving-badge">
Good for {{ $item->serving }}
</div>

</div>

<div class="menu-body">

<div class="menu-name">
{{ $item->name }}
</div>

<div class="menu-price">
₱{{ number_format($item->price,2) }}
</div>

</div>

</div>

@endforeach

</div>

</div>


{{-- DRINKS --}}
<div class="menu-section">

<h5>Drinks</h5>

<div class="menu-scroll">

@foreach($drinks as $item)

<div class="menu-item">

<div class="menu-img-wrapper">

<img src="{{ $item->photo_url }}"
onerror="this.src='{{ asset('images/default-food.jpg') }}'">

<div class="serving-badge">
Good for {{ $item->serving }}
</div>

</div>

<div class="menu-body">

<div class="menu-name">
{{ $item->name }}
</div>

<div class="menu-price">
₱{{ number_format($item->price,2) }}
</div>

</div>

</div>

@endforeach

</div>

</div>


{{-- DESSERTS --}}
<div class="menu-section">

<h5>Desserts</h5>

<div class="menu-scroll">

@foreach($desserts as $item)

<div class="menu-item">

<div class="menu-img-wrapper">

<img src="{{ $item->photo_url }}"
onerror="this.src='{{ asset('images/default-food.jpg') }}'">

<div class="serving-badge">
Good for {{ $item->serving }}
</div>

</div>

<div class="menu-body">

<div class="menu-name">
{{ $item->name }}
</div>

<div class="menu-price">
₱{{ number_format($item->price,2) }}
</div>

</div>

</div>

@endforeach

</div>

</div>


</div>

@endsection