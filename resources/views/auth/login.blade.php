@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
main.container{
max-width:100% !important;
padding:0 !important;
margin:0 !important;
}

.login-page{
min-height:calc(100vh - 110px);
display:flex;
flex-wrap:wrap;
}

/* LEFT SIDE */

.login-left{
background:linear-gradient(135deg,#0a7f8a,#5bb6be);
color:white;
display:flex;
flex-direction:column;
justify-content:center;
padding:60px;
overflow:hidden;
}

.logo-img{
width:240px;
margin-bottom:20px;
}

.hero-title{
font-size:34px;
font-weight:700;
}

.hero-text{
margin-top:15px;
opacity:.9;
}

/* MENU SHOWCASE */

.menu-showcase h6{
margin-top:20px;
font-weight:600;
opacity:0.9;
}

.menu-scroll{
display:flex;
gap:12px;
overflow-x:auto;
padding-bottom:10px;
}

.menu-scroll::-webkit-scrollbar{
height:6px;
}

.menu-scroll::-webkit-scrollbar-thumb{
background:rgba(255,255,255,0.4);
border-radius:10px;
}

.menu-item{
min-width:120px;
background:rgba(255,255,255,0.15);
border-radius:10px;
overflow:hidden;
backdrop-filter:blur(6px);
}

.menu-item img{
width:100%;
height:90px;
object-fit:cover;
}

.menu-name{
font-size:12px;
padding:6px;
text-align:center;
}

/* RIGHT SIDE */

.login-right{
display:flex;
align-items:center;
justify-content:center;
background:#f6f8f9;
}

.login-form{
width:100%;
max-width:420px;
padding:10px;
}

.login-title{
font-weight:700;
color:#2c3e50;
}

.form-control{
border-radius:10px;
padding:12px 14px;
}

.login-btn{
background:#0a7f8a;
border:none;
color:white;
padding:12px;
font-weight:500;
border-radius:10px;
}

.login-btn:hover{
background:#086a73;
}



/* MOBILE */

@media(max-width:992px){

.login-left{
display:none;
}

.login-page{
height:auto;
padding:80px 0;
}

.login-form{
max-width:95%;
margin:auto;
}

}
</style>


<div class="container-fluid p-0">

<div class="row g-0 login-page">


{{-- LEFT SIDE --}}
<div class="col-lg-6 login-left">

<img src="{{ asset('images/logo.png') }}" class="logo-img">

<h1 class="hero-title">
Welcome to Zaylee's Bistro
</h1>

<p class="hero-text">
Experience seamless catering and event management with
<strong>Zaylee's Bistro by D' Lake</strong>.
</p>

{{-- MENU PREVIEW --}}
<div class="menu-showcase">

<h6 class="mt-3">Food</h6>
<div class="menu-scroll">
@foreach($foods as $item)
<div class="menu-item">
<img src="{{ $item->photo_url }}"
onerror="this.src='{{ asset('images/default-food.jpg') }}'">
<div class="menu-name">{{ $item->name }}</div>
</div>
@endforeach
</div>

<h6 class="mt-3">Drinks</h6>
<div class="menu-scroll">
@foreach($drinks as $item)
<div class="menu-item">
<img src="{{ $item->photo_url }}"
onerror="this.src='{{ asset('images/default-food.jpg') }}'">
<div class="menu-name">{{ $item->name }}</div>
</div>
@endforeach
</div>

<h6 class="mt-3">Desserts</h6>
<div class="menu-scroll">
@foreach($desserts as $item)
<div class="menu-item">
<img src="{{ $item->photo_url }}"
onerror="this.src='{{ asset('images/default-food.jpg') }}'">
<div class="menu-name">{{ $item->name }}</div>
</div>
@endforeach
</div>

</div>

</div>


{{-- RIGHT SIDE --}}
<div class="col-lg-6 login-right">

<div class="login-form">

<h3 class="login-title mb-4 text-center">
Account Login
</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif


<form method="POST" action="/login">
@csrf

<div class="mb-3">
<input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
</div>

<div class="mb-4">
<input type="password" name="password" class="form-control" placeholder="Password">
</div>

<button class="btn login-btn w-100 mb-3">
Login
</button>

<div class="text-center">
Don't have an account?
<a href="/register">Register</a>
</div>

</form>

</div>

</div>

</div>

</div>

@endsection