@extends('layouts.app')

@section('title', 'Register')

@section('content')

<style>

/* REMOVE DEFAULT CONTAINER LIMIT */
main.container{
    max-width:100% !important;
    padding:0 !important;
    margin:0 !important;
}

/* PAGE LAYOUT */
.register-page{
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

.register-right{
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f6f8f9;
}

.register-form{
    width:100%;
    max-width:420px;
    padding:10px;
}

.register-title{
    font-weight:700;
    color:#2c3e50;
}

.form-control{
    border-radius:10px;
    padding:12px 14px;
    width:100%;
}

.register-btn{
    background:#0a7f8a;
    border:none;
    color:white;
    padding:12px;
    font-weight:500;
    border-radius:10px;
    width:100%;
}

.register-btn:hover{
    background:#086a73;
}

/* MOBILE */

@media(max-width:992px){

    .register-left{
        display:none;
    }

    .register-page{
        height:auto;
        padding-top:80px;
        padding-bottom:60px;
    }

    .register-form{
        max-width:95%;
        margin:auto;
    }

}

</style>

<script>
setTimeout(function(){
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => alert.remove());
},3000);
</script>

<div class="container-fluid p-0">

<div class="row g-0 register-page">

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

<div class="col-lg-6 register-right">

<div class="register-form">


<h3 class="register-title mb-4 text-center">
    Create Your Account
</h3>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    <strong>Registration Error:</strong><br>
    {{ session('error') }}
</div>
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


<form method="POST" action="/register">

    @csrf

    <div class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
    </div>

    <div class="mb-3">
        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
    </div>

    <div class="mb-3">
        <input type="text" name="address" class="form-control" placeholder="Address">
    </div>

    <div class="mb-4">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>

    <button class="btn register-btn mb-3">
        Create Account
    </button>

    <div class="text-center">
        Already have an account?
        <a href="/login">Login</a>
    </div>

</form>

</div>

</div>

</div>

</div>

@endsection
