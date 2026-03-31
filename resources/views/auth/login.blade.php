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

 /* LEFT HERO SECTION */

 .admin-left {
            background: linear-gradient(135deg, #0a7f8a, #5bb6be);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px;
        }

        .logo-img {
            width: 260px;
            margin-bottom: 30px;
        }

        .hero-title {
            font-size: 38px;
            font-weight: 700;
        }

        .hero-text {
            margin-top: 20px;
            opacity: .9;
        }

        .hero-feature {
            margin-top: 12px;
            opacity: .9;
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


{{-- LEFT SIDE BRANDING --}}

<div class="col-lg-6 admin-left">

<img src="{{ asset('images/logo.png') }}" class="logo-img">

<h1 class="hero-title">
    Zaylee's Bistro Admin Portal
</h1>

<p class="hero-text">

    Manage orders, oversee catering events, and monitor business performance
    for <strong>Zaylee's Bistro by D' Lake</strong>.

</p>

<div class="hero-feature mt-4">
    ✔ Manage customer orders
</div>

<div class="hero-feature">
    ✔ Approve and schedule events
</div>

<div class="hero-feature">
    ✔ Track catering performance
</div>

<div class="hero-feature">
    ✔ Monitor analytics and reports
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