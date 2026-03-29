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

/* LEFT SIDE */

.register-left{
    background:linear-gradient(135deg,#0a7f8a,#5bb6be);
    color:white;
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    padding:60px;
    overflow-y:auto;
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

.menu-showcase{
    margin-top:25px;
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
    transition:0.2s;
}

.menu-item:hover{
    transform:scale(1.05);
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

{{-- LEFT SIDE --}}

<div class="col-lg-6 register-left">


<img src="{{ asset('images/logo.png') }}" class="logo-img">

<h1 class="hero-title">
    Join Zaylee's Bistro
</h1>

<p class="hero-text">
    Create an account to start planning events with
    <strong>Zaylee's Bistro by D' Lake</strong>.
</p>


{{-- FOOD --}}
<div class="menu-showcase">
    <h6>Food</h6>

    <div class="menu-scroll">
        @foreach($foods as $item)
        <div class="menu-item">
            <img src="{{ $item->photo_url }}"
                 onerror="this.onerror=null;this.src='{{ asset('images/default-food.jpg') }}';">
            <div class="menu-name">
                {{ $item->name }}
            </div>
        </div>
        @endforeach
    </div>
</div>


{{-- DRINKS --}}
<div class="menu-showcase">
    <h6>Drinks</h6>

    <div class="menu-scroll">
        @foreach($drinks as $item)
        <div class="menu-item">
            <img src="{{ $item->photo_url }}"
                 onerror="this.onerror=null;this.src='{{ asset('images/default-food.jpg') }}';">
            <div class="menu-name">
                {{ $item->name }}
            </div>
        </div>
        @endforeach
    </div>
</div>


{{-- DESSERTS --}}
<div class="menu-showcase">
    <h6>Desserts</h6>

    <div class="menu-scroll">
        @foreach($desserts as $item)
        <div class="menu-item">
            <img src="{{ $item->photo_url }}"
                 onerror="this.onerror=null;this.src='{{ asset('images/default-food.jpg') }}';">
            <div class="menu-name">
                {{ $item->name }}
            </div>
        </div>
        @endforeach
    </div>
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
